@extends('layouts.user')

@section('content')
    


{{-- <div class="body-container container mx-auto text-center px-10 "> --}}
        <div class="img-container flex h-auto justify-center ">
            <img id="logo" class="inline-block" src="{{ asset('storage/LOGO_CLAUDIA_SECCHI.jpg') }}"
                alt="">
        </div>

        <h1 class="text-2xl pb-8">Login effettuato correttamente!</h1>
        <h1 class="text-2xl pb-8">Ciao {{ Auth::user()->name }}!</h1>
        <h2 class="text-xl pb-8">Il quiz comincera' tra poco, stai pronto a partire!</h2>

        <livewire:clicker/>
        {{-- @livewire('clicker') --}}

        <div class="form-container text-center pt-28">
            <form class="text-center" method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"  onclick="event.preventDefault(); this.closest('form').submit();"
                    class="send-btn btn-light">
                    <strong>Log Out</strong>
                </a>
            </form>
        </div>


    {{-- </div> --}}


@endsection