<x-guest-layout>
    <!-- Session Status -->
    {{-- <x-auth-session-status class="mb-4" :status="session('status')" /> --}}

    <div class="w-full max-w-md px-6 py-4 mx-auto">
        <div class="py-15 px-15">

            <div class="text-center mb-6">
                <h1 class="text-2xl font-normal text-white mb-2">ACCEDI AL QUIZ</h1>
                <p class="text-gray-400">Inserisci un nome univoco per continuare</p>
            </div>

            <div class=" p-8  shadow-white/20">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- name -->
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium text-white mb-2">{{ __('Nome') }}</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fa-solid fa-user text-gray-500"></i>
                            </span>
                            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus 
                                class="w-full pl-5 pr-3 py-2 bg-gray-800/80 border border-gray-700 rounded-md focus:outline-none focus:ring-2 focus:ring-white focus:border-transparent text-gray-200 placeholder-gray-500"
                                placeholder="Enter your name">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    {{-- <div class="flex items-center mb-6">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" 
                                class="rounded border-gray-700 bg-gray-800 text-black shadow-sm focus:ring-white focus:ring-opacity-50" 
                                name="remember">
                            <span class="ml-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                        </label>
                    </div> --}}

                    <div class="flex flex-col space-y-4">
                        <button type="submit" 
                            class="w-full py-2 px-4 border border-solid-1 border-white bg-gradient-to-r from-grey to-grey-200 hover:from-cyan-700 hover:to-cyan-500 text-white font-bold rounded-md shadow-lg shadow-white/20 transition-all duration-200 transform hover:translate-y-[-2px] focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-opacity-50">
                            {{ __('ENTRA') }}
                        </button>
                        
                        {{-- @if (Route::has('register'))
                            <div class="text-center text-sm text-gray-400">
                                {{ __('Don\'t have an account?') }} 
                                <a href="{{ route('register') }}" class="text-white hover:text-cyan-300 transition-colors">
                                    {{ __('Register') }}
                                </a>
                            </div>
                        @endif --}}
                    </div>
                </form>
            </div>
            
            <div class="mt-6 text-center">
                <div class="inline-flex items-center justify-center">
                    <span class="h-px w-16 bg-gray-700"></span>
                    <span class="mx-4 text-xs text-gray-500 uppercase">Secure Connection</span>
                    <span class="h-px w-16 bg-gray-700"></span>
                </div>
                <p class="mt-2 text-xs text-gray-500">
                    <i class="fa-solid fa-shield-halved mr-1"></i> 
                    {{ __('One-time token authentication system') }}
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
