<?php

namespace App\Http\Livewire\Pays\Users;

use App\Models\Company;
use App\Models\Pay;
use App\Models\UserCompany;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class NewPayModal extends ModalComponent
{
    use WithFileUploads;
    
    public $company_id, $month, $year, $companies = [];
    public $estado, $usuarios, $total, $fecha_pago, $numero_formulario, $observaciones;
    public $pdf_document;
    
    public $months = [
        1 => 'Enero',
        2 => 'Febrero',
        3 => 'Marzo',
        4 => 'Abril',
        5 => 'Mayo',
        6 => 'Junio',
        7 => 'Julio',
        8 => 'Agosto',
        9 => 'Septiembre',
        10 => 'Octubre',
        11 => 'Noviembre',
        12 => 'Diciembre'
    ];
    
    public $estados = [
        'CUOTA' => 'CUOTA',
        'INSCRIPCION' => 'INSCRIPCION'
    ];

    public function mount(): void
    {
        // Get companies assigned to current user only
        $userCompanies = auth()->user()->assignedCompanies()->with('company')->get();
        
        // Only show assigned companies
        $this->companies = $userCompanies->pluck('company.mercantile_name', 'company_id')->toArray();
        
        // Set default month and year
        $this->month = date('n'); // Current month
        $this->year = date('Y'); // Current year
        $this->fecha_pago = date('Y-m-d'); // Default to today
        $this->estado = 'CUOTA'; // Default to CUOTA
        
        // If user has only one company, auto-select it
        if (count($this->companies) === 1) {
            $this->company_id = array_key_first($this->companies);
        }
    }

    public function submit(): void
    {
        $this->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'month' => ['required', 'integer', 'between:1,12'],
            'year' => ['required', 'integer', 'min:2023', 'max:' . (date('Y') + 1)],
            'estado' => ['required', 'in:CUOTA,INSCRIPCION'],
            'usuarios' => ['required', 'integer', 'min:0'],
            'total' => ['required', 'numeric', 'min:0'],
            'fecha_pago' => ['required', 'date'],
            'numero_formulario' => ['required', 'string', 'max:255'],
            'observaciones' => ['nullable', 'string', 'max:1000'],
            'pdf_document' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // Max 10MB PDF
        ]);

        // Verify user is assigned to the selected company
        $userCompany = auth()->user()->assignedCompanies()
            ->where('company_id', $this->company_id)
            ->first();
            
        if (!$userCompany) {
            $this->addError('company_id', 'No tiene permisos para crear pagos para esta empresa.');
            return;
        }

        // Check if payment already exists for this company, month, and year
        $existingPay = Pay::where('company_id', $this->company_id)
            ->where('mount', sprintf('%02d', $this->month))
            ->where('year', $this->year)
            ->first();

        if ($existingPay) {
            $this->addError('month', 'Ya existe un pago para esta empresa en el mes y año seleccionado.');
            return;
        }

        // Handle PDF file upload
        $ticketFilePath = null;
        if ($this->pdf_document) {
            $ticketFilePath = $this->pdf_document->store('payments', 'public');
        }

        // Create new payment record
        Pay::create([
            'company_id' => $this->company_id,
            'mount' => sprintf('%02d', $this->month),
            'year' => $this->year,
            'status' => 0, // Pending status
            'pay' => $this->usuarios,
            'amount' => $this->total,
            'variable' => 0,
            'penalty' => 0,
            'ticket_number' => $this->numero_formulario,
            'ticket_file' => $ticketFilePath,
            'rejections' => null,
            'subscribers_number' => $this->usuarios,
            'estado' => $this->estado,
            'fecha_pago' => $this->fecha_pago,
            'observaciones' => $this->observaciones,
        ]);

        $this->closeModal();
        $this->emit('refreshTable');
        $this->emit('showAlert', [
            'type' => 'success',
            'message' => 'Nuevo pago creado exitosamente.'
        ]);
    }

    public function render(): View
    {
        return view('livewire.pays.users.new-pay-modal');
    }
}
