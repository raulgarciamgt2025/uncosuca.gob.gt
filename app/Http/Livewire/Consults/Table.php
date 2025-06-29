<?php

namespace App\Http\Livewire\Consults;

use App\Models\User;
use App\Models\WorkflowRequest;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\WithPagination;

class Table extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;

    public function excelExport(): void
    {
        $this->emit('export');
    }
    public function render(): View
    {
        $this->authorize('viewHistory', User::class);
        return view('livewire.consults.table');
    }
}
