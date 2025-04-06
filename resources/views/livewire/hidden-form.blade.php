<div class="flex flex-col bg-gray-900 rounded-lg p-6 text-gray-200 max-h-screen">
    <h1 class="text-2xl pb-8 michroma-regular text-gray-200">#{{ $question->id}} <br> {{ $question->title }}</h1>
    <form wire:submit.prevent="nextstep">
        <input type="hidden" name="nextquestionId" value="{{ $question->nextquestion_id }}">                           
        <input type="hidden" name="questionId" value="{{ $question->id }}">                           

        @csrf
        <ul class="pb-10">
            @foreach ($answers as $answer)  
                <li wire:click="toggleSelection({{ $answer->id }})" 
                    class="{{ in_array($answer->id, $selAnswers) ? 'selected' : '' }} answer answer-{{ $answer->id }} hover:bg-gray-800 transition duration-150" id="answer.{{ $answer->id }}" data-answer-id="{{ $answer->id }}" value="{{ $answer->id }}
                    nunito-sans-400">
                    <strong> {{ $answer->text }} </strong>
                </li>
            @endforeach            
            
        </ul>
        <button id="submit-btn" class="send-btn bg-gray-800 text-gray-200 px-4 py-2 rounded-md hover:bg-gray-700 transition duration-300 ease-in-out" type="submit"> 
            <strong>Invia risposte</strong> 
           
        </button>
    </form>
</div>

