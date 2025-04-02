{{-- Because she competes with no one, no one can compete with her. --}}
<div class="pb-5">
    <h1 class="text-xl text-white michroma-regular">00:{{ str_pad($timeRemaining, 2, '0', STR_PAD_LEFT) }}</h1>
</div>

<script>
    setInterval(function() {
        @this.call('decrementTime');
    }, 1000);
</script>
