<div class="card">
    <div class="card-header p-2">
        <h3 class="text-center">Eliminar registro</h3>
    </div>
    <div class="card-body p-2">
        ¿Está seguro de eliminar este registro?
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar</button>
        <button type="submit" form="form-1" class="btn btn-danger" wire:click="submit">Eliminar <i class="fa-regular fa-paper-plane"></i></button>
    </div>
</div>
