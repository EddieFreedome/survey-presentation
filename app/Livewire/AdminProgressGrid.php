<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Question;
use App\Models\User;

class AdminProgressGrid extends Component
{
    public $questions;
    public $users;

    public function mount()
    {
        // Load questions ordered by id
        $this->questions = Question::orderBy('id')->get();
        
        // Load all users with their savesessionlines and savesession relations
        $this->users = User::with(['savesessionlines', 'savesession'])
                    ->orderBy('name')
                    ->get();
        
        // Calculate progress for each user
        $this->calculateUserProgress();
    }

    public function render()
    {
        // Recalculate progress on refresh
        $this->calculateUserProgress();
        
        // Render the view with real-time updates using wire:poll in blade template
        return view('livewire.admin-progress-grid', [
            'questions' => $this->questions,
            'users' => $this->users,
        ]);
    }
    
    private function calculateUserProgress()
    {
        // Map each question id to its index in the questions collection
        $questionIndexMap = [];
        foreach ($this->questions as $index => $question) {
            $questionIndexMap[$question->id] = $index;
        }

        // Find the starting question (is_start) or default to first
        $startQuestion = $this->questions->firstWhere('is_start', true);
        if (!$startQuestion) {
            $startQuestion = $this->questions->first();
        }

        foreach ($this->users as $user) {
            if ($user->savesession) {
                // If user finished, place the indicator on the last question
                $user->currentQuestionIndex = $this->questions->count() - 1;
                $user->finished = true;
                continue;
            }

            if (count($user->savesessionlines) === 0) {
                $user->currentQuestionIndex = null;
                $user->finished = false;
                continue;
            }

            // Group user's savesessionlines by question_id, picking the latest response
            $answeredQuestions = collect($user->savesessionlines)->groupBy('question_id')->map(function($lines) {
                return $lines->sortByDesc('time_of_answering')->first();
            });

            // Traverse the questions sequence starting from the startQuestion
            $currentQuestion = $startQuestion;
            $lastAnsweredQuestionIndex = null;
            while ($currentQuestion) {
                if ($answeredQuestions->has($currentQuestion->id)) {
                    // Save the index of the answered question
                    $lastAnsweredQuestionIndex = $questionIndexMap[$currentQuestion->id];
                    // Follow the chain using nextquestion_id
                    if ($currentQuestion->nextquestion_id) {
                        $currentQuestion = $this->questions->firstWhere('id', $currentQuestion->nextquestion_id);
                    } else {
                        // Reached the end of the sequence
                        break;
                    }
                } else {
                    // Stop when a question in the sequence hasn't been answered
                    break;
                }
            }

            $user->currentQuestionIndex = $lastAnsweredQuestionIndex;
            $user->finished = false;
        }
    }
}
