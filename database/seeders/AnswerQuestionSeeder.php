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

            $question->answers()->attach($answers->slice($answerIndex, 4));
            $answerIndex += 4;
        }
    }
}
