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
    public function mount($userId)
    {
        dump($this->question);
        $this->userId = $userId;
    }

    protected $listeners = [
        'updateQuestions' => 'updateQuestionsHandler',
    ];
    
    public function updateQuestionsHandler($newQuestion, $newAnswers)
    {
        dd($newQuestion, $newAnswers);
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
        // dd('nextstep');
        // $selAnswers[]=$this->selAnswers;
        // dd($this->all());
        // salvataggio risposte domanda
        //retrieve all points of answers for not querying everytime 
        $arrPoints = Answerquestion::pluck('is_right', 'answer_id')->toArray();
        $user_id = $this->userId;
        $question_id = intval($this->question->id);
        $question = Question::where('id', $question_id)->first();

        $nextquestion_id = $this->nextquestion;
        $nextquestion = Question::where('id', $nextquestion_id)->first();
        // dd($nextquestion);
        $time_answering = Carbon::now()->format('Y-m-d H:i:s');
        $start_time = Carbon::parse(Adminsession::first()->start_time);
        // $second_time = Carbon::parse(Adminsession::skip(1)->take(1)->first()->start_time);
        // $third_time = Carbon::parse(Adminsession::skip(2)->take(1)->first()->start_time);
        // $fourth_time = Carbon::parse(Adminsession::skip(3)->take(1)->first()->start_time);
        // dd($start_time, $second_time, $third_time, $fourth_time);
        // dd($start_time, Carbon::parse($start_time)->addSeconds(40)->format('Y-m-d H:i:s'));
        
        // switch (true) {
        //     //se il tempo di risposta < 40, allora e' nella domanda successiva
        //     case $time_answering <= Carbon::parse($start_time)->addSeconds(40):
        //         #
        //         $waitingTime = Carbon::parse($start_time)->diffInSeconds($time_answering);
        //         dd($waitingTime);
        //         dd('40');


        //         break;

        //     // < 80 && > 40
        //     case $time_answering < Carbon::parse($start_time)->addSeconds(80) && $time_answering > Carbon::parse($start_time)->addSeconds(40):
        //         $waitingTime = Carbon::parse($start_time)->diffInSeconds($time_answering);
        //         dd($waitingTime, '80');
        //         dd('80');
                
        //         break;
            
        //     // < 120 && > 80
        //     case $time_answering < Carbon::parse($start_time)->addSeconds(120) && $time_answering > Carbon::parse($start_time)->addSeconds(80):
        //         dd('120');

        //         break;
        //     default:
        //         # code...
        //         break;
        // }
        // $waitingTime = 0;
        // if ($time_answering <= $second_time) {
        //     $waitingTime = Carbon::parse($start_time)->diffInSeconds($time_answering);
        //     dd($waitingTime);
        // }
        // dd('break');

        // SPEZZARE LO STORE DAL RETURN VIEW: 
        // al submit del form viene chiamata la funzione savesessionline->pulsante submit disabled
        // e il return della view viene chiamata al termine del timer






        // $waitingTime = 40 - Carbon::parse($start_time)->diffInSeconds($time_answering);
        // dd($waitingTime);
        // $waitingTime = 40-Adminsession
        // sleep($waitingTime);



        // salvataggio risposte domanda
        // $this->savesessionline($sel_answers, $arrPoints, $user_id, $question_id, $time_answering);
            // dd($nextquestion);
        if($nextquestion != null) {
            // dd('nextquestion not null');
            $this->answers = $nextquestion->answers;
            $this->question = $nextquestion;
            $this->dispatch('updateQuestions', $this->question, $this->answers);
            } else {
            dd('else hiddenform');
            // Calculate risultati sessione
            $savesession = new Savesession();
            $savesession->user_id = $user_id;
            $savesession->tot_points = $this->calculateTotPoints($user_id);
            $savesession->tot_time_answering = $this->calculateTotTimeAnswering($user_id);
            // dd($savesession->tot_time_answering, $savesession);
            $savesession->save();
            // $session = Savesession::all();
            
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
        $totTimeAnswers = gmdate('H:i:s.u', $totalTimeSpent);
        dd($totTimeAnswers);
        $totTimeAnswers = substr($totTimeAnswers, 0, -3);

    
        return $totTimeAnswers;
    }

    // seeting data in the component (maybe separated also from the view):
    // public function mount($question, $nextquestion, $answers) {
        
    //     $this->question = $question;
    //     $this->nextquestion = $nextquestion;
    // }

    public function render()
    {
        return view('livewire.hidden-form');
    }
}
