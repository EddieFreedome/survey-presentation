<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Quiz!</title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">
        
        <style>
            @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
            }
            .fade-in { 
                animation: fadeIn 1s ease-in-out; 
            }
        </style>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body style="max-height: 100vh" class="flex flex-col bg-black text-gray-200">
        
        <section>
            <div class="body-container container mx-auto text-center p-10 sm:p-8 md:p-10 fade-in rounded-lg border border-gray-700">
                @livewire('timer-component')          
                {{-- Question title is now managed by the Livewire component --}}
                <section id="form-container">
                    @livewire('hidden-form', ['question' => $question, 'nextquestion' => $question->nextquestion_id, 'answers' => $question->answers, 'userId' => $userId])
                </section>   
            </div>
        </section>
        @livewireScripts
    </body>
</html>
<script>           
    // document.addEventListener("DOMContentLoaded", function() {
    //     // interval for submit button at countdown
    //     let countdownTime = 40;
    //     let timerElement = $('#timer');
    //     setInterval(function() {
    //         countdownTime --;
    //         // Update the countdown timer in the view
    //         let minutes = Math.floor(countdownTime / 60);
    //         let seconds = countdownTime % 60;
    //         let timerValue = minutes + ':' + (seconds < 10 ? '0' : '') + seconds;
    //         $('#timer').text(timerValue);
    //     }, 1000);
    // });
</script>
