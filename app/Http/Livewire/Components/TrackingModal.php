<?php

namespace App\Http\Livewire\Components;

use App\Models\WorkflowRequest;
use DateTime;
use LivewireUI\Modal\ModalComponent;

class TrackingModal extends ModalComponent
{
    public WorkflowRequest $workflowRequest;
    public $key, $data, $finish = null, $stages;

    /**
     * @throws \Exception
     */
    public function mount(): void
    {
        $this->workflowRequest =  WorkflowRequest::where('key', $this->key)->firstOrFail();
        $this->stages = $this->workflowRequest->stateStages;
        if ($this->workflowRequest->end_date) {
            $date1 = new DateTime($this->workflowRequest->stateStages[0]?->updated_at);
            $date2 = new DateTime($this->workflowRequest->end_date);
            $this->finish = $date1->diff($date2)->format('%d días %h horas y %i minutos');
        }
    }
    public function render()
    {
        return view('livewire.components.tracking-modal');
    }
}
