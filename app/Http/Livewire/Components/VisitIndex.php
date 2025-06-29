<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class VisitIndex extends Component
{
    public function getChannels(): array
    {
        return [
            'AMPRO',
            'INTERESES EN EL ITSMO',
            'PROSAT',
            'CPTV(Mosinsa)',
            'HBO',
            'MEDIA PLAN',
            'ROLA(FOX)',
        ];
    }

    public function getDistributionsNetwork(): array
    {
        return [
            'FIBRA ÓPTICA',
            'RG6',
            'RG11',
            'RG500',
            'FIBRA DROP',
        ];
    }

    public function getSignalPickup(): array
    {
        return [
            'MALLAS',
            'SKY',
            'DIRECT',
            'SÓLIDAS',
            'CHANEL MASTER',
            'CLARO',
        ];
    }

    public function getDocumentsDeliver()
    {
        return [
            'PATENTE DE COMERCIO',
            'PATENTE DE SOCIEDAD',
            'RTU QUE ACREDITE COMO PROPIETARIO',
            'LICENCIA DE AUTORIZACIÓN DE LA UNIDAD VIGENTE',
            'CONTRATOS CON PROGRAMADORES Y/O CERTIFICACIÓN DE PROGRAMADORES',
            'FORMULARIO DE PAGOS RECUPERADOS',
        ];
    }

}
