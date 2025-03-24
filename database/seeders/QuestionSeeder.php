<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'title' => 'Se il tuo sito è lento, quale potrebbe essere il problema principale?',
                // 'description' => 'La capitale dell\'Italia è una città importante',
                'is_start' => true,
                'nextquestion_id' => 2,
            ],
            [
                'title' => 'Cosa fa un web developer quando il tuo sito non si carica bene su mobile?',
                // 'description' => 'Il più grande fiume del mondo è un fiume lungo e importante',
                'is_start' => false,
                'nextquestion_id' => 3,
            ],
            [
                'title' => 'Vuoi un sito con un design accattivante. Chi lo realizza?',
                // 'description' => 'Il più alto monte del mondo è un monte alto e famoso',
                'is_start' => false,
                'nextquestion_id' => 4,
            ], 
            [
                'title' => 'Quale di queste situazioni indica che hai bisogno di uno sviluppatore?',
                // 'description' => 'Il più alto monte del mondo è un monte alto e famoso',
                'is_start' => false,
                'nextquestion_id' => 5,
            ],
            [
                'title' => 'Qual è un segnale che il tuo sito potrebbe avere problemi di sicurezza?',
                // 'description' => 'Il più alto monte del mondo è un monte alto e famoso',
                'is_start' => false,
                'nextquestion_id' => 6,
            ],
            [
                'title' => 'Hai un’idea di business e vuoi un sito innovativo. Cosa fa il web developer?',
                // 'description' => 'Il più alto monte del mondo è un monte alto e famoso',
                'is_start' => false,
                'nextquestion_id' => 7,
            ],
            [
                'title' => 'Hai un sito fatto con un website builder (es. Wix, Squarespace) ma ti serve una funzione avanzata. Cosa fai?',
                // 'description' => 'Il più alto monte del mondo è un monte alto e famoso',
                'is_start' => false,
                'nextquestion_id' => null,
                'is_finish' => true
            ],
        ];
    
        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}
