<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trámite {{ $fields['id'] }}</title>
    <style>
        main {
            font-family: 'Calibri', serif;
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
    <p class="black-text" style=" text-align: left">RESOLUCIÓN No. D-UNCOSU-AU-{{ $fields['number'] .'-'. $fields['year'] }}</p>

    @include('documents.authorization-templates.' . $fields['content_name'])

    <strong style="text-align: center;
        position: absolute;
        top: 920px;
        left: 225px">
        {{ env('DIRECTOR_UNCOSU') }}
    </strong>
    <strong style="text-align: center;
        position: absolute;
        top: 935px;
        left: 287px">
        Director -UNCOSU-.
    </strong>
    <img style="text-align: center;
        position: absolute;
        top: 955px;
        left: 300px" src="{{ $fields['qr_code'] }}" alt="CODIGO QR">
</main>
</body>
</html>
