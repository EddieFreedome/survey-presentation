
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Junge&display=swap" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    
    <title>PRONTI?</title>
</head>
<body class="junge-regular h-full">
    
    <div class="body-container container mx-auto text-center p-20 h-full flex flex-col justify-center">
        {{-- <div class="body-container container mx-auto text-center px-10 "> --}}
            <div class="img-container flex h-auto justify-center ">
                <img id="logo" class="inline-block" src="{{ asset('storage/LOGO_CLAUDIA_SECCHI.jpg') }}"
                    alt="">
            </div>
            <h1 class="text-2xl pb-8">Login effettuato correttamente!</h1>
            <h1 class="text-2xl pb-8">Ciao {{ $name }}!</h1>
            <h2 class="text-xl pb-8">Il quiz comincera' tra poco, stai pronto a partire!</h2>
    
            <livewire:clicker/>
            {{-- @livewire('clicker') --}}
    
            <div class="form-container text-center pt-28">
                {{-- <form class="text-center" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"  onclick="event.preventDefault(); this.closest('form').submit();"
                        class="send-btn btn-light">
                        <strong>Log Out</strong>
                    </a>
                </form> --}}
            </div>
    
    
        {{-- </div> --}}
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>    <!-- Include all compiled plugins (below), or include individual files as needed -->
</body>
</html>