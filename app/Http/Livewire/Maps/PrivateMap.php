<?php

namespace App\Http\Livewire\Maps;

use App\Models\Company;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PrivateMap extends Component
{
    use AuthorizesRequests;

    public $companies, $modal_company = false;
    public ?Company $company;
    protected $listeners = [
        'loadMap' => 'loadMap',
        'showCompany' => 'showCompany',
        'updateMap' => 'updateMap'
    ];

    public function mount(): void
    {
        if (auth()->user()) {
            $this->authorize('Mapa privado');
        }
        $this->companies = Company::select('latitude', 'longitude', 'id')->get()->toArray();
    }

    public function showCompany(Company $company): void
    {
        $this->company = $company;
        $this->modal_company = true;
    }

    public function updateMap($collect): void
    {
        $this->companies = $collect;
        $this->loadMap();
    }

    public function loadMap(): void
    {
        $this->emit('load-map', [json_encode($this->companies)]);
    }

    public function render(): View
    {
        return  view('livewire.maps.private-map');
    }
}
