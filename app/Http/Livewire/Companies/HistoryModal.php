<?php

namespace App\Http\Livewire\Companies;

use App\Models\Company;
use App\Models\Workflow;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class HistoryModal extends ModalComponent
{
    public Company $company;
    public $history, $visits;

    public function mount(): void
    {
        $visits = $this->company->visits()->where('status', 2)->get()->toArray();
        $this->history = array_merge($this->company->workflows_history ?? [], $visits);
    }
    public function render(): View
    {
        return view('livewire.components.history-modal');
    }
}
