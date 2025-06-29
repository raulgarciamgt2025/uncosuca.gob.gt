<?php

namespace App\Http\Livewire\Workflows\Stages;

use App\Http\Workflows\CompanyManager;
use App\Http\Workflows\PdfHelper;
use App\Http\Workflows\WorkflowManager;
use App\Models\Company;
use App\Models\StateStage;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SignatureAuthorization extends Component
{
    public WorkflowRequest $workflowRequest;
    private PdfHelper $pdfHelper;
    public StateStage $stateStage, $previous_stage;
    public $form, $upload_documents_json, $documents, $observations, $seller, $new_owner, $fields = [], $fields_name,
            $preview_pdf, $pin, $modal_pin = false, $modal_cancel = false, $alert, $signed_opinion, $form_responses;
    public $rules = [];
    public function mount($key): void
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->firstOrFail();
        $this->stateStage = $this->workflowRequest->stateStages[0];
        $this->previous_stage = $this->workflowRequest->getPreviousStage();
        $this->signed_opinion = json_decode($this->previous_stage->json, true);
        $this->upload_documents_json = json_decode($this->stateStage->json, true);
        $this->form = $this->upload_documents_json['form'] ?? [];
        $this->documents = $this->upload_documents_json['documents'] ?? [];
        $this->seller = $this->upload_documents_json['seller'] ?? [];
        $this->new_owner = $this->upload_documents_json['new_owner'] ?? [];
        $this->fields_name = $this->fieldsResolution();
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

    public function preview(): void
    {
        $validate = $this->validate($this->rules);
        $this->pdfHelper = new PdfHelper($this->workflowRequest, $validate['fields'], 2);
        $this->preview_pdf = $this->pdfHelper->generateAuthorizationPdf();
    }

    public function generateAuthorization(): void
    {
        $this->validate([
            'pin' => ['required', 'string']
        ]);
        $this->preview();
        if ( $this->preview_pdf == null)
        {
            $this->preview_pdf = "";
        }
        $response = $this->pdfHelper->singPdf($this->preview_pdf, $this->pin);
        if ($response['result']) {
            $filename = 'generated-documents/resolution_'.$this->workflowRequest->key.'.pdf';
            Storage::put($filename, base64_decode($response['file']));
            $json_data = [
                'authorization' => $filename,
                'description' => 'AUTORIZACIÓN'
            ];
            $this->workflowRequest->resolution_number = 'UNCOSU-AU-'.$this->fields['number'].'-'.date('Y');
            $this->workflowRequest->save();
            $companyManager = new CompanyManager(
                $this->workflowRequest,
                $this->workflowRequest->company ?? null,
                $this->upload_documents_json,
                $filename);
           $workflowManager = new WorkflowManager($this->workflowRequest);
           $companyManager->selectProcess();
           $workflowManager->acceptCurrentStage(json_encode($json_data));
        } else {
            $this->alert = $response['message'];
        }
    }

    public function fieldsResolution(): array
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
            return view('livewire.workflows.stages.signature-authorization');
        } else {
            return view('errors.403');
        }
    }
}
