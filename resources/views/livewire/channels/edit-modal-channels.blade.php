<div class="card">
    <div class="card-header p-2">
        <h3 class="text-center">Editar registro</h3>
    </div>
    <div class="card-body p-2">
        <form wire:submit.prevent="submit" id="form-1">
            <div class="row">
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        label="Nombre del canal"
                        name="channel_name"
                        placeholder=""
                        wire:model="channel_name"
                    >
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.select
                        name="category_id"
                        label="Categoría del canal"
                        wire:model="category_id">
                        <option value="">SELECCIONE UNA OPCIÓN</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id}}">{!! $category->name !!}</option>
                        @endforeach
                    </x-inputs.select>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
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
    <div class="card-footer text-right">
        <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar</button>
        <button type="submit" form="form-1" class="btn btn-success" wire:click="submit">Guardar <i class="fa-regular fa-paper-plane"></i></button>
    </div>
</div>
