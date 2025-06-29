<?php

namespace App\Http\Livewire\Workflows;

use App\Http\Livewire\Components\ProcessTypeModal;
use App\Http\Workflows\WorkflowManager;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class MyRequests extends ProcessTypeModal
{
    use AuthorizesRequests;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public ?WorkflowRequest $workflow_request;
    public $search, $modal_ranking = false, $message, $stars, $ranking_void;

    public function mount(): void
    {
        $this->workflow_request = WorkflowRequest::whereRaw('request_user_id = '.auth()->id().' AND state = 2 AND ranking IS NULL')->first();
        if (!$this->workflow_request) {
            $this->modal_ranking = true;
        }
    }

    public function countStars($stars): void
    {
        $this->stars = $stars;
        $this->ranking_void = false;
    }
    public function setRanking(): void
    {
        if ($this->stars > 0) {
            $this->ranking_void = false;
            if ($this->workflow_request) {
                $this->workflow_request->ranking = [
                    'stars' => $this->stars,
                    'message' => $this->message
                ];
                $this->workflow_request->save();
                $this->modal_ranking = false;
            }
        } else {
            $this->ranking_void = true;
        }
    }
    public function showRequest(WorkflowRequest $workflowRequest): void
    {
        $workflowManager = new WorkflowManager($workflowRequest);
        $workflowManager->dispatchCurrentStage(route('workflows-my-requests'));
    }
    public function render(): View
    {
        $workflowRequests = WorkflowRequest::where('request_user_id', auth()->id())->search($this->search ?? '')
            ->orderby('created_at', 'desc')
            ->paginate(10);
        return view('livewire.workflows.my-requests', compact('workflowRequests'));
    }
}
