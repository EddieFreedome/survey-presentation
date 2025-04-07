
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Nunito+Sans:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        .fade-in { 
            animation: fadeIn 1s ease-in-out; 
        }
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
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    
    <title>PRONTI?</title>
</head>
<body class="michroma-regular bg-black text-gray-200 relative min-h-screen flex flex-col" style="max-height: 100vh">
    <div class="floating-stars">
        <div class="floating-star" style="top: 10%; left: 20%; animation-delay: 0s;"></div>
        <div class="floating-star" style="top: 40%; left: 70%; animation-delay: 1s;"></div>
        <div class="floating-star" style="top: 75%; left: 15%; animation-delay: 0.5s;"></div>
        <div class="floating-star" style="top: 20%; left: 80%; animation-delay: 1.5s;"></div>
        <div class="floating-star" style="top: 60%; left: 50%; animation-delay: 0.8s;"></div>
    </div>
    
    <header class="w-full">
        <div class="container mx-auto flex justify-center">
            <a href="https://bitflow.it">
                <img src="{{ asset('storage/logo_bitflow_rombo.jpeg') }}" class=" w-full pt-28" alt="Bitflow logo">
            </a>
        </div>
    </header>
    
    <div class="container mx-auto text-center">
    </div>
    <div class="body-container container mx-auto text-center flex-grow flex flex-col justify-start items-center relative z-10 fade-in p-4 sm:p-8 md:p-10 my-10">
        <div class="max-w-2xl mx-auto p-6 rounded-lg border border-gray-700">
            <h1 class="text-2xl pb-4 sm:pb-6">Ciao {{ $name }}!</h1>
            <h2 class="text-xl pb-4 sm:pb-6">Il quiz comincera' tra poco, stai pronto a partire!</h2>
            
            <div class="mt-2">
                @livewire('clicker', ['userId' => $userId])
            </div>
        </div>
        {{-- <div class="max-w-2xl mx-auto p-6 rounded-lg border border-gray-700">
        </div> --}}
        <h1 class="text-lg pb-4 sm:pb-6 pt-10">Ingresso effettuato correttamente!</h1>

    </div>
{{-- 
    <div class="body-container container mx-auto text-center flex-grow flex flex-col justify-start items-center relative z-10 fade-in p-4 sm:p-8 md:p-10 my-10">
        
    
    </div> --}}
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>    <!-- Include all compiled plugins (below), or include individual files as needed -->
</body>
</html>
