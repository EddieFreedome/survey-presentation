<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="icon" href="{{ asset('favicon.ico') }}">
        
        <title>{{ config('app.name', 'Bitflow Quiz') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Nunito+Sans:ital,opsz,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/c6b83f6166.js" crossorigin="anonymous"></script>

        <style>
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
            @keyframes pulse {
                0% { box-shadow: 0 0 5px #e2e8f5; }
                50% { box-shadow: 0 0 20px #e2e8f88b, 0 0 30px #e2e8f682 }
                100% { box-shadow: 0 0 5px #e2e8f5 }
            }
            @keyframes gradientBG {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
            .floating-star {
                position: absolute;
                width: 8px;
                height: 8px;
                background-color: rgba(200, 230, 255, 0.5);
                border-radius: 50%;
                box-shadow: 0 0 4px rgba(200,230,255,0.6);
                animation: float 3s ease-in-out infinite, twinkle 2s ease-in-out infinite;
            }
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
            .cyber-container {
                /* background: rgba(17, 24, 39, 0.7); */
                border: 1px solid #e2e8f0;
                border-radius: 8px;
                box-shadow: 0 0 15px #e2e8f3c5;
                animation: pulse 3s infinite;
                backdrop-filter: blur(5px);
            }
            .cyber-gradient {
                background: linear-gradient(45deg, #e2e8f0, #e2e8f094, #e2e8f040);
                background-size: 200% 200%;
                animation: gradientBG 10s ease infinite;
            }
            .cyber-text {
                color: #e2e8f0;
                text-shadow: 0 0 5px #e2e8f0;
            }
            .cyber-input {
                background: rgba(30, 41, 59, 0.8);
                border: 1px solid #e2e8f3;
                color: #e2e8f0;
                transition: all 0.3s ease;
            }
            .cyber-input:focus {
                border-color: #e2e8f0;
                box-shadow: 0 0 0 2px #e2e8f3;
                outline: none;
            }
            .cyber-button {
                background: linear-gradient(45deg, #f2f2f2, #e2e8f0);
                color: white;
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
                box-shadow: 0 0 15px white;
            }
            .cyber-button:active {
                transform: translateY(0);
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="michroma-regular antialiased bg-black text-gray-200 h-screen">
        <div class="floating-stars">
            <div class="floating-star" style="top: 10%; left: 20%; animation-delay: 0s;"></div>
            <div class="floating-star" style="top: 40%; left: 70%; animation-delay: 1s;"></div>
            <div class="floating-star" style="top: 75%; left: 15%; animation-delay: 0.5s;"></div>
            <div class="floating-star" style="top: 20%; left: 80%; animation-delay: 1.5s;"></div>
            <div class="floating-star" style="top: 60%; left: 50%; animation-delay: 0.8s;"></div>
            <div class="floating-star" style="top: 15%; left: 30%; animation-delay: 1.2s;"></div>
            <div class="floating-star" style="top: 85%; left: 40%; animation-delay: 0.3s;"></div>
            <div class="floating-star" style="top: 30%; left: 85%; animation-delay: 0.7s;"></div>
            <div class="floating-star" style="top: 50%; left: 10%; animation-delay: 1.8s;"></div>
            <div class="floating-star" style="top: 70%; left: 75%; animation-delay: 0.2s;"></div>
            <div class="floating-star" style="top: 25%; left: 60%; animation-delay: 1.4s;"></div>
            <div class="floating-star" style="top: 90%; left: 25%; animation-delay: 0.9s;"></div>
            <div class="floating-star" style="top: 5%; left: 45%; animation-delay: 1.7s;"></div>
            <div class="floating-star" style="top: 65%; left: 90%; animation-delay: 0.4s;"></div>
            <div class="floating-star" style="top: 35%; left: 5%; animation-delay: 1.1s;"></div>
        </div>
        
        <div class="h-screen flex flex-col justify-center items-center py-4 px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="mb-4 transform hover:scale-105 transition-transform duration-300">
                <img src="{{ asset('storage/logo_bitflow_rombo.png') }}" class=" w-full pt-28 pb-10" alt="Bitflow logo">
            </div>

            <div class="cyber-container w-full sm:max-w-lg px-6 py-6 mb-4 michroma-regular">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
