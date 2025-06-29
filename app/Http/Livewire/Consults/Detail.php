<?php

namespace App\Http\Livewire\Consults;

use App\Models\User;
use App\Models\Workflow;
use App\Models\WorkflowRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use DateTime;

class Detail extends Component
{
    use AuthorizesRequests;
    public WorkflowRequest $workflowRequest;
    public $steps, $form, $documents, $seller, $new_owner, $upload_documents_json, $finish, $ranking, $modal_history = false,
            $history;

    public function mount($key): void
    {
        $this->authorize('viewHistory', User::class);
        $this->workflowRequest = WorkflowRequest::where('key', $key)->first();
        $this->steps = $this->workflowRequest->stateStages;
        $this->ranking = $this->workflowRequest->ranking;

        // DATOS PARA EL PRIMER PASO
        $this->upload_documents_json = json_decode($this->workflowRequest->stateStages[0]->json, true);
        $this->form = $this->upload_documents_json['form'] ?? [];
        $this->documents = $this->upload_documents_json['documents'] ?? [];
        $this->seller = $this->upload_documents_json['seller'] ?? [];
        $this->new_owner = $this->upload_documents_json['new_owner'] ?? [];
        if ($this->workflowRequest->state == 2) {
            $date1 = $this->workflowRequest->stateStages[0]?->updated_at;
            $date2 = $this->workflowRequest->end_date;
            $this->finish = $date1->diff($date2)->format('%d días %h horas y %i minutos');
        }
    }

    public function showModalHistory($stage_type): void
    {
        $this->modal_history = true;
        $stage = $this->workflowRequest->stateStages()->where('type', $stage_type)->first();
        $this->history = $stage->history;
    }

    public function render()
    {
        return view('livewire.consults.detail');
    }
}
