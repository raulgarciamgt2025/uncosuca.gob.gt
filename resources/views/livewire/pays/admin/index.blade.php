<div class="card p-0">
    <h2 class="card-title px-4">
        <strong>Pagos</strong>
    </h2>
    <div class="card-body">
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-primary" href="{{ route('pays') }}"><i class="fa-solid fa-rotate"></i> Recargar</a>
            <button type="submit" class="btn btn-sm btn-success " wire:click="excelExport"><i class="fa-solid fa-file-excel"></i> Exportar</button>
        </div>
        <livewire:pays.admin.table/>
    </div>
</div>
