<?php

namespace App\Http\Controllers;

use App\Models\Adminsession;
use App\Models\Answer;
use App\Models\Answerquestion;
use App\Models\Question;
use App\Models\Savesession;
use App\Models\Savesessionline;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Ramsey\Uuid\Type\Integer;

use function Laravel\Prompts\error;

class FrontController extends Controller
{
    // l'utente arriva da "INIZIA" mandato dall'admin
    
    //partira' da firstquestion 
    // public function index($questionId = null, $nextquestionId = null) {
        
    // public function dashboard() {
    //     return view('dashboard');
    // }


    public function start(Request $request) {
        // dd($request->all());
        $userId = $request->userId;
        $questions = Question::all();
        $firstquestion = Question::where('is_start', 1)->first();
        // dd($firstquestion);
        // is it the first question?
        // $is_start = Savesessionline::where('question_id', $firstquestion->id)->where('user_id', Auth::user()->id)->exists();

        // passare $user_id!!!!

        if ($firstquestion) {
            $question = $firstquestion;
            
            $answers = $firstquestion->answers;
            $nextquestion_id = $question->nextquestion_id;
        } else {
            return error('no question found');
        }
        return view('layouts.firstpage', compact('question', 'answers', 'nextquestion_id', 'userId'));
    }
    
    // all'invio delle prime risposte, la view si riaggiornera' con la nuova domanda presa (nextquestion_id)
    public function nextstep(Request $request)
    {
        // dd($request->all());
        //TIMER
        $time_answering = Carbon::now()->format('Y-m-d H:i:s');
        
        // salvataggio risposte domanda
        //retrieve all points of answers for not querying everytime 
        $arrPoints = Answerquestion::pluck('is_right', 'answer_id')->toArray();
        $sel_answers = $request->selAnswers; //only IDs!

        $user_id = intval(Auth::user()->id);

        $question_id = intval($request->questionId);
        $question = Question::where('id', $question_id)->first();

        $nextquestion_id = $request->nextquestionId;
        $nextquestion = Question::where('id', $nextquestion_id)->first();

        // salvataggio risposte domanda
        $this->savesessionline($sel_answers, $arrPoints, $user_id, $question_id, $time_answering);
        
        if($nextquestion != null) {
            // dd('nextquestion not null');
            $answers = $nextquestion->answers;
            $question = $nextquestion;
            return view('layouts.firstpage', compact('question','answers'));
        } else {
            // Calculate risultati sessione
            $savesession = new Savesession();
            $savesession->user_id = $user_id;
            $savesession->tot_points = $this->calculateTotPoints($user_id);
            $savesession->tot_time_answering = Carbon::now()->format('Y-m-d H:i:s');;
            // dd($savesession->tot_time_answering, $savesession);
            $savesession->save();
            // $session = Savesession::all();
            
            return view('finishpage');        
        }
       
    }

    // public function redirectToDashboard($question, $nextquestion, $user_id) {
    //     if($nextquestion != null) {
    //             // dd('nextquestion not null');
    //             $answers = $nextquestion->answers;
    //             $question = $nextquestion;
    //             return view('layouts.firstpage', compact('question','answers'));
    //         } else {
    //             // Calculate risultati sessione
    //             $savesession = new Savesession();
    //             $savesession->user_id = $user_id;
    //             $savesession->tot_points = $this->calculateTotPoints($user_id);
    //             $savesession->tot_time_answering = $this->calculateTotTimeAnswering($user_id);
    //             // dd($savesession->tot_time_answering, $savesession);
    //             $savesession->save();
    //             $session = Savesession::all();
                
    //             return view('finishpage');        
    //     }
    // }

    // public function savesessionline($sel_answers, $allAnswers, $user_id, $question_id){
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

    // private function calculateTotTimeAnswering($user_id){
    //     $firstAnswer = Savesessionline::where('user_id', $user_id)->orderBy('time_of_answering', 'asc')->first();
    //     $lastAnswer = Savesessionline::where('user_id', $user_id)->orderBy('time_of_answering', 'desc')->first();
    //     // $lastAnswer = Savesessionline::where('user_id', $user_id)->last();

    //     $totalTime = 0;
    //     $previousTime = null;
    
        
    //     $adminsession = Adminsession::first();
    //     $start_time = $adminsession->start_time;

    //     $answersUser = Savesessionline::where('user_id', $user_id)->get();

    //     foreach ($answersUser as $answer) {
            
    //     }


    //     if($start_time && $lastAnswer) {
    //         $totTimeAnswers = Carbon::parse($start_time)->diffAsCarbonInterval(Carbon::parse($lastAnswer->time_of_answering))->format('%H:%I:%S.%f');
    //         $totTimeAnswers = Carbon::parse($totTimeAnswers)->subSeconds(160)->format('Y-m-d H:i:s');  
    //         $totTimeAnswers = substr($totTimeAnswers, 0, -3);
    //     } else {
    //         $totTimeAnswers = 0;
    //     }

    //     // dd($totTimeAnswers);
    //     return $totTimeAnswers;
    // }


