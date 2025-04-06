<div class="p-4 mt-20 bg-gray-900 rounded-lg shadow-lg fade-in">
    {{-- In work, do what you enjoy. --}}
    <button class="px-6 py-3 mr-4 bg-blue-600 text-gray-200 rounded-lg hover:bg-blue-700 transition duration-200 ease-in-out"  
        wire:click="startQuiz" 
        wire:confirm="Are you sure you want to START the quiz?"> 
        <strong class="michroma-regular">START QUIZ</strong> 
    </button>
    <button class="px-6 py-3 bg-gray-700 text-gray-200 rounded-lg hover:bg-gray-600 transition duration-200 ease-in-out"  
        wire:click="resetQuiz" 
        wire:confirm="Are you sure you want to RESET the quiz?"> 
        <strong class="michroma-regular">RESET</strong> 
    </button>
</div>
