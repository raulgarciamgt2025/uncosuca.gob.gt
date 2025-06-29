<?php

namespace App\Http\Livewire\Companies;

use App\Exports\CompanyFormat;
use App\Imports\CompanyImport;
use App\Mail\UserNotify;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CompanyIndex extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;
    public $modalImport = false, $file, $errors_array, $companies_beat = false;

    public function mount(): void
    {
        $this->authorize('Lista empresas');
    }

    public function showModal():void
    {
        $this->modalImport = true;
    }
    public function excelExport(): void
    {
        $this->emit('exportCompanies');
    }

    public function showCompaniesBeat($bool)
    {
        $this->companies_beat = $bool;
    }

    public function import()
    {
        $this->errors_array =  null;
        $this->validate([
            'file' => ['required', 'file', 'mimes:xlsx']
        ]);
        $import = new CompanyImport();
        Excel::import($import, $this->file);
        $response  = $import->getResponse();
        if (!$response['result']) {
            $this->errors_array = $response;
        } else {
            $this->modalImport = false;
            $this->emit('refreshTable');
            $this->emit('showAlert', ['type' => 'success', 'message' => 'Se han cargados todos los registros']);
        }
    }

    public function clearErrors()
    {
        $this->errors_array = null;
    }

    public function downloadFormat(): BinaryFileResponse
    {
        $array[] = [
            'NOMBRE EMPRESA',
            'DENOMINACIÓN SOCIAL',
            'NIT',
            'DIRECCIÓN',
            'DIRECCIÓN DE ESTACIÓN TERRENA',
            'COBERTURA',
            'PROPIETARIOS',
            'MUNICIPIO',
            'ALDEA',
            'CUI',
            'TELÉFONO',
            'USUARIOS',
            'ESTADO DE LICENCIA (1: Vigente, 0: Vencida)',
            'CORREO 1',
            'CORREO 2',
            'LATITUD',
            'LONGITUD',
            'REPRESENTANTE LEGAL',
            'RESOLUCIÓN',
            'FECHA INICIO',
            'FECHA FIN',
            'ESTADO (1: Activa, 0: Inactiva)',
            'ESTADO DE CUENTA (1: Solvente, 0: Morosa)',
            'TIPO DE EMPRESA (1: Individual, 2: Jurídica)',
        ];
        return Excel::download(new CompanyFormat($array), 'formato-empresas.xlsx');
    }

    public function render(): View
    {
        return view('livewire.companies.company-index');
    }
}
