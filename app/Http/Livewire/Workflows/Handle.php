<?php

namespace App\Http\Livewire\Workflows;

use App\Models\WorkflowRequest;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;

class Handle extends Component
{
    public function mount(WorkflowRequest $workflowRequest): void
    {
        //dd($workflowRequest->stateStages);
    }

    public function render()
    {
        return view('livewire.workflows.handle');
    }
}
