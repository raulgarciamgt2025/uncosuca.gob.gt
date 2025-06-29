<div class="card p-0">
    <h2 class="card-title px-4 row">
        <div class="col">
            <strong>Canales de televisión</strong>
        </div>
    </h2>
    <div class="card-body">
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-primary" href="{{ route('channels') }}"><i class="fa-solid fa-rotate"></i> Recargar</a>
            <button class="btn btn-sm btn-success" wire:click="showModalCreate"><i class="fa-solid fa-plus"></i> Crear</button>
        </div>
        <livewire:channels.channels-table/>
    </div>
    <x-modal wire:model="modal_create" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear categoría</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('modal_create')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <x-inputs.group class="col-lg-5" >
                            <x-inputs.text
                                label="Nombre del canal"
                                name="name"
                                placeholder=""
                                wire:model="name"
                            >
                            </x-inputs.text>
                        </x-inputs.group>
                        <x-inputs.group class="col-lg-5" >
                            <x-inputs.select
                                name="category"
                                label="Categoría del canal"
                                wire:model="category">
                                <option value="">SELECCIONE UNA OPCIÓN</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id}}">{!! $category->name !!}</option>
                                @endforeach
                            </x-inputs.select>
                        </x-inputs.group>
                        <x-inputs.group class="col-lg-2" >
                            <label for=""><strong>Activar</strong></label>
                            <x-inputs.checkbox
                                label=""
                                name="active"
                                wire:model="active"
                            >
                            </x-inputs.checkbox>
                        </x-inputs.group>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('modal_create')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" wire:click="create">
                    <div wire:loading.remove wire:target="create">
                        <i class="fas fa-save"></i>
                        Continuar
                    </div>
                    <div wire:loading wire:target="create">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </x-modal>
</div>

