    {{-- Stop trying to control. --}}
   
    <a href="{{ route('start') }}" wire:poll.500ms="redirectUserIfAdminsession" id="start-quiz" class="" type="submit"> </a href="{{ route('start') }}">
