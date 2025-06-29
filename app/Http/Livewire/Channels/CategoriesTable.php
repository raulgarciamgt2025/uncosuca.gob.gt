<?php

namespace App\Http\Livewire\Channels;

use App\Models\ChannelCategory;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class CategoriesTable extends DataTableComponent
{
    protected $model = ChannelCategory::class;
    protected $listeners = [
        'refreshCategoriesTable' => 'refreshTable'
    ];
    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function refreshTable(): void
    {
        $this->emit('refreshDatatable');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()->searchable(),
            Column::make("Nombre", "name")
                ->sortable()->searchable(),
            BooleanColumn::make('Activo', 'active'),
            Column::make("Fecha creación", "created_at")
                ->sortable(),
            Column::make("Acciones", "id")
                ->format(function ($id) {
                    $modal_edit = 'channels.edit-modal-categories';
                    $modal_delete = 'channels.delete-modal-categories';
                    return view('components.modal-actions-button', compact('id', 'modal_edit', 'modal_delete'));
                }),
        ];
    }
}
