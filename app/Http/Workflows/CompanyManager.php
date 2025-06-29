<?php

namespace App\Http\Workflows;

use App\Models\Company;
use App\Models\Municipality;
use App\Models\WorkflowRequest;
use DateTime;

class CompanyManager
{
    private array $proceedings;
    private string $resolution_url;
    private ?Company $company;
    private WorkflowRequest $workflowRequest;
    public function __construct($workflowRequest, $company, $proceedings, ?string $resolution_url = null)
    {
        $this->proceedings = $proceedings;
        $this->company = $company;
        $this->workflowRequest = $workflowRequest;
        $this->resolution_url = $resolution_url;
    }

    public function selectProcess(): void
    {
        $workflow_type = $this->workflowRequest->workflow->type;
        switch ($workflow_type) {
            case 1:
                $this->newCompany();
                break;
            case 2:
                $this->coverageExpansion();
                break;
            case 3:
                $this->renewAuthorization();
                break;
            case 4:
                $this->purchaseSaleAuthorization();
                break;
            case 5:
                $this->cancelAuthorization();
                break;
            case 6:
                $this->socialReasonChange();
                break;
            default:
                $this->nameOrOwnerChange();
        }
    }

    public function newCompany(): void
    {
        // TRAMITE 1
        $form = $this->proceedings['form'];
        $start_date = new DateTime();
        $history = [
            $this->saveHistory(date('Y-m-d'))
        ];
        if ($this->workflowRequest->process_type == 1) {
            if (isset($form['co_owners'])) {
                $owners = $form['owner_name']['response'] .', '. $form['co_owners']['response'];
            } else {
                $owners = $form['owner_name']['response'];
            }
        } else {
            $owners = $form['social_denomination']['response'] ?? null;
        }
        $company = Company::create([
            'mercantile_name'       => $form['mercantile_company_name']['response'] ?? null,
            'social_denomination'   => $form['social_denomination']['response'] ?? null,
            'nit'                   => $form['nit']['response'] ?? null,
            'address'               => $form['address_to_notify']['response'] ?? null,
            'station_address'       => $form['earth_station_address']['response'] ?? null,
            'coverage'              => $form['place_of_distribution']['response'] ?? null,
            'owners'                => $owners,
            'emails'                => [$form['email']['response'] ?? null],
            'village'               => $form['village']['response'] ?? null,
            'cui'                   => $form['dpi']['response'] ?? null,
            'phone'                 => $form['mobile_number']['response'] ?? null .', '. $form['phone_number']['response'] ?? null,
            'users_number'          => $form['number_of_subscribers']['response'] ?? null,
            'license'               => 1, // No sé a que se refieren con este campo
            'resolution'            => $this->workflowRequest->resolution_number ?? null,
            'start_date'            => $start_date->format('Y-m-d'),
            'end_date'              => $start_date->modify('+15 years')->format('Y-m-d'),
            'status'                => 1,
            'payment_status'        => 0,
            'company_type'          => $this->workflowRequest->process_type,
            'workflows_history'     => $history,
            'user_id'               => $this->workflowRequest->request_user_id,
            'municipality_id'       => Municipality::search($form['municipality']['response'] ?? '')->first()?->id,
        ]);

        $company->assignedUsers()->create([
            'user_id' => $this->workflowRequest->request_user_id
        ]);
    }

    public function coverageExpansion(): void
    {
        // TRAMITE 2
        $form = $this->proceedings['form'];
        $this->company->coverage = $form['place_of_extension']['response'] ?? '';
        $history = $this->company->workflows_history;
        $history[] = $this->saveHistory(date('Y-m-d'));
        $this->company->workflows_history = $history;
        $this->company->save();
    }
    public function renewAuthorization(): void
    {
        // TRAMITE 3
        $start_date = new DateTime();
        $this->company->resolution = $this->workflowRequest->resolution_number ?? null;
        $this->company->start_date = $start_date->format('Y-m-d');
        $this->company->end_date = $start_date->modify('+15 years')->format('Y-m-d');
        $history = $this->company->workflows_history;
        $history[] = $this->saveHistory(date('Y-m-d'));
        $this->company->workflows_history = $history;
        $this->company->save();
    }
    public function purchaseSaleAuthorization(): void
    {
        // TRAMITE 4
        // TODO: NADA-SOLO AUTORIZACIÓN (Eso indicó UNCOSU en la reunión)
    }
    public function cancelAuthorization(): void
    {
        // TRAMITE 5
        $this->company->status = 0;
        $this->company->license = 0;
        $history = $this->company->workflows_history;
        $history[] = $this->saveHistory(date('Y-m-d'));
        $this->company->workflows_history = $history;
        $this->company->save();
    }
    public function socialReasonChange(): void
    {
        // TRAMITE 6
        $form = $this->proceedings['form'];
       // $this->company->
    }
    public function nameOrOwnerChange(): void
    {
        // TRAMITE 7
    }
    public function saveHistory($start_date): array
    {
        return [
            'process_type' => $this->workflowRequest->workflow->type,
            'key' => $this->workflowRequest->key,
            'resolution_url' => $this->resolution_url,
            'resolution_date' => $start_date
        ];
    }
}
