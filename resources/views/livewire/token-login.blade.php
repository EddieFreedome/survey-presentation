<div class="container">
    <h1>Registrazione</h1>
    <form wire:submit.prevent="submit">
        <label for="name">Nome:</label>
        <input type="text" wire:model="name" placeholder="Inserisci il tuo nome">
        <button type="submit">Accedi</button>
    </form>
</div>