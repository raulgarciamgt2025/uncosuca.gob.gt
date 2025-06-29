<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class EditModal extends ModalComponent
{
    use WithFileUploads;

    public Company $company;
    public $array_company = [], $location_image;

    public function mount(): void
    {
        $this->array_company['license'] = $this->company->license;
        $this->array_company['cancellation_comment'] = $this->company->cancellation_comment;
        $this->array_company['latitude'] = number_format((float)$this->company->latitude, 6, '.', '');
        $this->array_company['longitude'] = number_format((float)$this->company->longitude, 6, '.', '');
    }

    public function submit(): void
    {
        $this->validate([
            'array_company.license' => ['required', 'integer', 'between:1,2'],
            'array_company.cancellation_comment' => ['nullable', 'string'],
            'array_company.latitude' => ['required', 'decimal:6'],
            'array_company.longitude' => ['required', 'decimal:6'],
            'location_image' => ['required', 'image'],
        ]);
        $this->company->license = $this->array_company['license'];
        $this->company->cancellation_comment = $this->array_company['cancellation_comment'];
        $this->company->latitude = $this->array_company['latitude'];
        $this->company->longitude = $this->array_company['longitude'];
        $this->company->location_image = Storage::put('images', $this->location_image);
        $this->company->save();
        $this->emit('refreshTable');
        $this->closeModal();
    }

    public function render(): View
    {
        return view('livewire.companies.edit-modal');
    }
}
