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
    <link href="https://fonts.googleapis.com/css2?family=Junge&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="junge-regular">
    <div class="body-container container mx-auto text-center p-20">       
        <div class="img-container">
            <img src="{{ asset('storage/LOGO_CLAUDIA_SECCHI.jpg')}}" alt="logo claudia secchi">
        </div>
        <h1 class="text-4xl pb-10">Grazie per aver risposto al questionario!</h1>
        <h2 class="text-xl">Torneremo presto con i risultati, nel frattempo continua a goderti la presentazione ;)</h2>
    </div>
</body>
</html>