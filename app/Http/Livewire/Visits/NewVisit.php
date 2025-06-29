<?php

namespace App\Http\Livewire\Visits;

use App\Mail\UserNotify;
use App\Models\Channel;
use App\Models\Company;
use App\Models\CompanyChannel;
use App\Models\Municipality;
use App\Models\Province;
use App\Models\User;
use App\Models\Visit;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class NewVisit extends Component
{
    public $company_id, $supervisor_id, $channels, $channels_id = [], $departments, $department, $municipality, $municipalities, $companies;
    public ?Company $company;

    public function mount(): void
    {
        $this->departments = Province::all();
        $this->companies = Company::where('status', 1)->pluck('mercantile_name', 'id')->toArray();
        $this->municipalities = Municipality::all();
        $this->channels = Channel::get()->toArray();
    }
    public function showChannels(): void
    {
        if ($this->company_id) {
            $this->company = Company::find($this->company_id);
            $this->updateChannels();
        }
    }

    public function changeDepartment(): void
    {
        $this->municipality = null;
        if ($this->department) {
            $this->municipalities = Municipality::where('province_id', $this->department)->get();
        } else {
            $this->municipalities = Municipality::get();
        }
        $this->updateCompanies();
        $this->emit('showAlert', ['type' => 'success', 'message' => 'Se han actualizado los municipios']);
    }

    public function updateCompanies(): void
    {
        $query = Company::query();
        if ($this->municipality) {
            $query->where('municipality_id', $this->municipality);
        } elseif ($this->department) {
            $query->whereHas('municipality', function ($q) {
                $q->where('province_id', $this->department);
            });
        }
        $this->companies = $query->pluck('mercantile_name', 'id')->toArray();
    }

    public function addChannel()
    {
        $this->validate([
            'channels_id' => ['required', 'array', 'exists:channels,id']
        ]);
        foreach ($this->channels_id as $channel_id) {
            $this->company->channels()->create([
                'channel_id' => $channel_id
            ]);
        }
        $this->channels_id = [];
        $this->company = Company::find($this->company_id);
        $this->updateChannels();
        $this->emit('showAlert', ['type' => 'success', 'message' => 'Se han agregado los canales']);
    }

    public function updateChannels(): void
    {
        $company_channels = $this->company->channels()->pluck('channel_id')->toArray();
        $this->channels = Channel::whereNotIn('id', $company_channels)->get()->toArray();
    }

    public function deleteChannel(CompanyChannel $companyChannel)
    {
        try {
            $companyChannel->delete();
            $this->company = Company::find($this->company_id);
            $this->updateChannels();
            $this->emit('showAlert', ['type' => 'success', 'message' => 'Registro eliminado correctamente']);
        } catch (\Exception) {
            $this->emit('showAlert', ['type' => 'error', 'message' => 'Este canal ya se ha utilizado una supervisión']);
        }

    }

    public function submit()
    {
        $this->validate([
            'company_id' => ['required', 'exists:companies,id'],
            'supervisor_id' => ['required', 'exists:users,id'],
        ]);
        Visit::create([
            'user_id' => $this->supervisor_id,
            'company_id' => $this->company_id,
            'status' => 0
        ]);
        $data = [
            'subject' =>  'Nueva supervisión asignada',
            'title' => 'Tienes asignada una nueva visita de supervisión',
            'subtitle' => '',
            'description' => 'Ingresa a la plataforma para más detalles',
        ];
        Mail::to(User::find($this->supervisor_id)->email)->send(new UserNotify($data));
        $this->emit('showAlert', ['type' => 'success', 'message' => 'Se ha creado la visita']);
        $this->redirect(route('visits'));
    }

    public function render()
    {
        $supervisors = User::where('type', 4)->get();
        return view('livewire.visits.new-visit', compact('supervisors'));
    }
}
