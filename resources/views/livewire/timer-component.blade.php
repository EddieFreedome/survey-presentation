{{-- Because she competes with no one, no one can compete with her. --}}
<div class="pb-5">
    <h1 class="text-xl">00:{{ $timeRemaining }}</h1>
</div>

<script>
    setInterval(function() {
        @this.call('decrementTime');
    }, 1000);
</script>
