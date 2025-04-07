<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fine!</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
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
            0% { box-shadow: 0 0 5px rgba(255, 255, 255, 0.5), 0 0 10px rgba(255, 255, 255, 0.3); }
            50% { box-shadow: 0 0 15px rgba(255, 255, 255, 0.7), 0 0 20px rgba(255, 255, 255, 0.5); }
            100% { box-shadow: 0 0 5px rgba(255, 255, 255, 0.5), 0 0 10px rgba(255, 255, 255, 0.3); }
        }
        
        .floating-star {
            position: absolute;
            width: 8px;
            height: 8px;
            background-color: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            box-shadow: 0 0 4px rgba(255, 255, 255, 0.6);
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
            position: relative;
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 2rem;
            animation: pulse 3s infinite ease-in-out;
            z-index: 1;
        }
        
        .cyber-button {
            background-color: transparent;
            border: 1px solid white;
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 4px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
        }
        
        .cyber-button:hover {
            background-color: rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.7);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="michroma-regular bg-black">
    <div class="floating-stars">
        <div class="floating-star" style="top: 10%; left: 20%; animation-delay: 0s;"></div>
        <div class="floating-star" style="top: 40%; left: 70%; animation-delay: 1s;"></div>
        <div class="floating-star" style="top: 75%; left: 15%; animation-delay: 0.5s;"></div>
        <div class="floating-star" style="top: 20%; left: 80%; animation-delay: 1.5s;"></div>
        <div class="floating-star" style="top: 60%; left: 50%; animation-delay: 0.8s;"></div>
    </div>
    <div class="cyber-container body-container container mx-auto text-center py-16 px-10 min-h-screen flex flex-col items-center justify-center">
        <div class="container mx-auto flex justify-center">
            <a href="https://bitflow.it">
                <img src="{{ asset('storage/logo_bitflow_rombo.jpeg') }}" class=" w-full pt-28" alt="Bitflow logo">
            </a>
        </div>
        <h1 class="text-4xl pb-10 mt-10 mb-10 text-white">Grazie per aver risposto al questionario!</h1>
        <h2 class="text-xl text-white">Torneremo presto con i risultati, nel frattempo continua a goderti la presentazione ;)</h2>
    </div>
</body>
</html>
