<?php

namespace App\Livewire;

use App\Models\Adminsession;
use App\Models\Answerquestion;
use App\Models\Question;
use App\Models\Savesession;
use App\Models\Savesessionline;
use Carbon\Carbon;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Url;
use Livewire\Component;

use function Laravel\Prompts\error;

class HiddenForm extends Component
{
    // $this->all(); is used as $request->all()
    // #[Url] //TEST: maintainer for url get variables
    public $question;
    public $nextquestion;
    public $answers;
    public $adminsession;
    public $selAnswers = [];
    public $userId;
    public function mount($userId, $question = null, $nextquestion = null, $answers = null)
    {
        $this->userId = $userId;
        $this->question = $question;
        $this->nextquestion = $nextquestion;
        $this->answers = $answers;
    }

    protected $listeners = [
        'updateQuestions' => 'updateQuestionsHandler',
        'timerFinished'   => 'nextstep'
    ];
    
    public function updateQuestionsHandler($newQuestion, $newAnswers)
    {
        $this->question = $newQuestion;
        $this->answers = $newAnswers;
    }
    
    public function toggleSelection($value){
        if (in_array($value, $this->selAnswers)) {
            $this->selAnswers = array_diff($this->selAnswers, [$value]);
        } else {
            $this->selAnswers[] = $value;
        }
    }

    
    // public function index() {
    //     $questions = Question::all();
    //     $firstquestion = Question::where('is_start', 1)->first();
    //     // is it the first question?
    //     $is_start = Savesessionline::where('question_id', $firstquestion->id)->where('user_id', Auth::user()->id)->exists();

    //     if ($firstquestion) {
    //         $question = $firstquestion;
    //         $answers = $firstquestion->answers;
    //         $nextquestion_id = $question->nextquestion_id;
    //     } else {
    //         return error('no question found');
    //     }
    //     return view('layouts.firstpage', compact('question', 'answers', 'nextquestion_id'));
    // }
    
    public function nextstep()
    {
        $sel_answers = $this->selAnswers;
        // retrieve all points of answers for not querying everytime 
        $arrPoints = Answerquestion::pluck('is_right', 'answer_id')->toArray();
        $user_id = $this->userId;
        $question_id = intval($this->question->id);
        $time_answering = Carbon::now()->format('Y-m-d H:i:s');

        // Save the current question's answers
        $this->savesessionline($sel_answers, $arrPoints, $user_id, $question_id, $time_answering);
        
        // Reset selected answers for the next question
        $this->selAnswers = [];
        
        // Get the next question based on the stored nextquestion ID
        $nextquestion = Question::where('id', $this->nextquestion)->first();
            
        if($nextquestion) {
            // Update the current question with the next question
            $this->question = $nextquestion;
            // Update the answers for the new question
            $this->answers = $nextquestion->answers;
            // Set the next question ID for the following step
            $this->nextquestion = $nextquestion->nextquestion_id;
            // Reset the timer for the new question
            $this->dispatch('resetTimer');
        } else {
            // Calculate risultati sessione
            $savesession = new Savesession();
            $savesession->user_id = $user_id; // Use the user_id passed from mount method
            $savesession->tot_points = $this->calculateTotPoints($user_id);
            // Store the total time answering as a valid TIME format (H:i:s)
            $savesession->tot_time_answering = $this->calculateTotTimeAnswering($user_id);
            $savesession->save();
            
            return view('finishpage');        
        }
    }

    private function savesessionline($sel_answers, $arrPoints, $user_id, $question_id, $time_answering) {
        // se ci sono risposte
        if (isset($sel_answers)) {
           
            foreach ($sel_answers as $answer_id) {
                $sessionline = new Savesessionline();
                $sessionline->user_id = $user_id;
                $sessionline->question_id = $question_id;
                $sessionline->answer_id = intval($answer_id); //returns from string to value (for === condition)
                $sessionline->points = $arrPoints[$answer_id];
                $sessionline->time_of_answering = $time_answering;
                $sessionline->save();
            }
        } else {
            // se non ci sono risposte...
            $sessionline = new Savesessionline();
            $sessionline->user_id = $user_id;
            $sessionline->question_id = $question_id;
            $sessionline->answer_id = null;
            $sessionline->points = 0;
            $sessionline->time_of_answering = $time_answering;
            $sessionline->save();
        }
    }

    private function calculateTotPoints($user_id) : int{
        $userAnswers = Savesessionline::where('user_id', $user_id)->sum('points');
        return $userAnswers;
    }

    private function calculateTotTimeAnswering($user_id) {
        // Recupera la sessione amministrativa per ottenere l'orario di inizio
        $adminsession = Adminsession::first();
        $start_time = Carbon::parse($adminsession->start_time);
    
        // Recupera tutte le risposte dell'utente ordinate per tempo di risposta
        $answersUser = Savesessionline::where('user_id', $user_id)
                        ->orderBy('time_of_answering', 'asc')
                        ->get();

        // Se non ci sono risposte, restituisci 00:00:00
        if ($answersUser->isEmpty()) {
            return '00:00:00';
        }
    
        // Calcola il tempo totale di attesa obbligatoria (3 intervalli di 40 secondi ciascuno)
        $obligatoryWaitTime = 3 * 40; // 120 secondi
    
        // Calcola il tempo finale (T6)
        $end_time = $start_time->copy()->addSeconds(160);
    
        // Calcola il tempo totale trascorso rispondendo alle domande
        $totalTimeSpent = 0;
        $prevTime = $start_time;
    
        foreach ($answersUser as $index => $answer) {
            $currentAnswerTime = Carbon::parse($answer->time_of_answering);
            $timeSpent = $currentAnswerTime->diffInSeconds($prevTime);
    
            if ($index < 3) {
                // Sottrai i 40 secondi di attesa obbligatoria per le prime tre domande
                $timeSpent -= $obligatoryWaitTime;
            }
    
            $totalTimeSpent += $timeSpent;
            $prevTime = $currentAnswerTime;
        }
    
        // Calcola il tempo speso fino all'ultima risposta, considerando il tempo finale T6
        $lastAnswerTime = Carbon::parse($answersUser->last()->time_of_answering);
        if ($lastAnswerTime < $end_time) {
            $totalTimeSpent += $lastAnswerTime->diffInSeconds($prevTime);
        }
    
        // Calcolo del tempo totale sottraendo i 120 secondi di attesa obbligatoria
        $totalTimeSpent = max(0, $totalTimeSpent); // Assicurarsi che il tempo non sia negativo
        
        // Genera un formato TIME valido (H:i:s) per la colonna tot_time_answering
        // Questo formato è compatibile con il tipo TIME del database
        $totTimeAnswers = gmdate('H:i:s', $totalTimeSpent);
    
        return $totTimeAnswers;
    }

    public function render()
    {
        return view('livewire.hidden-form');
    }
}
