<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz!</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Junge&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="junge-regular">
    <div class="body-container container mx-auto text-center p-20">
        <h1 class="text-4xl pb-10">#1 IL LAVORO CHE MI APPASSIONA</h1>
        <h2 class="text-2xl pb-10">Rivolgetevi all’ Architetto per:</h2>
        <form action="submit" method="post">
            {{-- RENDERE DINAMICO! --}}
            <ul class="pb-10">
                <li class="">
                   <!-- <span class="mark-ok">&#10003;</span> -->
                    <p class="">
                       <strong> Progettazione e ristrutturazioni di appartamenti e immobili </strong>
                    </p>
                </li>
                <li class="">
                   <!-- <span class="mark-ok">&#10003;</span> -->
                    <p class="">
                       <strong>Interni e Illuminazione</strong> 
                    </p>
                </li>
                <li class="">
                   <!-- <span class="mark-ok">&#10003;</span> -->
                    <p class="">
                       <strong> Manutenzioni condominiali </strong> 
                    </p>
                </li>
                <li class="selected">
                   <!-- <span class="mark-ok">&#10003;</span> -->
                    <p class="">
                       <strong> Progettazione di mini hotel e ristoranti </strong> 
                    </p>
                </li>
            </ul>

            <button class="send-btn" type="submit"> <strong> Invia risposte </strong> </button>
            
        </form>
    </div>

    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>