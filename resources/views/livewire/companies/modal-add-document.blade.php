<div class="card">
    <div class="card-header p-2">
        <h3 class="text-center">{{ $company->mercantile_name ?? '' }}</h3>
    </div>
    <div class="card-body p-2">
        <form>
            <div class="row">
                <div class="col-lg-6">
                    <x-inputs.textarea
                        label="Descripción"
                        name="description"
                        wire:model="description"
                    ></x-inputs.textarea>
                </div>
                <div class="col-lg-6">
                    <x-inputs.textarea
                        label="Observaciones adicionales"
                        name="observations"
                        wire:model="observations"
                    ></x-inputs.textarea>
                </div>
                <div class="col-lg-6">
                    <x-inputs.file
                        label="Cargar documento en PDF"
                        description="Sube el documento en formato PDF"
                        name="url"
                        wire:model="url"
                    ></x-inputs.file>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar</button>
        <button type="button" class="btn btn-success" wire:click="submit">Guardar <i class="fa-regular fa-paper-plane"></i></button>
    </div>
</div>

