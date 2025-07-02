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
                <td style="text-align: center;">{{ $pay->estado ?: '-' }}</td>
                <td style="text-align: center;">{{ $pay->year }}</td>
                <td style="text-align: center;">{{ $mounts[$pay->mount] ?? '-' }}</td>
                <td style="text-align: center;">{{ $pay->pay ?: '0' }}</td>
                <td style="text-align: center;">Q.{{ number_format($pay->amount ?: 0, 2) }}</td>
                <td style="text-align: center;">{{ $pay->fecha_pago ? $pay->fecha_pago->format('d/m/Y') : '-' }}</td>
                <td style="text-align: center;">{{ $pay->ticket_number ?: '-' }}</td>
                <td style="text-align: center;">{{ $pay->observaciones ?: '-' }}</td>
                <td style="text-align: center;">{{ $pay->fecha_transaccion ? $pay->fecha_transaccion->format('d/m/Y H:i') : '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
