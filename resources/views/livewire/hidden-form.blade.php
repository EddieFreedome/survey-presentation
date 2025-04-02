<div style="max-height: 100vh" class="flex flex-col text-white">
    <h1 class="text-2xl pb-8 michroma-regular">#{{ $question->id}} <br> {{ $question->title }}</h1>
    <form wire:submit.prevent="nextstep">
        <input type="hidden" name="nextquestionId" value="{{ $question->nextquestion_id }}">                           
        <input type="hidden" name="questionId" value="{{ $question->id }}">                           

        @csrf
        <ul class="pb-10">
            @foreach ($answers as $answer)  
                <li wire:click="toggleSelection({{ $answer->id }})" 
                    class="{{ in_array($answer->id, $selAnswers) ? 'selected' : '' }} answer answer-{{ $answer->id }}" id="answer.{{ $answer->id }}" data-answer-id="{{ $answer->id }}" value="{{ $answer->id }}
                    nunito-sans-400">
                    <strong> {{ $answer->text }} </strong>
                </li>
            @endforeach            
            
        </ul>
        <button id="submit-btn" class="send-btn" type="submit"> 
            <strong>Invia risposte</strong> 
           
        </button>
    </form>
</div>

