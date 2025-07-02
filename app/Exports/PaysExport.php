<?php

namespace App\Exports;

use App\Models\Pay;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;

class PaysExport  implements FromView, ShouldAutoSize
{
    public array $pays, $mounts;

    public function __construct($pays, $mounts) {
        $this->pays = $pays;
        $this->mounts = $mounts;
    }

    public function view(): View
    {
        $headers = [
            'Número',
            'Empresa',
            'Estado',
            'Tipo',
            'Año',
            'Mes',
            'Usuarios',
            'Total',
            'Fecha Pago',
            'No. Formulario',
            'Observaciones',
            'Fecha Transacción'
        ];
        return view('exports.pays', [
            'pays' => Pay::find($this->pays),
            'headers' => $headers,
            'mounts' => $this->mounts,
            'statuses' => ['PENDIENTE', 'EN REVISIÓN', 'APROBADO', 'RECHAZADO']
        ]);
    }
}
