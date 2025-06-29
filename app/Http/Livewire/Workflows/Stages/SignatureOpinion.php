<?php

namespace App\Http\Livewire\Workflows\Stages;

use App\Http\Workflows\PdfHelper;
use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\StateStage;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class SignatureOpinion extends Component
{
    public WorkflowRequest $workflowRequest;
    private PdfHelper $pdfHelper;
    public StateStage $stateStage;
    public $form, $upload_documents_json, $documents, $observations, $seller, $new_owner, $fields = [], $fields_name,
            $preview_pdf, $pin, $modal_pin = false, $modal_cancel = false, $alert, $form_responses;
    public $rules = [];
    public function mount($key): void
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->firstOrFail();
        $this->stateStage = $this->workflowRequest->stateStages[0];
        $this->upload_documents_json = json_decode($this->stateStage->json, true);
        $this->form = $this->upload_documents_json['form'] ?? [];
        $this->documents = $this->upload_documents_json['documents'] ?? [];
        $this->seller = $this->upload_documents_json['seller'] ?? [];
        $this->new_owner = $this->upload_documents_json['new_owner'] ?? [];
        $this->fields_name = $this->fieldsOpinion();
        $this->fields_name[] = 'number';
        $this->form_responses = array_merge($this->form, $this->seller, $this->new_owner);
        foreach ($this->fields_name as $field) {
            $this->fields[$field] = $field == 'number' ? '' : $this->form_responses[$field]['response'] ?? null;
            $this->rules['fields.'.$field] = ['required', 'string'];
        }
    }
    public function showModal($modal): void
    {
        $this->$modal = true;
    }
    public function cancelProcess(): void
    {
        $this->validate([
            'observations' => ['required', 'string']
        ]);
        $data = [
            'subject' =>  $this->workflowRequest->workflow->name,
            'title' => 'El proceso ha sido anulado',
            'subtitle' => 'Tu trámite fue rechazado por el siguiente motivo:',
            'description' => $this->observations,
            'key' => $this->workflowRequest->key
        ];
        Mail::to($this->workflowRequest->user->email)->send(new UserNotify($data));
        $this->workflowRequest->state = 3;
        $this->workflowRequest->end_date = date('Y-m-d H:i:s');
        $this->workflowRequest->save();
        $workflowManager = new WorkflowManager($this->workflowRequest);
        $observations = json_encode([
            'observations' => $this->observations
        ]);
        $workflowManager->acceptCurrentStage($observations);
    }

    public function preview(): void
    {
        $validate = $this->validate($this->rules);
        $this->pdfHelper = new PdfHelper($this->workflowRequest, $validate['fields'], 1);
        $this->preview_pdf = $this->pdfHelper->generateDictamenPdf();
    }

    public function generateOpinion(): void
    {
        $this->preview();
        $json_data = [
            'opinion' => $this->preview_pdf,
            'description' => 'DICTAMEN FAVORABLE'
        ];
        $workflowManager = new WorkflowManager($this->workflowRequest);
        $workflowManager->acceptCurrentStage(json_encode($json_data));
    }
    public function fieldsOpinion(): array
    {
        $type = $this->workflowRequest->process_type;
        $workflow_type = $this->workflowRequest->workflow->type;
        if ($type == 1) {
            $fields = match ($workflow_type) {
                1, 2, 3 => [
                    'owner_name',
                    'mercantile_company_name',
                    'department',
                    'municipality'
                ],
                7 => [
                    'owner_name',
                    'previous_mercantile_name',
                    'actual_mercantile_name',
                ],
                default => []
            };
        } elseif ($type == 2) {
            $fields = match ($workflow_type) {
                1, 2, 3 => [
                    'social_denomination',
                    'legal_representative_name',
                    'mercantile_company_name',
                    'department',
                    'municipality',
                ],
                7 => [
                    'name_owner_of_unit',
                    'mercantile_company_name_of_unit',
                    'registered_entity_name',
                ],
                default => []
            };
        } else {
            $fields = match ($workflow_type) {
                4 => [
                    'name_or_social_denomination',
                    'mercantile_company_name',
                    'new_owner_name_or_social_denomination'
                ],
                5 => [
                    'social_denomination',
                    'legal_representative_name',
                ],
                6 => [
                    'name_owner_of_unit',
                    'mercantile_company_name_of_unit',
                    'registered_entity_name',
                    'mercantile_company_name_register',
                    'representative_name'
                ],
                default => []
            };
        }
        return $fields;
    }
    public function render(): View
    {
        if ($this->workflowRequest->hasPermission()) {
            return view('livewire.workflows.stages.signature-opinion');
        } else {
            return view('errors.403');
        }
    }
}
