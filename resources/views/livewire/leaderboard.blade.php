<div class="p-4" wire:poll.5s>
    <h2 class="text-2xl mb-4 text-white">Leaderboard</h2>
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left border-b">Position</th>
                    <th class="px-4 py-2 text-left border-b">User</th>
                    <th class="px-4 py-2 text-center border-b">Total Points</th>
                    <th class="px-4 py-2 text-center border-b">Correct</th>
                    <th class="px-4 py-2 text-center border-b">Wrong</th>
                    <th class="px-4 py-2 text-center border-b">Time Answered (s)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaderboardData as $index => $session)
                    <tr class="hover:bg-gray-50 @if($index == 0) bg-yellow-100 @endif">
                        <td class="px-4 py-2 border-b text-center">{{ $index + 1 }}</td>
                        <td class="px-4 py-2 border-b">{{ $session->user->name }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $session->tot_points }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $session->tot_correct }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $session->tot_wrong }}</td>
                        <td class="px-4 py-2 border-b text-center">{{ $session->tot_time_answering }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    @if(count($leaderboardData) == 0)
        <div class="text-center py-4 text-gray-500">
            No leaderboard data available yet.
        </div>
    @endif
</div>