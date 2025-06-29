<table>
    <thead>
    <tr>
        @foreach($headers as $header)
            <th style="text-align: center;"><strong>{{ $header }}</strong></th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($pays as $pay)
            <tr>
                <td style="text-align: center;">{{ $pay->id }}</td>
                <td style="text-align: center;">{{ $pay->company->mercantile_name }}</td>
                <td style="text-align: center;">{{ $statuses[$pay->status] ?? '' }}</td>
                <td style="text-align: center;">{{ $pay->year }}</td>
                <td style="text-align: center;">{{ $mounts[$pay->mount] }}</td>
                <td style="text-align: center;">Q.{{ $pay->pay }}</td>
                <td style="text-align: center;">Q.{{ $pay->ticket_number }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
