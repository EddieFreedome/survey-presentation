<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $answers = [
            [
                'text' => 'È troppo vecchio e va rifatto da zero',
                'points' => 0,
            ],
            [
                'text' => 'Qualcuno ha caricato troppi file sul sito',
                'points' => 0,
            ],
            [
                'text' => 'Immagini pesanti, codice non ottimizzato o un server lento',
                'points' => 1,
            ],
            [
                'text' => 'Probabilmente il Wi-Fi dell’utente è debole',
                'points' => 0,
            ],
            // Question 2
            [
                'text' => 'Ti consiglia di dire ai tuoi clienti di usare solo il computer',
                'points' => 0,
            ],
            [
                'text' => 'Aggiunge una versione "mobile-friendly" con caratteri più piccoli',
                'points' => 0,
            ],
            [
                'text' => 'Ottimizza il layout con codice responsive e corregge problemi di compatibilità',
                'points' => 1,
            ],
            [
                'text' => 'Cambia semplicemente il font e riduce le immagini',
                'points' => 0,
            ],
            // Question 3
            [
                'text' => 'Lo sviluppatore web, che è anche un designer',
                'points' => 0,
            ],
            [
                'text' => 'Un web designer crea il layout, lo sviluppatore lo trasforma in un sito funzionante',
                'points' => 1,
            ],
            [
                'text' => 'Nessuno, basta scegliere un tema gratuito online',
                'points' => 0,
            ],
            [
                'text' => 'Un esperto di social media, tanto sono tutti uguali',
                'points' => 0,
            ],
            // Question 4
            [
                'text' => 'Il tuo sito ha un logo vecchio che vuoi cambiare',
                'points' => 0,
            ],
            [
                'text' => 'I clienti segnalano errori o il sito si carica lentamente ',
                'points' => 1,
            ],
            [
                'text' => 'Vuoi solo migliorare la tua presenza su Instagram',
                'points' => 0,
            ],
            [
                'text' => 'Vuoi integrare un sistema di prenotazione o e-commerce',
                'points' => 1,
            ],
            // Question 5
            [
                'text' => 'Il tuo sito impiega più di 5 secondi a caricarsi',
                'points' => 0,
            ],
            [
                'text' => 'Vedi messaggi di errore strani o gli utenti segnalano problemi di accesso',
                'points' => 1,
            ],
            [
                'text' => 'Il design sembra un po’ vecchio',
                'points' => 0,
            ],
            [
                'text' => 'Hai ricevuto email sospette che dicono che il sito è stato hackerato',
                'points' => 1,
            ],
            // Question 6
            [
                'text' => 'Trova un template bello e lo installa',
                'points' => 0,
            ],
            [
                'text' => 'Scrive il codice per realizzare esattamente quello di cui hai bisogno',
                'points' => 1,
            ],
            [
                'text' => 'Ti consiglia di usare solo i social media per iniziare',
                'points' => 0,
            ],
            [
                'text' => 'Copia un sito simile e cambia il logo',
                'points' => 0,
            ],
            // Question 7
            [
                'text' => 'Cambi piattaforma e rifai tutto da capo',
                'points' => 0,
            ],
            [
                'text' => 'Aspetti che il builder aggiunga quella funzione in futuro',
                'points' => 0,
            ],
            [
                'text' => 'Contatti un web developer per integrare una soluzione personalizzata',
                'points' => 1,
            ],
            [
                'text' => 'Cerchi un plugin qualsiasi senza sapere se è compatibile',
                'points' => 0,
            ],

        ];

        foreach ($answers as $answer) {
            Answer::create($answer);
        }
    }
}
