<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Michroma&family=Nunito+Sans:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    
    <title>Admin Dashboard!</title>
    <style>
        .admin-card {
            background-color: #121212;
            border: 1px solid #333;
            border-radius: 4px;
        }
    </style>
</head>
<body class="michroma-regular bg-black text-gray-200">
    
    <div class="body-container container mx-auto text-center p-20 h-full flex flex-col justify-center">
        {{-- @yield('content') --}}
        <h1 class="text-3xl pb-5 text-white">Admin dashboard</h1>

       <div class="table-container flex justify-center flex-col admin-card p-6">
        {{-- Progress Grid Component --}}
        @livewire('admin-progress-grid')

        {{-- Leaderboard Component --}}
        <div class="mt-20 admin-card p-4">
            @livewire('leaderboard')
        </div>
        {{-- Admin Clicker Component --}}
        <div class="mt-8 admin-card p-4">
            @livewire('admin-clicker')
        </div>

        </div>
              
        <div class="form-container text-center pt-28">
            {{-- <form class="text-center" method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); this.closest('form').submit();"
                    class="send-btn">
                    <strong>Log Out</strong>
                </a>
                
            </form> --}}
            
        </div>

        {{-- <div class="form-container text-center pt-28">    
    
            <form method="POST" action="{{ route('logout') }}">
                @csrf
    
                <a href=""  onclick="event.preventDefault(); alert('sei sicuro?'); this.closest('form').submit();"
                    class="send-btn">
                    <strong>RESET SURVEY</strong>
                </a>
            </form>
        
        </div> --}}


        {{-- <div class="form-container text-center pt-10">    
    
            <form method="POST" action="{{ route('logout') }}">
                @csrf
    
                <a href=""  onclick="event.preventDefault(); alert('sei sicuro?'); this.closest('form').submit();"
                    class="send-btn">
                    <strong>START SURVEY</strong>
                </a>
            </form>
        
        </div> --}}


    </div>
    {{-- @yield('content') --}}

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>    <!-- Include all compiled plugins (below), or include individual files as needed -->
</body>
</html>
