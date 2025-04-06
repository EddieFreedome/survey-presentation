<div class="container mx-auto bg-gray-900 rounded-lg p-6 text-gray-200 shadow-lg max-w-md">
    <div class="flex-col">
    </div>
    <h1 class="text-2xl pb-4 michroma-regular">Registrazione</h1>
    <form wire:submit.prevent="submit" class="flex flex-col space-y-4">
        <label for="name" class="text-gray-200">Nome:</label>
        <input type="text" wire:model="name" placeholder="Inserisci il tuo nome" class="bg-gray-800 border border-gray-700 rounded-md px-4 py-2 text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="bg-black text-gray-200 px-4 py-2 rounded-md hover:bg-gray-800 transition duration-300 ease-in-out mt-4">Entra</button>
    </form>
</div>

