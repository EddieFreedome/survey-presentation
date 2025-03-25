<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrati!</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="{{ route('login') }}" class="text-xl">Login</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="container mx-auto text-center p-20">
        {{ $slot }}    
    </main>  
    {{-- <script>
        window.history.pushState(null, '', window.location.href);
        window.onpopstate = function(event) {
            if (confirm("Sei sicuro di voler tornare indietro?")) {
                window.history.go(-1);
            } else {
                window.history.pushState(null, '', window.location.href);
            }
        };
    </script>   --}}
</body>
</html>