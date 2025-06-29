<?php

namespace App\Http\Livewire\Visits;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Visit;

class MyVisitsTable extends DataTableComponent
{

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function builder(): Builder
    {
        return Visit::query()->whereRelation('user', 'id', auth()->id());
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->searchable(),
            Column::make("Empresa", "company.mercantile_name")
                ->sortable()->searchable(),
            Column::make("Supervisor", "user.name")
                ->sortable()->searchable(),
            Column::make("Fecha creación", "created_at")
                ->sortable()->searchable(),
            Column::make("Estado", "status")
                ->format(function ($status) {
                    return view('components.badge-status-visit', compact('status'));
                })
                ->sortable()->searchable(),
            Column::make("Fecha realizado", "created_at")
                ->sortable()->searchable(),
            Column::make("Acciones", "id")
                ->format(function ($id, $row) {
                    if (in_array($row->status, [0,3])) {
                        return view('components.button-my-visits', compact('id'));
                    } else {
                        return  '';
                    }
                })
                ->sortable()->searchable(),
        ];
    }
}
