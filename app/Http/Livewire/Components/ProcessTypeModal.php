<?php

namespace App\Http\Livewire\Components;

use App\Models\WorkflowRequest;
use DateTime;
use LivewireUI\Modal\ModalComponent;

class ProcessTypeModal extends ModalComponent
{
    public $workflow, $type;

    /**
     * @throws \Exception
     */
    public function submit($type): void
    {
        /*
            type = 1: Individual
            type = 2: Jurídico
        */
        $this->workflow['process_type'] = $type;
        $this->emit('confirmProcessType', $this->workflow);
    }
    public function render()
    {
        return view('livewire.components.process-type-modal');
    }
}
