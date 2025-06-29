<?php

namespace App\Http\Livewire\Consults;

use App\Models\WorkflowRequest;
use DateTime;
use Livewire\Component;

class VerifyDocument extends Component
{
    public ?WorkflowRequest $workflowRequest;
    public $begin_date, $end_date, $first_stage, $resolution, $pdf_resolution;
    public function mount($key): void
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->first();
        $this->first_stage = json_decode( $this->workflowRequest->stateStages[0]->json ?? '{}', true);
        $this->resolution = $this->workflowRequest->stateStages[5] ?? [];
        $this->begin_date = $this->resolution->updated_at->format('d-m-Y');
        $begin_date = new DateTime($this->begin_date);
        $begin_date->modify('+15 years');
        $this->resolution = json_decode($this->resolution->json, true);
        $this->end_date = $begin_date->format('d-m-Y');

    }
    public function render()
    {
        return view('livewire.consults.verify-document');
    }
}
