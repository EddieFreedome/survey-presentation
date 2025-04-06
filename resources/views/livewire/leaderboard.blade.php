<div class="p-4" wire:poll.5s>
    <h2 class="text-2xl mb-4 text-white">Leaderboard</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-900 border border-gray-700 rounded-lg overflow-hidden">
            <thead class="bg-gray-800">
                <tr>
                    <th class="px-4 py-2 text-left border-b border-gray-700 text-gray-200">Position</th>
                    <th class="px-4 py-2 text-left border-b border-gray-700 text-gray-200">User</th>
                    <th class="px-4 py-2 text-center border-b border-gray-700 text-gray-200">Total Points</th>
                    <th class="px-4 py-2 text-center border-b border-gray-700 text-gray-200">Correct</th>
                    <th class="px-4 py-2 text-center border-b border-gray-700 text-gray-200">Wrong</th>
                    <th class="px-4 py-2 text-center border-b border-gray-700 text-gray-200">Time Answered (s)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaderboardData as $index => $session)
                    <tr class="hover:bg-gray-800 transition duration-200 @if($index == 0) bg-yellow-900 @endif">
                        <td class="px-4 py-2 border-b border-gray-700 text-center text-gray-200">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b border-gray-700 text-gray-200">{{ $session->user->name }}</td>
                        <td class="px-4 py-2 border-b border-gray-700 text-center text-gray-200">{{ $session->tot_points }}</td>
                        <td class="px-4 py-2 border-b border-gray-700 text-center text-gray-200">{{ $session->tot_correct }}</td>
                        <td class="px-4 py-2 border-b border-gray-700 text-center text-gray-200">{{ $session->tot_wrong }}</td>
                        <td class="px-4 py-2 border-b border-gray-700 text-center text-gray-200">{{ $session->tot_time_answering }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if(count($leaderboardData) == 0)
        <div class="text-center py-4 text-gray-200">
            No leaderboard data available yet.
        </div>
    @endif
</div>
