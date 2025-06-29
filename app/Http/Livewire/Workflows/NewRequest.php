<?php

namespace App\Http\Livewire\Workflows;

use App\Http\Workflows\WorkflowManager;
use App\Models\StateStage;
use App\Models\WorkflowRequest;
use DB;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class NewRequest extends Component
{
    use AuthorizesRequests;

    public $requirements = false, $workflow_requirements, $requirements_fields, $form, $documents, $seller, $new_owner;
    protected $listeners = ['confirmProcessType' => 'create'];
    public function create($data): void
    {
        DB::beginTransaction();
        $workflowRequest = WorkflowRequest::create([
            'workflow_id' => $data['id'],
            'start_date' => date('Y-m-d H:i:s'),
            'status_log' => json_encode([]),
            'process_type' => $data['process_type'] ?? null,
        ]);
        $steps =  json_decode($data['steps'], true);
        $workflowManager = new WorkflowManager($workflowRequest);
        $stages = $workflowManager->getWorkflowStages();
        if ($stages) {
            foreach ($stages as $index => $stage) {
                StateStage::create([
                    'workflow_request_id' => $workflowRequest->id,
                    'stage' => $index,
                    'type' => $steps[$index]['type'] ?? null,
                    'department_id' => $steps[$index]['department'] ?? null,
                    'description' => $steps[$index]['description'] ?? null,
                    'manager' => $steps[$index]['manager'] ?? null,
                ]);
            }
            DB::commit();
            if ($workflowRequest->hasPermission()) {
                $workflowManager->dispatchCurrentStage(route('workflows-my-requests'));
            } else {
                redirect(route('workflows-my-requests'));
            }
        }
    }

    public function showRequirementsModal(array $workflow): void
    {
        $this->requirements = true;
        $this->workflow_requirements = $workflow;
        $this->requirements_fields = json_decode($workflow['requirements'] ?? '{}', true);
    }

    public function render(): View
    {
        $this->authorize('Crear solicitudes');
        $workflowsAvailable = WorkflowManager::getWorkflowAvailable();
        return view('livewire.workflows.new-request', compact('workflowsAvailable'));
    }
}
