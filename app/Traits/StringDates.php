<?php
namespace App\Traits;
use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\Department;
use Illuminate\Support\Facades\Mail;

trait StringDates
{
    function stringDate($day, $mount, $year): string
    {
        $days = [
            1 => 'UNO',
            2 => 'DOS',
            3 => 'TRES',
            4 => 'CUATRO',
            5 => 'CINCO',
            6 => 'SEIS',
            7 => 'SIETE',
            8 => 'OCHO',
            9 => 'NUEVE',
            10 => 'DIEZ',
            11 => 'ONCE',
            12 => 'DOCE',
            13 => 'TRECE',
            14 => 'CATORCE',
            15 => 'QUINCE',
            16 => 'DIECISÉIS',
            17 => 'DIECISIETE',
            18 => 'DIECIOCHO',
            19 => 'DIECINUEVE',
            20 => 'VEINTE',
            21 => 'VEINTIUNO',
            22 => 'VEINTIDÓS',
            23 => 'VEINTITRÉS',
            24 => 'VEINTICUATRO',
            25 => 'VEINTICINCO',
            26 => 'VEINTISÉIS',
            27 => 'VEINTISIETE',
            28 => 'VEINTIOCHO',
            29 => 'VEINTINUEVE',
            30 => 'TREINTA',
            31 => 'TREINTA Y UNO'
        ];
        $mounts = [
            1 => 'ENERO',
            2 => 'FEBRERO',
            3 => 'MARZO',
            4 => 'ABRIL',
            5 => 'MAYO',
            6 => 'JUNIO',
            7 => 'JULIO',
            8 => 'AGOSTO',
            9 => 'SEPTIEMBRE',
            10 => 'OCTUBRE',
            11 => 'NOVIEMBRE',
            12 => 'DICIEMBRE'
        ];
        $years = [
            2023 => 'DOS MIL VEINTITRÉS',
            2024 => 'DOS MIL VEINTICUATRO',
            2025 => 'DOS MIL VEINTICINCO',
            2026 => 'DOS MIL VEINTISÉIS',
            2027 => 'DOS MIL VEINTISIETE',
            2028 => 'DOS MIL VEINTIOCHO',
            2029 => 'DOS MIL VEINTINUEVE',
            2030 => 'DOS MIL TREINTA',
            2031 => 'DOS MIL TREINTA Y UNO',
            2032 => 'DOS MIL TREINTA Y DOS',
            2033 => 'DOS MIL TREINTA Y TRES',
            2034 => 'DOS MIL TREINTA Y CUATRO',
            2035 => 'DOS MIL TREINTA Y CINCO',
            2036 => 'DOS MIL TREINTA Y SEIS',
            2037 => 'DOS MIL TREINTA Y SIETE',
            2038 => 'DOS MIL TREINTA Y OCHO',
            2039 => 'DOS MIL TREINTA Y NUEVE',
            2040 => 'DOS MIL CUARENTA'
        ];
        $day =  $day < 10 ? ltrim($day, '0') : $day;
        $mount =  $mount < 10 ? ltrim($mount, '0') : $mount;
        return $days[$day].' DE '.$mounts[$mount].' DEL AÑO '.$years[$year];
    }
}
