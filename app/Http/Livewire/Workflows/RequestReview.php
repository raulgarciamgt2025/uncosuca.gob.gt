<?php

namespace App\Http\Livewire\Workflows;

use App\Http\Workflows\WorkflowManager;
use App\Models\WorkflowRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class RequestReview extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $this->authorize('Lista solicitudes asignadas');
        $workflowRequests = WorkflowRequest::where('state',  1)->orderBy('created_at', 'DESC')->get();
        foreach ($workflowRequests as $key => $workflow) {
            if (!$workflow->hasPermission()) {
                unset($workflowRequests[$key]);
            }
        }
        $actual_page = LengthAwarePaginator::resolveCurrentPage();
        $paginator = new LengthAwarePaginator(
            $workflowRequests->forPage($actual_page, 10),
            $workflowRequests->count(),
            10,
            $actual_page,
            ['path' => LengthAwarePaginator::resolveCurrentPath()]
        );
        return view('livewire.workflows.request-review', [
            'workflowRequests' => $paginator->items(),
            'links' => $paginator->links()
        ]);
    }

    public function showRequest(WorkflowRequest $workflowRequest): void
    {
        $workflowManager = new WorkflowManager($workflowRequest);
        $workflowManager->dispatchCurrentStage(route('workflows-review-requests'));
    }
}
