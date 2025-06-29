<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class ModalAddDocument extends ModalComponent
{
    use WithFileUploads;

    public Company $company;
    public $description, $observations, $url;

    public function submit(): void
    {
        $validate = $this->validate([
            'description' => ['required', 'string'],
            'observations' => ['nullable', 'string'],
            'url' => ['required', 'file', 'mimes:pdf'],
        ]);
        $validate['url'] = Storage::put('documents', $this->url);
        $this->company->documents()->create($validate);
        $this->emit('showAlert', [
            'type' => 'success',
            'message' => 'Documento cargado correctamente'
        ]);
        $this->emit('refreshTable');
        $this->closeModal();
    }

    public function render(): View
    {
        return view('livewire.companies.modal-add-document');
    }
}
