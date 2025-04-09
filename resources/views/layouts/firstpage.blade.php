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
            /* New keyframe for floating animation for minimal star effects */
            @keyframes float {
                0% { transform: translateY(0); opacity: 0.7; }
                50% { transform: translateY(-10px); opacity: 1; }
                100% { transform: translateY(0); opacity: 0.7; }
            }
            @keyframes twinkle {
                0% { transform: scale(1); opacity: 0.5; }
                50% { transform: scale(1.2); opacity: 1; }
                100% { transform: scale(1); opacity: 0.5; }
            }
            /* Styling for the floating star symbols */
            .floating-star {
                position: absolute;
                width: 8px;
                height: 8px;
                background-color: rgba(255, 255, 255, 0.5);
                border-radius: 50%;
                box-shadow: 0 0 4px rgba(255, 255, 255, 0.6);
                animation: float 3s ease-in-out infinite, twinkle 2s ease-in-out infinite;
            }
            /* Container to hold the floating stars in the background */
            .floating-stars {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                pointer-events: none;
                overflow: hidden;
                z-index: 0;
            }
            
            /* Cyber design with white accents */
            .cyber-container {
                /* background: rgb(17, 24, 39); */
                border: 1px solid rgba(255,255,255,0.5);
                border-radius: 8px;
                box-shadow: 0 0 15px rgba(255,255,255,0.3);
                animation: pulse 3s infinite;
                backdrop-filter: blur(5px);
            }

            @keyframes pulse {
                0% { box-shadow: 0 0 5px rgba(255,255,255,0.5); }
                50% { box-shadow: 0 0 20px rgba(255,255,255,0.8), 0 0 30px rgba(255,255,255,0.6); }
                100% { box-shadow: 0 0 5px rgba(255,255,255,0.5); }
            }

            .cyber-text {
                color: #ffffff;
                text-shadow: 0 0 5px rgba(255,255,255,0.7);
            }

            .cyber-button {
                background: linear-gradient(45deg, #ffffff, #f0f0f0);
                color: #111827;
                border: none;
                padding: 0.5rem 1.5rem;
                border-radius: 4px;
                font-weight: 600;
                letter-spacing: 0.5px;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .cyber-button:hover {
                transform: translateY(-2px);
                box-shadow: 0 0 15px rgba(255,255,255,0.5);
            }

            .cyber-button:active {
                transform: translateY(0);
            }
        </style>
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body data-disable-loading-overlay="true" style="max-height: 100vh" class="flex flex-col bg-black text-gray-200 relative">
        <header class="py-4">
            <div class="container mx-auto flex justify-center">
                <img src="{{ asset('storage/logo_bitflow_rombo.png') }}" alt="Bitflow logo" class="w-32 h-auto">

            </div>
        </header>
        <div class="floating-stars">
            <!-- Add a few floating stars with different positions and animation delays -->
            <div class="floating-star" style="top: 10%; left: 20%; animation-delay: 0s;"></div>
            <div class="floating-star" style="top: 40%; left: 70%; animation-delay: 1s;"></div>
            <div class="floating-star" style="top: 75%; left: 15%; animation-delay: 0.5s;"></div>
            <div class="floating-star" style="top: 20%; left: 80%; animation-delay: 1.5s;"></div>
            <div class="floating-star" style="top: 60%; left: 50%; animation-delay: 0.8s;"></div>
        </div>
        
        <section>
            <div class="container mx-auto text-center p-8 sm:p-8 md:p-10 fade-in relative z-10">
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
</script>
