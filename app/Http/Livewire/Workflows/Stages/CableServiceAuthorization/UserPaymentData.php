<?php

namespace App\Http\Livewire\Workflows\Stages\CableServiceAuthorization;

use App\Http\Workflows\WorkflowManager;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UserPaymentData extends Component
{
    use WithFileUploads;
    public WorkflowRequest $workflowRequest;
    public $voucher, $subscribers_number, $voucher_number, $voucher_amount, $last_stage, $corrections;
    public $rules = [
        'voucher' => ['required', 'file', 'mimes:pdf'],
        'subscribers_number' => ['required', 'numeric', 'min:0'],
        'voucher_number' => ['required', 'numeric', 'min:0'],
        'voucher_amount' => ['required', 'numeric', 'min:0'],
    ];
    public function mount($key): void
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->firstOrFail();
        $this->last_stage = json_decode($this->workflowRequest->getLastStage()->json, true);
        $this->corrections = $this->last_stage['corrections'] ?? [];
    }

    public function submit(): void
    {
        $validate = $this->validate();
        $data = [
            'voucher' => $validate['voucher'] ?? null ? Storage::put('documents', $validate['voucher']) : $this->last_stage['voucher'],
            'subscribers_number' =>  $validate['subscribers_number'] ?? $this->last_stage['subscribers_number'],
            'voucher_number' =>  $validate['voucher_number'] ?? $this->last_stage['voucher_number'],
            'voucher_amount' =>  $validate['voucher_amount'] ?? $this->last_stage['voucher_amount'],
        ];
        $workflowManager = new WorkflowManager($this->workflowRequest);
        $workflowManager->acceptCurrentStage(json_encode($data));

    }
    public function render(): View
    {
        if ($this->workflowRequest->hasPermission()) {
            return view('livewire.workflows.stages.cable-service-authorization.user-payment-data');
        } else {
            return view('errors.403');
        }
    }
}
