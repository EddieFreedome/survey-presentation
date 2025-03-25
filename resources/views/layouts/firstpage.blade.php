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
        <link href="https://fonts.googleapis.com/css2?family=Junge&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="junge-regular">
        
        <section>
            <div class="body-container container mx-auto text-center p-20">
                @livewire('timer-component')          
                <h1 class="text-3xl pb-10"> {{ $question->title }} </h1>
                {{-- <h2 class="text-2xl pb-10">{{ $question->description }}</h2> --}}
                <section id="form-container">
                    <div wire:poll>
                        @livewire('hidden-form', ['question' => $question, 'nextquestion' => $question->nextquestion_id, 'answers' => $question->answers, 'userId' => $userId])
                    </div>  
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
