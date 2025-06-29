<div class="card p-0">
    <h2 class="card-title px-4">
        <strong>Mis supervisiones</strong>
    </h2>
    <div class="card-body">
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-secondary" href="{{ route('my-visits') }}"><i class="fa-solid fa-rotate"></i> Recargar</a>
            {{--            <button type="submit" class="btn btn-sm btn-success " wire:click=""><i class="fa-solid fa-file-excel"></i> Exportar</button>--}}
        </div>
        <livewire:visits.my-visits-table/>
    </div>
</div>
