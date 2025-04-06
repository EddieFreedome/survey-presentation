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
     .neon-text {
       color: #e0faff;
       text-shadow: 0 0 5px #e0faff, 0 0 10px #e0faff, 0 0 20px rgba(0,255,255,0.4), 0 0 30px rgba(0,255,255,0.3);
       animation: pulse 1.5s ease-in-out infinite alternate;
     }
   
     @keyframes pulse {
       from { opacity: 0.8; }
       to { opacity: 1; }
     }
   
     /* Optional glowing container */
     .glow-container {
       border: 1px solid rgba(255,255,255,0.2);
       padding: 2rem;
       border-radius: 8px;
       box-shadow: 0 0 10px rgba(0,255,255,0.2);
     }
    </style>
</head>
<body class="michroma-regular bg-black">
    <div class="body-container container mx-auto text-center p-10 min-h-screen flex flex-col items-center justify-center">
        <div class="glow-container">
        <div class="img-container">
            <img src="{{ asset('storage/LOGO_CLAUDIA_SECCHI.jpg')}}" alt="logo claudia secchi">
        </div>
        <h1 class="text-4xl pb-10 neon-text">Grazie per aver risposto al questionario!</h1>
        <h2 class="text-xl neon-text">Torneremo presto con i risultati, nel frattempo continua a goderti la presentazione ;)</h2>
        </div>
    </div>
</body>
</html>
