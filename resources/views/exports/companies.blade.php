<table>
    <thead>
    <tr>
        @foreach($headers as $header)
            <th style="text-align: center;"><strong>{{ $header }}</strong></th>
        @endforeach
    </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
            <tr>
                <td style="text-align: center;">{{ $company->id }}</td>
                <td>{{ $company->mercantile_name }}</td>
                <td>{{ $company->company_type == 1 ? 'Individual' : 'Jurídica' }}</td>
                <td style="text-align: center">{{ $company->nit }}</td>
                <td>{{ $company->municipality?->name }}</td>
                <td>{{ $company->municipality?->province?->name }}</td>
                <td>{{ $company->village }}</td>
                <td>{{ $company->address }}</td>
                <td>{{ $company->station_address }}</td>
                <td>{{ $company->coverage }}</td>
                <td>{{ $company->owners }}</td>
                <td>{{ $company->legal_representative }}</td>
                <td style="text-align: center">{{ $company->cui }}</td>
                <td style="text-align: center">{{ $company->phone }}</td>
                <td style="text-align: center">{{ $company->emails[0] ?? '' }} {{ $company->emails[1] ?? '' }}</td>
                <td style="text-align: center">{{ $company->users_number }}</td>
                <td style="text-align: center">{{ $company->license == 1 ? 'Activa' : 'Inactiva' }}</td>
                <td style="text-align: center">{{ $company->resolution }}</td>
                <td style="text-align: center">{{ $company->latitude }}</td>
                <td style="text-align: center">{{ $company->longitude }}</td>
                <td style="text-align: center">{{ $company->start_date->format('d/m/Y') }}</td>
                <td style="text-align: center">{{ $company->end_date->format('d/m/Y') }}</td>
                <td style="text-align: center">{{ $company->status == 1 ? 'Activa' : 'Inactiva' }}</td>
                <td style="text-align: center">{{ $company->payment_status  == 1 ? 'Solvente' : 'Morosa' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
