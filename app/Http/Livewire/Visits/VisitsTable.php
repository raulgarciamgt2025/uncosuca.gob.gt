<?php

namespace App\Http\Livewire\Visits;

use App\Models\Municipality;
use App\Models\Province;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Visit;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class VisitsTable extends DataTableComponent
{
    protected $model = Visit::class;
    public $departments_id, $municipalities_id, $previous_department, $department;
    protected $listeners = [
        'exportCompanies' => 'excel',
        'refreshVisitsTable' => 'refreshTable'
    ];
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayoutSlideDown();
        $this->setFilterPillsDisabled();
    }

    public function refreshTable(): void
    {
        $this->emit('refreshDatatable');
    }

    public function builder(): Builder
    {
        return Visit::query();
    }

    public function filters(): array
    {
        $this->departments_id = Province::pluck('id')->toArray();
        $this->municipalities_id = Municipality::pluck('id')->toArray();
        if (isset($this->table['filters']['departamento'][0])) {
            $this->previous_department = $this->table['filters']['departamento'] == $this->department;
            $this->department = $this->table['filters']['departamento'][0] == 'Todos' ?  $this->departments_id
                : $this->table['filters']['departamento'];
        }
        $departments = Province::query()
            ->orderBy('id')
            ->get()
            ->keyBy('id')
            ->map(fn($tag) => $tag->name)
            ->toArray();
        $municipalities = Municipality::query()
            ->whereIn('province_id', $this->department ?? $this->departments_id)
            ->orderBy('id')
            ->get()
            ->keyBy('id')
            ->map(fn($tag) => $tag->name)
            ->toArray();
        return [
            MultiSelectDropdownFilter::make('Departamento')
                ->options(
                    ['' => 'Todos'] + $departments
                )->filter(function (Builder $builder, $id_array) {
                    $builder->whereHas('company.municipality', function ($company) use($id_array) {
                        $company->whereIn('province_id', count($id_array) == 0 ? $this->departments_id : $id_array)    ;
                    });
                }),
            MultiSelectDropdownFilter::make('Municipio')
                ->options(
                    ['' => 'Todos'] + $municipalities
                )->filter(function (Builder $builder, $id_array) {
                    if ($this->previous_department) {
                        if (count($id_array) == 0) {
                            $id_array = Municipality::whereIn('province_id', $this->department)->pluck('id')->toArray();
                        }
                        $builder->whereHas('company', function ($company) use($id_array) {
                            $company->whereIn('municipality_id', $id_array);
                        });

                    } else {
                        if (!$this->department) {
                            $builder->whereHas('company', function ($company) use($id_array) {
                                $company->whereIn('municipality_id', $id_array);
                            });
                        } else {
                            $this->table['filters']['municipio'] = [];
                            $builder->whereHas('company', function ($company) use($id_array) {
                                $company->whereHas('municipality', function ($municipality) use($id_array) {
                                    $municipality->whereIn('province_id', $this->department ?? $this->departments_id);
                                })->whereIn('municipality_id', $this->municipalities_id);
                            });
                        }
                    }
                }),
        ];
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
            LinkColumn::make('Action')
                ->title(fn($row) => 'Ver detalles')
                ->location(fn($row) => route('show-visit', $row->id))
        ];
    }
}
