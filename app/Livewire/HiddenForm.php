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
            $savesession->tot_correct = $this->calculateTotCorrect($user_id);
            $savesession->tot_wrong = $this->calculateTotWrong($user_id);
            $savesession->save();
            
            return redirect()->route('finish.page');        
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
        // Recupera la sessione admin per ottenere l'orario di inizio
        $adminsession = Adminsession::first();
        $start_time = Carbon::parse($adminsession->start_time);
    
        // Recupera l'ultima risposta dell'utente
        $lastAnswer = Savesessionline::where('user_id', $user_id)
                        ->orderBy('time_of_answering', 'desc')
                        ->first();

        if (!$lastAnswer) {
            return 0;
        }
    
        $lastAnswerTime = Carbon::parse($lastAnswer->time_of_answering);
        $totalTimeSpent = $start_time->diffInSeconds($lastAnswerTime);        

        return $totalTimeSpent;
    }

    private function calculateTotCorrect($user_id) {
        return Savesessionline::join('answer_question', function($join) {
            $join->on('savesessionlines.answer_id', '=', 'answer_question.answer_id')
                 ->on('savesessionlines.question_id', '=', 'answer_question.question_id');
        })
        ->where('savesessionlines.user_id', $user_id)
        ->where('answer_question.is_right', 1)
        ->count();
    }

    private function calculateTotWrong($user_id) {
        // Only consider lines where an answer was selected (answer_id is not null)
        return Savesessionline::join('answer_question', function($join) {
            $join->on('savesessionlines.answer_id', '=', 'answer_question.answer_id')
                 ->on('savesessionlines.question_id', '=', 'answer_question.question_id');
        })
        ->where('savesessionlines.user_id', $user_id)
        ->where('savesessionlines.answer_id', '!=', null)
        ->where('answer_question.is_right', -1)
        ->count();
    }

    public function render()
    {
        return view('livewire.hidden-form');
    }
}
