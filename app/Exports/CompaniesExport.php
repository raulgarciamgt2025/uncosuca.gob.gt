<?php

namespace App\Exports;

use App\Models\Company;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

class CompaniesExport  extends StringValueBinder implements FromView, ShouldAutoSize, WithCustomValueBinder
{
    public array $companies;

    public function __construct($companies) {
        $this->companies = $companies;
    }

    public function view(): View
    {
        $headers = [
            "Número",
            "Nombre",
            "Tipo",
            "NIT",
            "Municipio",
            "Departamento",
            "Aldea",
            "Dirección",
            "Estación",
            "Cobertura",
            "Propietarios",
            "Representante Legal",
            "DPI",
            'Teléfonos',
            'Correos',
            'Usuarios',
            'Licencia',
            'Resolución',
            'Latitud',
            'Longitud',
            'Inicio',
            'Fin',
            'Estado',
            'Pagos',
        ];
        return view('exports.companies', [
            'companies' => Company::find($this->companies),
            'headers' => $headers
        ]);
    }
}
