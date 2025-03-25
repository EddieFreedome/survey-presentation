<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = \App\Models\Question::all();
        $answers = \App\Models\Answer::all();
        
        $answerIndex = 0;
        foreach ($questions as $question) {

            $answersForQuestion = $answers->slice($answerIndex, 4);
            foreach ($answersForQuestion as $answer) {
                $question->answers()->attach($answer, ['is_right' => $answer->points]);
            }
            $answerIndex += 4;
        }
    }
}
