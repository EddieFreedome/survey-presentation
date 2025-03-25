<div>
    {{-- The Master doesn't talk, he acts. --}}
    <form wire:submit.prevent="nextstep">
        <input type="hidden" name="nextquestionId" value="{{ $question['nextquestion_id'] }}">                           
        <input type="hidden" name="questionId" value="{{ $question['id'] }}">                           

        @csrf
        <ul class="pb-10">
            @foreach ($answers as $answer)  
                <li wire:click="toggleSelection( {{ $answer['id'] }} )" 
                    class=" {{ in_array($answer['id'], $selAnswers) ? 'selected' : '' }} answer answer-{{ $answer['id'] }}"id="answer.{{ $answer['id'] }}" data-answer-id="{{ $answer['id'] }}" value="{{ $answer['id'] }}">
                    <strong> {{ $answer['text'] }} </strong>
                </li>
            @endforeach            
            {{-- div di test con livewire --}}
            {{-- <div>
                <div wire:click="toggleSelection('Option 1')" style="cursor: pointer; background-color: {{ in_array('Option 1', $selAnswers) ? 'lightblue' : 'white' }}">Option 1</div>
                <div wire:click="toggleSelection('Option 2')" style="cursor: pointer; background-color: {{ in_array('Option 2', $selAnswers) ? 'lightblue' : 'white' }}">Option 2</div>
                <div wire:click="toggleSelection('Option 3')" style="cursor: pointer; background-color: {{ in_array('Option 3', $selAnswers) ? 'lightblue' : 'white' }}">Option 3</div>
                <div wire:click="toggleSelection('Option 4')" style="cursor: pointer; background-color: {{ in_array('Option 4', $selAnswers) ? 'lightblue' : 'white' }}">Option 4</div>
                <div>
                    Selected Values:
                    @foreach($selAnswers as $value)
                        {{ $value }},
                    @endforeach
                </div>
            </div> --}}
        </ul>
        <button id="submit-btn" class="send-btn" type="submit"> 
            <strong>Invia risposte</strong> 
           
        </button>
    </form>
</div>

@script
    <script>           
        // interval for submit button at countdown
        setInterval(() => {
            $wire.nextstep()
        }, 40000);
    </script>
@endscript


