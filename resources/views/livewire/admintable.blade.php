<div>
    {{-- The whole world belongs to you. --}}
    
        <table class="">
            <thead>
                <tr class="row text-left ">
                    <th  class="">Nome</th>
                    <th  class="">Risposte corrette</th>
                    <th  class="">Tempo totale di risposta</th>
                </tr>
            </thead>

            <tbody>      
                 
                 @foreach ($results as $result )
                    <tr class="row">
                        <td class="">{{ $result['username'] }}</td>
                        <td  class="">{{ $result['points'] }}</td>
                        <td  class="">{{ $result['tot_time_answering'] }}</td>
                    </tr>
                @endforeach
                
                
                 @foreach($session as $user_session)
                    <tr class="row">
                        <td class="">{{ $results['name'] }}</td>
                        <td  class="">{{ $results['tot_points'] }}</td>
                        <td  class="">{{ $results['tot_time_answering'] }}</td>
                    </tr>
                @endforeach     
             </tbody>

        </table>      

    </div>

</div>


