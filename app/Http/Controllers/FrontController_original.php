<?php

namespace App\Http\Controllers;
// use Illuminate\View\View;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Savesessionline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class FrontController extends Controller
{
    // l'utente arriva da "INIZIA" mandato dall'admin
    
    //partira' da firstquestion 
    public function index() {
        $questions = Question::all();
        // $questions = DB::table('questions')->get();
        $firstquestion = Question::where('is_start', 1)->first();
        // $answers = Answer::where('question_id', );
        $answers = $firstquestion->answers;
        $question = $firstquestion;
        // dd($firstquestion_answers);



        return view('layouts.firstpage', compact('question', 'firstquestion', 'answers'));
    }
    
    // all'invio delle prime risposte, la view si riaggiornera' con la nuova domanda presa (nextquestion_id)
    public function nextstep(Request $request)
    {
        //vanno salvate le risposte sulla tabella savesessionlines 
        // 1 user, 1 domanda, 1+ risposte (1 record/risposta)
        
        //retrieve all answers for not querying everytime 
        $allAnswers = Answer::all();
        $sel_answers = $request->arrAnswers; //only IDs!

        
        $user_id = intval(Auth::user()->id);
        $question_id = intval($request->question_id); 

        // AGGIUNGERE TIMER!!

        // salvataggio risposte domanda
        $this->savesessionline($sel_answers, $allAnswers, $user_id, $question_id);
        
        // prende la domanda successiva per portarla alla view
        $nextquestion_id = intval($request->nextquestion_id);

        $question = Question::where('id', $nextquestion_id)->first();
        
        $answers = $question->answers;
        



        // return response()->json([
        //     'success'=> true,
        //     'question' => $question,
        //     'answers' => $answers
        // ], 200);

        // CHATGPT SOLUTION
            // $view = View::make('layouts.firstpage', compact('question', 'answers'));
            // $viewContent = $view->render();

            // preg_match('/<section\b[^>]*>(.*?)<\/section>/s', $viewContent, $matches);        
            // $contentSection = isset($matches[1]) ? $matches[1] : '';

            // return response()->json([
            //     'content' => $contentSection,
            //     'question' => $question,
            //     'answers' => $answers
            
            // ]);
            
            // return view('layouts.firstpage', compact('question','answers'))->with('success');
            

            // Tentativo N1

            // $returnHTML = view('layouts.firstpage')->with([
            //     'redirect' => route('nextstep'),
            //     'question' => $question,
            //     'answers' => $answers
            // ])->render();
            
            // return response($returnHTML, 200);

            // TENTATIVO 2
            //  View::make("layouts.admin")
            // ->with([
            //     'question' => $question,
            //     'answers' => $answers
            // ])->render();
        // }
    }

    private function savesessionline($sel_answers, $allAnswers, $user_id, $question_id){

        //AGGIUNGERE TIMER!!!

        $sessionline = new Savesessionline();
        $sessionline->user_id = $user_id;
        $sessionline->question_id = $question_id;

        //TIMER NEEDED
        // $sessionline->time_of_answering = $time_answering;

        if (isset($sel_answers)) {
            foreach ($sel_answers as $answer_id) {
                //da ogni risposta va preso id e punteggio e salvato in sessionline
                $sessionline->answer_id = intval($answer_id); //returns from string to value (for === condition)
                foreach ($allAnswers as $ans) {
                    if ($ans->id === intval($answer_id)) {
                        $sessionline->points = $ans->points;
                    }
                }
            
                $sessionline->save();

            }
        } else {
        //    dd('nope');
           $sessionline->answer_id = null;
           $sessionline->points = 0;

           $sessionline->save();
        }
    }
}
