<div>
    {{-- The whole world belongs to you. --}}
    
    <div class="overflow-x-auto">
        <table class="min-w-full bg-gray-900 text-gray-200 border border-gray-700 rounded-lg shadow-lg">
            <thead class="bg-gray-800">
                <tr class="text-left">
                    <th class="px-4 py-2 border-b border-gray-700 text-gray-200">Nome</th>
                    <th class="px-4 py-2 border-b border-gray-700 text-gray-200">Risposte corrette</th>
                    <th class="px-4 py-2 border-b border-gray-700 text-gray-200">Tempo totale di risposta</th>
                </tr>
            </thead>

            <tbody>      
                 
                 {{-- @foreach ($results as $result )
                    <tr class="hover:bg-gray-800 transition duration-150">
                        <td class="px-4 py-2 border-b border-gray-700 text-gray-200">{{ $result['username'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-700 text-gray-200">{{ $result['points'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-700 text-gray-200">{{ $result['tot_time_answering'] }}</td>
                    </tr>
                @endforeach --}}
                
                
                 {{-- @foreach($session as $user_session)
                    <tr class="hover:bg-gray-800 transition duration-150">
                        <td class="px-4 py-2 border-b border-gray-700 text-gray-200">{{ $results['name'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-700 text-gray-200">{{ $results['tot_points'] }}</td>
                        <td class="px-4 py-2 border-b border-gray-700 text-gray-200">{{ $results['tot_time_answering'] }}</td>
                    </tr>
                @endforeach      --}}
             </tbody>
        </table>
    </div>
</div>
