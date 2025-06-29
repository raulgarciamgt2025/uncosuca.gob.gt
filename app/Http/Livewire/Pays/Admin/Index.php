<?php

namespace App\Http\Livewire\Pays\Admin;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class Index extends Component
{
    use AuthorizesRequests;
    public function mount(): void
    {
        $this->authorize('Lista pagos');
    }
    public function excelExport(): void
    {
        $this->emit('exportPays');
    }
    public function render(): View
    {
        return view('livewire.pays.admin.index');
    }
}
