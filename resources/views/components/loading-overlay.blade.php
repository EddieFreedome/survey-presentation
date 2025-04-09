<div id="loading-overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: black; z-index: 9999; display: flex; justify-content: center; align-items: center;">
    <img src="{{ asset('storage/Pittogramma-White.png') }}" alt="Loading" class="rotating-logo">
</div>

<style>
    @keyframes rotateAntiClockwise {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(-360deg);
        }
    }

    .rotating-logo {
        animation: rotateAntiClockwise 1s linear infinite;
        max-width: 100px; /* Adjust size as needed */
    }
</style>