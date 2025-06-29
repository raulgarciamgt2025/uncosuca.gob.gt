<?php

namespace App\Http\Livewire\Workflows\Stages;

use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\Department;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadDocuments extends Component
{
    use WithFileUploads;
    public WorkflowRequest $workflowRequest;
    public $workflow, $documents = [], $form = [], $seller = [], $new_owner_data = [], $requirements, $inputs = [],
        $correction, $correction_fields, $modal_cancel = false, $observations, $departments, $municipalities, $department,
        $municipality, $new_owner_department, $new_owner_municipality;
    // Reglas para datos generales o más usados
    public $rules = [
        'inputs.dpi' => ['nullable', 'numeric', 'digits:13'],
        'inputs.new_owner_dpi' => ['nullable', 'numeric', 'digits:13'],
        'inputs.new_owner_nit' => ['nullable', 'string', 'max:15'],
        'inputs.nit' => ['nullable', 'string', 'max:15'],
        'inputs.new_owner_phone_number' => ['nullable', 'numeric', 'digits:8'],
        'inputs.new_owner_mobile_number' => ['nullable', 'numeric', 'digits:8'],
        'inputs.phone_number' => ['nullable', 'numeric', 'digits:8'],
        'inputs.mobile_number' => ['nullable', 'numeric', 'digits:8'],
        'inputs.municipality' => ['nullable', 'exists:municipalities,name'],
        'inputs.new_owner_municipality' => ['nullable', 'exists:municipalities,name'],
    ];
    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }
    public function mount($key): void
    {
        $this->workflowRequest = WorkflowRequest::where('key', $key)->firstOrFail();
        $this->workflow = $this->workflowRequest->workflow;
        $this->correction = json_decode($this->workflowRequest->getLastStage()?->json ?? '{}', true);
        $this->correction_fields = $this->correction['corrections'] ?? [];
        $department_keys = ['department', 'new_owner_department', 'municipality', 'new_owner_municipality'];
        $validate = false;
        foreach ($department_keys as $key) {
            if (array_key_exists($key, $this->correction_fields)) {
                $validate = true;
                break;
            }
        }
        if ($validate) {
            $this->correction_fields['department'] = 'Departamento';
            $this->correction_fields['new_owner_department'] = 'Departamento';
            $this->correction_fields['municipality'] = 'Departamento';
            $this->correction_fields['new_owner_municipality'] = 'Departamento';
        }
        $this->departments = Province::get(['id', 'name']);
        $requirements = json_decode($this->workflow->requirements, true);
        if ($this->workflow->double_process && $this->workflowRequest->process_type) {
            if ($this->workflowRequest->process_type == 1) {
                $this->form = $requirements['individual']['form'] ?? [];
                $this->documents = $requirements['individual']['documents']?? [];
            } else {
                $this->form = $requirements['juridic']['form']?? [];
                $this->documents = $requirements['juridic']['documents']?? [];
            }
        } else {
            if (isset($requirements['seller']['form']) && isset($requirements['new_owner']['form'])) {
                $this->seller = $requirements['seller']['form'];
                $this->new_owner_data = $requirements['new_owner']['form'];
            } else {
                $this->form = $requirements['form'] ?? [];
            }
            $this->documents = $requirements['documents'] ?? [];
        }
        $this->requirements = array_merge($this->form, $this->documents, $this->seller, $this->new_owner_data);
        foreach ($this->requirements as $item) {
            $required = $item['required'] != '' ? 'required' : 'nullable';
            $accept = !isset($item['type']) ? 'mimes:pdf' : 'not_regex:/[\'"]+/';
            $type = match ($item['type'] ?? null) {
                'text', 'department', 'municipality' => 'string',
                'number' => 'numeric',
                'email' => 'email',
                'date' => 'date',
                default => 'file',
            };
            if ($this->rules['inputs.' . $item['name']] ?? null) {
                $this->rules['inputs.' . $item['name']][0] = $required;
            } else {
                $this->rules['inputs.' . $item['name']] = [$required, $type, $accept];
            }
            if (!key_exists($item['name'], $this->correction_fields)) {
                $value = $this->correction['form'][$item['name']] ?? $this->correction['documents'][$item['name']] ?? [];
            } else {
                $this->rules['inputs.' . $item['name']][0] = 'required';
            }
            $this->inputs[$item['name']] = $value['response'] ?? null;
            $value = null;
        }
    }

    public function updateMunicipalityList($department_name): void
    {
        $department_id = $this->inputs['department'] ?? $this->inputs['new_owner_department'];
        if (key_exists('municipality', $this->inputs)) {
            $this->inputs['municipality'] = null;
        } else {
            $this->inputs['new_owner_municipality'] = null;
        }
        $this->municipalities = Municipality::where('province_id', $department_id)->get(['id', 'name']);
        $this->department = $department_name;
    }

    public function showModalCancel(): void
    {
        $this->modal_cancel = true;
    }

    public function cancelProcess(): void
    {
        $this_stage = $this->workflowRequest->getLastStage();
        $this->workflowRequest->state = 4;
        $this->workflowRequest->end_date = date('Y-m-d H:i:s');
        $this_stage->json = json_encode([
            'observations' => $this->observations
        ]);
        $this->workflowRequest->save();
        $this_stage->save();
        session()->flash('success', 'Se ha notificado al usuario.');
        $this->redirect('/workflows-my-requests');
    }
    public function submit(): void
    {
        $this->validate($this->rules);
        $form = $this->correction['form'] ?? [];
        $documents = $this->correction['documents'] ?? [];
        $seller = $this->correction['seller'] ?? [];
        $new_owner = $this->correction['new_owner'] ?? [];
        $collect = collect($this->requirements);
        if (isset($this->inputs['department'])) {
            $this->inputs['department'] = $this->department;
        } else {
            $this->inputs['new_owner_department'] = $this->department;
        }
        foreach ($this->inputs as $key => $input) {
            $description = $collect->where('name', $key)->first();
            if (!str_contains($key, 'documents')) {
                if (count($this->seller) > 0) {
                    if (str_contains($key, 'new_owner')) {
                        $new_owner[$key] = [
                            'description' => $description['label'] ?? '',
                            'response' => $input ?? null
                        ];
                    } else {
                        $seller[$key] = [
                            'description' => $description['label'] ??  '',
                            'response' => $input ?? null
                        ];
                    }
                } else {
                    $form[$key] = [
                        'description' => $description['label'] ??  '',
                        'response' => $input ?? null
                    ];
                }
            } else {
                $documents[$key] = [
                    'description' => $description['label'] ?? '',
                    'url' => $input ? Storage::put('documents', $input) : null
                ];
            }
        }
        $json_data = [
            'form' => $form,
            'documents' => $documents,
            'seller' => $seller,
            'new_owner' => $new_owner
        ];
        // Correo a Auxiliar y Jefe de Registro
        if (count($this->correction_fields) > 0) {
            $subject ='Actualización de expediente';
            $subtitle ='El solicitante ha realizado las correcciones dadas por el auxiliar de registro';
        } else {
            $subject ='Nueva solicitud realizada';
            $subtitle ='Se ha generado una nueva solicitud en el sistema';
        }
        $data = [
            'subject' =>  $subject,
            'title' => $this->workflowRequest->workflow->name,
            'subtitle' => $subtitle,
            'description' => '',
            'key' => $this->workflowRequest->key
        ];
        $auxiliaries = Department::find(1)->users()->pluck('email')->toArray();
        $manager = Department::find(1)->user()->pluck('email')->toArray();
        Mail::to(array_merge($auxiliaries, $manager))->send(new UserNotify($data));
        // Correo para el solicitante
        $data = [
            'subject' =>  $this->workflowRequest->workflow->name,
            'title' => $this->workflowRequest->workflow->name,
            'subtitle' => 'Tu formulario se ha cargado exitosamente',
            'description' => 'Se procederá con la revisión de los requisitos, recuerda estar al pendiente de tu correo y revisar la plataforma constantemente para darle seguimiento al proceso.',
            'key' => $this->workflowRequest->key
        ];
        Mail::to($this->workflowRequest->user->email)->send(new UserNotify($data));
        $this->workflowRequest->state = 1;
        $this->workflowRequest->save();
        $workflowManager = new WorkflowManager($this->workflowRequest);
        $workflowManager->acceptCurrentStage(json_encode($json_data));
    }
    public function render(): View
    {
        if ($this->workflowRequest->hasPermission()) {
            return view('livewire.workflows.stages.upload-documents');
        } else {
            return view('errors.403');
        }
    }
}
