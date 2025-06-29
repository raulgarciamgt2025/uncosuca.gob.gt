<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de {{ $department->name }}</title>
    <style>
        main {
            font-family: 'Arial', serif;
            font-size: 15px;
            margin: 0.2in;
        }

        .black-text {
            font-weight: bold!important;
        }

        h1 {
            text-align: center;
            font-weight: bold;
        }

        /* No eliminar esta clase porque se usa en los archivos de contenido que se incluyen */
        .justify {
            text-align: justify;
        }

        .text-center {
            text-align: center;
        }

        .opacity {
            opacity: 0.5;
        }

        .contenedor-divs::after {
            content: "";
            display: table;
            clear: both;
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
<main>
    <p class="black-text text-center">
        INFORME DE SUPERVISIÓN
    </p>
    <p class="text-center">
        SUPERVISIÓN OFICIAL AL DEPARTAMENTO DE {{ mb_strtoupper($department->name) }}, DEL {{ $start_date }} AL {{ $end_date }}
        SEGÚN REQUERIMIENTOS DE TRASLADO NO. {{ $requirements }}.
    </p>
    <table style="width: 100%">
        <thead >
            <th style="text-align: left">Empresa</th>
            <th style="text-align: left">Fecha</th>
            <th style="text-align: left">Municipio</th>
        </thead>
        <tbody>
            @foreach($visits as $key => $visit)
                <tr>
                    <td>{{ $key + 1 .'. '. $visit->company?->mercantile_name }}</td>
                    <td>{{ $visit->filling_date->format('d/m/Y') }}</td>
                    <td>{{ $visit->company?->municipality?->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</main>
<div style="position: fixed; bottom: 0; width: 100%; text-align: center; font-size: smaller!important;">
    <p>
        UNIDAD DE CONTROL Y SUPERVISIÓN <br>
        Avenida la reforma 16 calle 15-54, Zona 9, 4to. Nivel Oficina 401. Edificio Reforma Obelisco <br>
        PBX: (502) 2243-5300 - Línea gratuita: 1563 <br>
        Unidad de Control y Supervisión - www.uncosu.gob.gt
    </p>
</div>
</body>
</html>
