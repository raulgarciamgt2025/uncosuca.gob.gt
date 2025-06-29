<?php

namespace App\Http\Livewire\Companies;

use App\Exports\CompaniesExport;
use App\Models\Municipality;
use App\Models\Province;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Company;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CompanyTable extends DataTableComponent
{
    use LivewireAlert;
    public $department, $departments_id, $municipalities_id, $department_filter, $previous_department, $to_beat, $to_map = false;
    protected $listeners = [
        'exportCompanies' => 'excel',
        'refreshTable' => 'refreshTable',
        ];

    public function mount($to_map): void
    {
        $bool_value = ($to_map === "true");
        $this->to_map = $bool_value;
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayoutSlideDown();
        $this->setFilterPillsDisabled();
        if ($this->to_map) {
            $this->setPaginationStatus(false);
            $this->setColumnSelectStatus(false);
            $this->setSearchStatus(false);
            $this->setFilterSlideDownDefaultStatusEnabled();
        }
    }

    public function refreshTable(): void
    {
        $this->emit('refreshDatatable');
    }

    public function builder(): Builder
    {
        $bool_value = ($this->to_beat === "true");
        if ($bool_value) {
            $date_now = date('Y-m-d');
            $date_8_months_later = date("Y-m-d", strtotime($date_now."+ 8 months"));
            $query = Company::query()->whereBetween('end_date', [date('Y-m-d H:i:s'), $date_8_months_later]);
        } else {
            $query = Company::query();
        }
        return $query;
    }

    public function excel(): BinaryFileResponse
    {
        $companies = $this->baseQuery()->pluck('id')->toArray();
        return Excel::download(new CompaniesExport($companies), 'companies.xlsx');
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
        $filters = [
            MultiSelectDropdownFilter::make('Departamento')
                ->options(
                    ['' => 'Todos'] + $departments
                )->filter(function (Builder $builder, $id_array) {
                    $builder->whereHas('municipality', function ($municipality) use($id_array) {
                        $municipality->whereIn('province_id', count($id_array) == 0 ? $this->departments_id : $id_array);
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
                        $builder->whereIn('companies.municipality_id', $id_array);
                    } else {
                        if (!$this->department) {
                            $builder->whereIn('companies.municipality_id', $id_array);
                        } else {
                            $this->table['filters']['municipio'] = [];
                            $builder->whereHas('municipality', function ($municipality) {
                                $municipality->whereIn('province_id', $this->department ?? $this->departments_id);
                            } )->whereIn('companies.municipality_id', $this->municipalities_id);
                        }
                    }
                }),
        ];
        if (auth()->user()) {
            $filters[] = DateFilter::make('Fecha creación - Inicio')
                ->filter(function (Builder $builder, $date) {
                    $builder->where('companies.created_at', '>=', $date. ' 00:00:00');
                });
            $filters[] = DateFilter::make('Fecha creación - Fin')
                ->filter(function (Builder $builder, $date) {
                    $builder->where('companies.created_at', '<=', $date. ' 23:59:00');
                });
            $filters[] = SelectFilter::make('Tipo de empresa')
                ->options([
                    '' => 'Todos',
                    1 => 'Individual',
                    2 => 'Jurídica',
                ])->filter(function (Builder $builder, $type) {
                    $builder->where('companies.company_type', $type);
                });
            $filters[] = SelectFilter::make('Estado de cuenta')
                ->options([
                    '' => 'Todos',
                    1 => 'Solvente',
                    0 => 'Morosa',
                ])->filter(function (Builder $builder, $status) {
                    $builder->where('companies.payment_status', $status);
                });
            $filters[] = SelectFilter::make('Estado')
                ->options([
                    '' => 'Todos',
                    1 => 'Activa',
                    0 => 'Inactiva',
                ])->filter(function (Builder $builder, $status) {
                    $builder->where('companies.status', $status);
                });
        }
        return $filters;
    }

    public function columns(): array
    {
        if (!$this->to_map) {
            $columns = [
                Column::make("Número", "id")->sortable()->searchable(),
                Column::make("Nombre", "mercantile_name")->sortable()->searchable(),
                Column::make("NIT", "nit")->sortable()->searchable(),
                Column::make("Municipio", "municipality.name")->sortable()->searchable(),
                Column::make("Departamento", "municipality.province.name")->sortable()->searchable(),
                Column::make("Aldea", "village")->sortable()->searchable(),
                Column::make("Dirección", "address")->sortable()->searchable(),
                Column::make("Estación", "station_address")->sortable()->searchable(),
                Column::make("Cobertura", "coverage")->sortable()->searchable(),
                Column::make("Propietarios", "owners")->sortable()->searchable(),
                Column::make("Representante Legal", "legal_representative")->sortable()->searchable(),
                Column::make("DPI", "cui")->sortable()->searchable(),
                Column::make('Teléfonos', "phone")->sortable()->searchable(),
                Column::make('Correos', "emails")->format(function ($emails) {
                    return ($emails[0] ?? null) .' '. ($emails[1] ?? null);
                })
                    ->sortable()->searchable(),
                Column::make('Usuarios', "users_number")->sortable()->searchable(),
                Column::make('Licencia', "license")->format(function ($license) {
                    return view('components.badge-license', compact('license'));
                })->sortable()->searchable(),
                Column::make('Resolución', "resolution")->sortable()->searchable(),
                Column::make('Latitud', "latitude")->sortable()->searchable(),
                Column::make('Longitud', "longitude")->sortable()->searchable(),
                Column::make('Imagen de referencia', "location_image")
                    ->format(function ($location_image) {
                        return view('components.button-image', ['image_url' => $location_image]);
                }),
                Column::make('Historial', "id")->format(function ($company_id) {
                    return view('components.modal-history-button', compact('company_id'));
                })->sortable()->searchable(),
                Column::make('Inicio', "start_date")
                    ->format(function ($start_date) {
                        return $start_date->format('d/m/Y');
                    })->sortable()->searchable(),
                Column::make('Fin', "end_date")
                    ->format(function ($end_date) {
                        return $end_date->format('d/m/Y');
                    })->sortable()->searchable(),
                Column::make("Tipo", "company_type")
                    ->format(function ($type) {
                        return view('components.company-type-badge', compact('type'));
                    })->sortable()->searchable(),
                Column::make('Estado', "status")
                    ->format(function ($status) {
                        return view('components.company-status', compact('status'));
                    })->sortable()->searchable(),
                Column::make('Pagos', "payment_status")
                    ->format(function ($status) {
                        return view('components.company-payment-status', compact('status'));
                    })->sortable()->searchable(),
                Column::make('Opciones', "id")->format(function ($company_id) {
                    return view('components.modal-edit-company-button', compact('company_id'));
                })->sortable()->searchable(),
            ];
        } else {
            $columns = [];
        }
        return $columns;
    }

    public function dehydrate(): void
    {
        $this->emit('updateMap', $this->baseQuery()->get(['latitude', 'longitude', 'id']));
    }

}
