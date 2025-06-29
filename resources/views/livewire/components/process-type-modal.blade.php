<div class="card">
    <div class="card-header">
        <h3 class="text-center">¿Qué tipo de proceso realizarás?</h3>
    </div>
    <div class="card-body text-center">
        <br>
        <button class="btn btn-outline-primary" wire:click="submit(1)">Individual</button>
        <button class="btn btn-outline-primary" wire:click="submit(2)">Jurídico</button>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cancelar</button>
    </div>
</div>

