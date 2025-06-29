<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reporte de visita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: xx-small;
            margin: 0.2in;
            padding: 10px;
        }

        .header {
            text-align: center;
            font-size: 15px;
            margin-bottom: 15px;
        }

        .content {
            font-size: 16px;
            line-height: 1.5;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }
        .row {
            flex-wrap: wrap;
        }

        .col {
            flex: 1;
            padding: 5px;
        }

        /* Estilos adicionales para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 5px;
            text-align: left;
        }
        .contenedor-divs::after {
            content: "";
            display: table;
            clear: both;
        }
        .opacity {
            opacity: 0.5;
        }

        .item {
            display: inline-block;
            width: 33%;
        }
    </style>
</head>
<body>
    <div class="contenedor-divs">
        <div class="opacity" style="float: left">
            <img style="width: 75%" src="{{ public_path('assets/img/logo-civ.png') }}" alt="CIV">
        </div>
        <div class="opacity"  style="float: right; ">
            <img src="{{ public_path('assets/img/logo-horizontal-unc.png') }}" alt="UNCOSU">
        </div>
    </div>
    <br>
    <div class="header">
        <strong>INFORME DE SUPERVISIÓN</strong>
    </div>
    <div class="content">
        <table style="font-size: xx-small !important;">
            <tr class="row">
                <td class="col">NOMBRE/SOCIEDAD: {{ $visit->company->mercantile_name }}</td>
                <td class="col">NIT: {{ $visit->company->nit }}</td>
            </tr>
            <tr class="row">
                <td class="col">DIRECCIÓN: {{ $visit->company->address }}</td>
                <td class="col">ESTACIÓN TERRENA: {{ $visit->company->station_address }}</td>
            </tr>
            <tr class="row">
                <td class="col">DEPARTAMENTO: {{ $visit->company->municipality->name }}</td>
                <td class="col">MUNICIPIO: {{ $visit->company->municipality->province->name }}</td>
            </tr>
            <tr class="row">
                <td class="col">TELÉFONO: {{ $visit->company->phone }}</td>
                <td class="col">EMAIL: {{ $visit->company->emails[0] ?? '' }}</td>
            </tr>
            <tr class="row">
                <td class="col">PROPIETARIO: {{ $visit->company->owners }}</td>
                <td class="col">REPRESENTANTE: {{ $visit->company->legal_representative }}</td>
            </tr>
            <tr class="row">
                <td class="col">FECHA DE INSCRIPCIÓN UNCOSU: {{ $visit->company->start_date->format('d/m/Y') }}</td>
                <td class="col">PATENTE DE COMERCIO: </td>
            </tr>
            <tr class="row">
                <td class="col">FECHA DE VENCIMIENTO: {{ $visit->company->end_date->format('d/m/Y') }}</td>
                <td class="col">PATENTE DE SOCIEDAD: </td>
            </tr>
            <tr class="row">
                <td class="col">LEGALMENTE INSCRITA: {{ ($response_visit['authorized'] ?? null) ? 'Sí' : 'No' }}</td>
                <td class="col">AUTORIZADA: </td>
            </tr>
            <tr class="row">
                <td class="col">ÚLTIMO RECIBO PAGADO: {{ $visit->company->pays()->orderBy('id', 'DESC')->first()?->created_at?->format('d/m/Y') }}</td>
                <td class="col">USUARIOS DECLARADOS: {{ $visit->company->users_number }}</td>
            </tr>
            <tr class="row">
                <td class="col">COMPETENCIA: </td>
                <td class="col">COBERTURA: {{ $visit->company->coverage }}</td>
            </tr>
        </table>
        <div class="header">
            SEÑALES ENCONTRADAS EN SUPERVISIÓN
        </div>
        <table style="font-size: xx-small !important;">
            <tr class="row">
                <td class="col">CANALES VARIOS 1: {{ $response_visit['channels']['varios'] ? 'Sí' : 'No' }}</td>
                <td class="col">CANALES VARIOS 2: {{ $response_visit['channels']['varios2'] ? 'Sí' : 'No' }}</td>
            </tr>
        </table>
        <h6>CANALES CON REPRESENTACIÓN</h6>
        <table style="font-size: xx-small !important;">
            @foreach($response_visit['channelsRepresentation'] as $key => $channel_representation)
            <tr class="row">
                <td class="col">{{ $key }}: {{ $channel_representation['active'] ? 'Sí' : 'No' }}</td>
                <td class="col">NOTA: {{ $channel_representation['note'] }}</td>
            </tr>
            @endforeach
        </table>
        <br>
        <table style="font-size: xx-small !important;">
            <tr class="row">
                <td class="col">CALIDAD DE LA SEÑAL: {{ $response_visit['signal_quality'] ?? '' }}</td>
                <td class="col">NÚMERO DE CANALES: {{ $response_visit['number_channels'] ?? '' }}</td>
            </tr>
            <tr class="row">
                <td class="col">PERSONA QUE ATENDIÓ: {{ $response_visit['person_who_attended'] ?? '' }}</td>
                <td class="col">OBSERVACIONES: {{ $response_visit['observations'] ?? '' }}</td>
            </tr>
            <tr class="row">
                <td class="col">SERVICIO DE INTERNET: {{ $response_visit['internetService'] ? 'Sí' : 'No' }}</td>
                <td class="col">CALIDAD DE LA SEÑAL: {{ $response_visit['signal_quality'] ?? '' }}</td>
            </tr>
            <tr class="row">
                <td class="col">RED
                    @if(isset($response_visit['network']['distribution']))
                        <ul>
                            @foreach($response_visit['network']['distribution'] as $distribution)
                                <li>{{ $distribution }}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td class="col">ANTENA
                    @if(isset($response_visit['network']['catchment']))
                        <ul>
                            @foreach($response_visit['network']['catchment'] as $catchment)
                                <li>{{ $catchment }}</li>
                            @endforeach
                        </ul>
                        @endif
                </td>
            </tr>
        </table>
        <br>
        <div class="header">
            CANALES
        </div>
        <table style="font-size: xx-small !important; width: 100%">
            @foreach($response_visit['companyChannels'] as $key => $category)
            <tr>
                <td><span style="font-weight: bold; text-align: center; margin: auto; display: block">{{ $key }}</span>
                    <br>
                    @foreach($category as $channel => $number)
                        <div class="item">{{$channel }}: {{ $number }}</div>
                    @endforeach
                </td>
            </tr>
            @endforeach
    </table>
        <br>
        <br>
        <div class="header">
            IMÁGENES
        </div>
        @foreach($response_visit['images'] as $image)
            <img style="width: 250px; height: 300px; padding-block-start: 20px" src="storage/{{$image}}">
        @endforeach
    </div>
    <div class="footer">
        Asignado: {{ $visit->created_at->format('d/m/Y') }} &nbsp;
        Finalizado: {{ $visit->filling_date?->format('d/m/Y') }} &nbsp;
        Aceptado: {{ $visit->acceptance_date?->format('d/m/Y') }} &nbsp;
        Última visita: {{ $visit->company->visits()->orderBy('id', 'DESC')->first()?->updated_at->format('d/m/Y') }}
    </div>
</body>
</html>