    // public function calculateNetTimeAnswering($userId) {
    //     // Recupera i timestamp di inizio delle domande dalla tabella Adminsessions
    //     // $adminsessions = new Adminsession();
    //     $start_time = Adminsession::orderBy('start_time', 'asc')->pluck('start_time');
    //     $second_timestamps = Adminsession::orderBy('start_time', 'asc')->pluck('second_timestamps');
    //     $third_timestamps = Adminsession::orderBy('start_time', 'asc')->pluck('third_timestamps');
    //     $fourth_timestamps = Adminsession::orderBy('start_time', 'asc')->pluck('fourth_timestamps');
    
    //     // Recupera tutte le risposte dell'utente ordinate per timestamp
    //     $savesessionlines = Savesessionline::where('user_id', $userId)->orderBy('time_of_answering', 'asc')->get();
    
    //     $totalNetTime = 0;
    
    //     // Itera attraverso le risposte dell'utente e i timestamp di inizio delle domande
    //     foreach ($savesessionlines as $key => $sessionline) {
    //         $answerTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $sessionline->time_of_answering);
    
    //         // Recupera il timestamp di inizio della domanda corrente
    //         $questionStartTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $adminSessions[$key]);
    
    //         // Calcola il tempo netto impiegato per rispondere a questa domanda
    //         $netTimeForThisAnswer = $answerTimestamp->diffInRealSeconds($questionStartTimestamp);
    
    //         // Somma il tempo netto per tutte le risposte
    //         $totalNetTime += $netTimeForThisAnswer;
    //     }
    
    //     // Converti il tempo totale in secondi con precisione di millisecondi
    //     return round($totalNetTime, 3); // Aggiungere la precisione in secondi con millisecondi
    // }
    public function calculateNetTimeAnswering($userId, $question_id) {
        $T1 = Adminsession::pluck('start_time')->toArray();
        $T2 = Adminsession::pluck('second_timestamps')->toArray();
        $T3 = Adminsession::pluck('third_timestamps')->toArray();
        $T4 = Adminsession::pluck('fourth_timestamps')->toArray();
        $T=[$T1, $T2, $T3, $T4];
        // dd($T);
        
        $tot_time = 0;

        $savesessionlines = Savesessionline::where('user_id', $userId)->orderBy('time_of_answering')->orderBy('time_of_answering', 'asc')->get();
        // dd($savesessionlines);
        foreach ($savesessionlines as $session) {
            $i = 0;
            $i++;

            $singleAnswerTime = Carbon::createFromFormat('Y-m-d H:i:s', $session->time_of_answering)
            ->diffInSeconds(Carbon::createFromFormat('Y-m-d H:i:s', $T[$i-1][0]));
            $singleAnswerTime;
        }
        // dd($tot_time);
        
    
    
    }

    


    // public function calculateNetTimeAnswering($userId) {
    // Recupera i timestamp di inizio delle domande dalla tabella Adminsession
        // $adminSession = Adminsession::first();

        // $timestamps = [
        //     Carbon::createFromFormat('Y-m-d H:i:s', $adminSession->start_time),
        //     Carbon::createFromFormat('Y-m-d H:i:s', $adminSession->second_timestamps),
        //     Carbon::createFromFormat('Y-m-d H:i:s', $adminSession->third_timestamps),
        //     Carbon::createFromFormat('Y-m-d H:i:s', $adminSession->fourth_timestamps),
        // ];

        // // Recupera tutte le risposte dell'utente ordinate per timestamp
        // $savesessionlines = Savesessionline::where('user_id', $userId)->orderBy('time_of_answering', 'asc')->get();

        // $totalNetTime = 0;

        // // Itera attraverso le risposte dell'utente e i timestamp di inizio delle domande
        // foreach ($savesessionlines as $key => $sessionline) {
        //     $answerTimestamp = Carbon::createFromFormat('Y-m-d H:i:s', $sessionline->time_of_answering);

        //     // Recupera il timestamp di inizio della domanda corrente
        //     $questionStartTimestamp = $timestamps[$key];

        //     // Calcola il tempo netto impiegato per rispondere a questa domanda
        //     $netTimeForThisAnswer = $answerTimestamp->diffInRealSeconds($questionStartTimestamp);

        //     // Somma il tempo netto per tutte le risposte
        //     $totalNetTime += $netTimeForThisAnswer;
        //     // Converti il tempo totale in secondi con precisione di millisecondi
        //     return round($totalNetTime, 3); // Aggiungere la precisione in secondi con millisecondi
        // }
        // }

    // private function calculateTotTimeAnswering($user_id) : string{
    //     $totTimeAnswers = Savesessionline::where('user_id', $user_id)
    //                                 ->get()
    //                                 ->map(function ($item) {
    //                                     return Carbon::parse($item->time_of_answering)->format('Y-m-d H:i:s');
    //                                 })
    //                                 ->implode(', ');
    //     dd($totTimeAnswers);  
    //     return $totTimeAnswers;
    // }

    // private function calculateTotTimeAnswering($user_id) : int{
    //     $userAnswers = Savesessionline::where('user_id', $user_id)->sum('time_of_answering');
    //     return $userAnswers;
    // }
}
