<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class DocumentsModal extends ModalComponent
{
    public Company $company;
    public $documents;

    public function mount(): void
    {
        $this->documents = $this->company->documents;
    }
    public function render(): View
    {
        return view('livewire.companies.modal-documents');
    }
}
