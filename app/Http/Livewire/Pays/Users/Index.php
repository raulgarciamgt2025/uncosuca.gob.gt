<?php

namespace App\Http\Livewire\Pays\Users;

use App\Models\Pay;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Index extends Component
{
    use AuthorizesRequests;
    public function mount(): void
    {
        $this->authorize('Mis pagos');
    }
    public function excelExport(): void
    {
        $this->emit('exportPays');
    }

    public function newPayment(): void
    {
        $this->emit('openModal', 'pays.users.new-pay-modal');
    }

    public function render(): View
    {
        return view('livewire.pays.users.index');
    }
}
