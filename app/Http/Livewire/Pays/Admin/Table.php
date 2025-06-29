<?php

namespace App\Http\Livewire\Pays\Admin;

use App\Exports\PaysExport;
use App\Models\Company;
use App\Models\Pay;
use App\Models\Province;
use Illuminate\Database\Eloquent\Builder;
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
        'refreshTable' => 'refreshTable',
        'changePayStatus' => 'changePayStatus'
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
    private $departments;
    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setFilterLayoutSlideDown();
        $this->setFilterPillsDisabled();
        $this->setFilterSlideDownDefaultStatusEnabled();
    }

    public function boot(): void
    {
        $this->departments = Province::pluck('name', 'id')->toArray();
    }

    public function builder(): Builder
    {
        return Pay::select('pays.*')->with('company');
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
        $companies = Company::query()
            ->orderBy('id')
            ->get()
            ->keyBy('id')
            ->map(fn($tag) => $tag->mercantile_name)
            ->toArray();
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
            MultiSelectDropdownFilter::make('Empresa')
                ->options($companies)
                ->setFirstOption('Todos')
                ->filter(function (Builder $builder, $company) {
                    $builder->whereIn('company_id', $company);
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
                }),
            MultiSelectDropdownFilter::make('Departamento')
                ->options($this->departments)
                ->setFirstOption('Todos')
                ->filter(function (Builder $builder, $departments) {
                    $builder->whereHas('company.municipality', function ($municipality) use ($departments) {
                        $municipality->whereIn('province_id', $departments);
                    });
                })
        ];
    }

    public function columns(): array
    {
        return [
            Column::make('Número', 'pays.id')
                ->sortable(),
            Column::make('Empresa', 'company.mercantile_name')
                ->sortable()
                ->searchable(),
            Column::make('Departamento', 'company.municipality.province.name')
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
            Column::make('Acciones', "pays.id")
                ->format(function ($pay_id, $row) {
                    $status = $row->status;
                    return view('components.admin-pay-actions', compact('pay_id', 'status', 'row'));
                }),
        ];
    }

    public function refreshTable(): void
    {
        $this->emit('refreshDatatable');
    }

    public function changePayStatus($payId, $newStatus): void
    {
        try {
            $pay = Pay::findOrFail($payId);
            $pay->update(['status' => $newStatus]);
            
            $statusText = $newStatus == 2 ? 'aprobado' : 'rechazado';
            $this->alert('success', "Pago {$statusText} exitosamente");
            
            $this->emit('refreshDatatable');
        } catch (\Exception $e) {
            $this->alert('error', 'Error al actualizar el estado del pago');
        }
    }
}
