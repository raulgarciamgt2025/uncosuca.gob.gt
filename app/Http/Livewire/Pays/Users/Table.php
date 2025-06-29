<?php

namespace App\Http\Livewire\Pays\Users;

use App\Exports\PaysExport;
use App\Models\Company;
use App\Models\Pay;
use App\Models\UserCompany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Maatwebsite\Excel\Facades\Excel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class Table extends DataTableComponent
{
    use LivewireAlert;
    protected $listeners = [
        'exportPays' => 'excel',
        'refreshTable' => 'refreshTable'
    ];
    private $mounts = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre',
    ];
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayoutSlideDown();
        $this->setFilterPillsDisabled();
        $this->setFilterSlideDownDefaultStatusEnabled();
        $this->setTableRowUrl(function($row) {
            return '#';
        });
        $this->setEagerLoadAllRelationsEnabled();
        $this->setDefaultSort('id', 'desc');
        $this->setSortingPillsEnabled();
        $this->setSearchEnabled();
        $this->setSearchDebounce(500);
        $this->setPaginationMethod('simple');
    }

    public function builder(): Builder
    {
        // Get company IDs that are assigned to the current user
        $assignedCompanyIds = Auth::user()->assignedCompanies()->pluck('company_id')->toArray();
        
        // If no companies are assigned, return empty query
        if (empty($assignedCompanyIds)) {
            return Pay::where('pays.id', 0); // This will return no results
        }
        
        return Pay::query()
            ->select('pays.*')
            ->with(['company' => function($query) {
                $query->select('pays.id', 'mercantile_name');
            }])
            ->whereIn('pays.company_id', $assignedCompanyIds);
    }
    public function excel(): BinaryFileResponse
    {
        $pays = $this->baseQuery()->pluck('pays.id')->toArray();
        return Excel::download(new PaysExport($pays, $this->mounts), 'pagos.xlsx');
    }

    public function filters(): array
    {
        $years = [];
        $year = 2023;
        while ($year <= date('Y')) {
            $years[$year] = $year;
            $year++;
        }
        return [
            MultiSelectDropdownFilter::make('Estado de pagos')
                ->options([
                    0 => 'PENDIENTE',
                    2 => 'APROBADO',
                    3 => 'RECHAZADO',
                ])
                ->setFirstOption('Todos')
                ->filter(function (Builder $builder, $status) {
                    $builder->whereIn('pays.status', $status);
                }),
            MultiSelectDropdownFilter::make('Tipo')
                ->options([
                    'CUOTA' => 'CUOTA',
                    'INSCRIPCION' => 'INSCRIPCION',
                ])
                ->setFirstOption('Todos')
                ->filter(function (Builder $builder, $estado) {
                    $builder->whereIn('pays.estado', $estado);
                }),
            MultiSelectDropdownFilter::make('Año')
                ->options($years)
                ->setFirstOption('Todos')
                ->filter(function (Builder $builder, $year) {
                    $builder->whereIn('year', $year);
                }),
            MultiSelectDropdownFilter::make('Mes')
                ->options($this->mounts)
                ->setFirstOption('Todos')
                ->filter(function (Builder $builder, $mount) {
                    $builder->whereIn('mount', $mount);
                })
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('Número', 'id')
                ->sortable()
                ->searchable(),
            Column::make('Empresa', 'company.mercantile_name')
                ->sortable()
                ->searchable(),
            Column::make('Estado Pago', "status")
                ->format(function ($status) {
                    return view('components.pay-status-badge', compact('status'));
                })
                ->sortable(),
            Column::make('Tipo', 'estado')
                ->format(function ($estado) {
                    if (!$estado) return '<span class="badge bg-secondary">-</span>';
                    $color = $estado === 'CUOTA' ? 'bg-primary' : 'bg-info';
                    return '<span class="badge ' . $color . '">' . $estado . '</span>';
                })
                ->html()
                ->sortable(),
            Column::make('Año', 'year')
                ->sortable(),
            Column::make('Mes', 'mount')
                ->format(function ($mount) {
                    return $this->mounts[$mount] ?? '-';
                })
                ->sortable(),
            Column::make('Usuarios', 'pay')
                ->format(function ($pay) {
                    return $pay ? number_format($pay) : '0';
                })
                ->sortable(),
            Column::make('Total', 'amount')
                ->format(function ($amount) {
                    return $amount ? 'Q ' . number_format($amount, 2) : 'Q 0.00';
                })
                ->sortable(),
            Column::make('Fecha Pago', 'fecha_pago')
                ->format(function ($fecha) {
                    return $fecha ? date('d/m/Y', strtotime($fecha)) : '-';
                })
                ->sortable(),
            Column::make('No. Formulario', 'ticket_number')
                ->format(function ($ticket) {
                    return $ticket ?: '-';
                })
                ->sortable()
                ->searchable(),
            Column::make('Documento', 'ticket_file')
                ->format(function ($ticket_file) {
                    if ($ticket_file) {
                        $url = asset('storage/' . $ticket_file);
                        return '<a href="' . $url . '" target="_blank" class="btn btn-sm btn-outline-danger">
                                    <i class="fa-solid fa-file-pdf"></i> Ver PDF
                                </a>';
                    }
                    return '<span class="badge bg-secondary">Sin documento</span>';
                })
                ->html(),
            Column::make('Observaciones', 'observaciones')
                ->format(function ($observaciones) {
                    if (!$observaciones) return '-';
                    $truncated = substr($observaciones, 0, 30);
                    if (strlen($observaciones) > 30) {
                        return '<span title="' . htmlspecialchars($observaciones) . '">' . $truncated . '...</span>';
                    }
                    return $truncated;
                })
                ->html()
                ->sortable()
                ->searchable(),
        ];
    }

    public function refreshTable(): void
    {
        $this->emit('refreshDatatable');
    }
}
