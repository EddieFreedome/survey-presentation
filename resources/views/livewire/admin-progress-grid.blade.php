<div class="p-4" wire:poll.3s>
    <h2 class="text-2xl mb-4 text-white">Progress Tracking</h2>
    <div class="overflow-x-auto overflow-y-auto max-h-screen rounded-lg shadow-lg">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg">
            <thead class="bg-gray-100">
                <tr>
                    <th class="sticky top-0 px-6 py-3 text-left border-b font-semibold">Utente</th>
                    @foreach($questions as $index => $question)
                        <th class="sticky top-0 px-6 py-3 text-center border-b font-semibold">
                            {{ $index + 1 }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-3 border-b">{{ $user->name }}</td>
                        @foreach($questions as $index => $question)
                            <td class="px-6 py-3 text-center border-b">
                                @if($user->currentQuestionIndex !== null && $user->currentQuestionIndex == $index)
                                    @if(isset($user->finished) && $user->finished)
                                        <!-- If the user has finished the quiz, display a green indicator on the last question column -->
                                        <span class="inline-block w-5 h-5 bg-green-500 rounded-full shadow-sm"></span>
                                    @else
                                        <!-- Otherwise, display a blue indicator for the current question -->
                                        <span class="inline-block w-5 h-5 bg-blue-500 rounded-full shadow-sm"></span>
                                    @endif
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
