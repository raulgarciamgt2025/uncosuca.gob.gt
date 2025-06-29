<?php

namespace App\Http\Livewire\Workflows;

use App\Models\Workflow;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class UpdateSteps extends Component
{
    public Collection $workflows;
    public Workflow $workflowSelected;
    public string $jsonData;
    public function mount(): void
    {
        $this->workflows = Workflow::get();
    }

    public function selectWorkflow(Workflow $workflow): void
    {
        $this->workflowSelected = $workflow;
        $this->jsonData = $this->workflowSelected->requirements;
        $this->emit('showJson', [
            'jsonData' => $this->jsonData,
        ]);
    }

    public function save(): void
    {
        try {
            json_decode($this->jsonData, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON: ' . json_last_error_msg());
            }
            $this->workflowSelected->update([
                'requirements' => $this->jsonData,
            ]);
            $this->emit('showAlert', [
                'type' => 'success',
                'message' => 'Requisitos actualizados correctamente'
            ]);
        } catch (\Exception $e) {
            $this->addError('jsonData', $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.workflows.update-steps');
    }
}
