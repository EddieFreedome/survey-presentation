
<div class="container">
    <div class="flex-col">

        


    </div>
    <h1 class="text-2xl pb-4">Registrazione</h1>
    <form wire:submit.prevent="submit" class="flex flex-col">
        <label for="name">Nome:</label>
        <input type="text" wire:model="name" placeholder="Inserisci il tuo nome">
        <button type="submit">Entra</button>
    </form>
</div>


