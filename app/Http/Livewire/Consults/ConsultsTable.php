<?php

namespace App\Http\Livewire\Consults;

use App\Exports\WorkflowRequestsExport;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\WorkflowRequest;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class ConsultsTable extends DataTableComponent
{

    protected $listeners = [
        'export' => 'export'
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayoutSlideDown();
        $this->setFilterPillsDisabled();
    }

    public function builder(): Builder
    {
        return WorkflowRequest::query()->where('state', '>', -1);
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->searchable(),
            Column::make("Clave", "key")
                ->sortable()->searchable(),
            Column::make("Fecha inicio", "start_date")
                ->format(function ($date) {
                    return $this->getDate($date);
                })
                ->sortable()->searchable(),
            Column::make("Fecha fin", "end_date")
                ->format(function ($date) {
                    return $this->getDate($date);
                })
                ->sortable()->searchable(),
            Column::make("Estado", "state")
                ->format(function ($state) {
                    return view('components.badge-status', compact('state'));
                })
                ->sortable()->searchable(),
            Column::make("Empresa", "company.mercantile_name")
                ->sortable()->searchable(),
            Column::make("Ranking", "ranking")
                ->format(function ($ranking) {
                    return $ranking['stars'] ?? null;
                })
                ->sortable()->searchable(),
            Column::make("Solicitante", "user.name")
                ->sortable()->searchable(),
            Column::make("Trámite", "workflow.name")
                ->sortable()->searchable(),
            Column::make("Fecha creación", "created_at")
                ->format(function ($date) {
                    return Carbon::parse($date)->format('d/m/Y');
                })
                ->sortable()->searchable(),
            LinkColumn::make('Acciones')
                ->title(fn($row) => 'Detalles')
                ->location(fn($row) => route('details-key', $row->key))
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Estado')
                ->options([
                    '' => 'Todos',
                    0 => 'Solicitado',
                    1 => 'En proceso',
                    2 => 'Finalizado',
                    3 => 'Rechazado',
                    4 => 'Cancelado',
                ])->filter(function (Builder $builder, $state) {
                    $builder->where('state', $state);
                }),
        ];
    }

    public function export()
    {
        $workflowsRequest = $this->baseQuery()->get();
        $statuses = [
            'Solicitado',
            'En proceso',
            'Finalizado',
            'Rechazado',
            'Cancelado'
        ];
        $data = [
            [
                '#',
                'Clave',
                'Fecha inicio',
                'Fecha fin',
                'Estado',
                'Empresa',
                'Ranking',
                'Solicitante',
                'Trámite',
                'Creación'
            ]
        ];
        foreach ($workflowsRequest as $workflowRequest)
        {
            $data[] = [
                'id' => $workflowRequest->id,
                'key' => $workflowRequest->key,
                'start_date' => $workflowRequest->start_date->format('d/m/Y'),
                'end_date' => $this->getDate($workflowRequest->end_date),
                'state' => $statuses[$workflowRequest->state] ?? 'Inválido',
                'company.mercantile_name' => $workflowRequest['company.mercantile_name'],
                'ranking' => $workflowRequest->ranking['stars'] ?? null,
                'user.name' => $workflowRequest['user.name'],
                'workflow.name' => $workflowRequest['workflow.name'],
                'created_at' => $workflowRequest->created_at->format('d/m/Y')
            ];
        }
        return Excel::download(new WorkflowRequestsExport($data), 'tramites_uncosu.xlsx');
    }

    public function getDate($date)
    {
        if ($date) {
            $date_format = $date->format('d/m/Y');
        } else {
            $date_format = null;
        }
        return $date_format;
    }
}
