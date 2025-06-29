<div class="card">
    <div class="card-header p-2">
        <h3 class="text-center">{{ $company->mercantile_name ?? '' }}</h3>
    </div>
    <div class="card-body p-2">
        <form wire:submit.prevent="submit" id="form-1">
            <div class="row">
                <div class="col-lg-6">
                    <x-inputs.select
                        name="array_company.license"
                        wire:model="array_company.license"
                        label="Estado de la licencia">
                        <option value="">Seleccione una opción</option>
                        <option value="1">Activo</option>
                        <option value="2">Inactivo</option>
                    </x-inputs.select>
                </div>
                @if(($array_company['license'] ?? null) == 2 && $array_company['license'] != $company->license)
                    <div class="col-lg-6">
                        <x-inputs.textarea
                            name="array_company.cancellation_comment"
                            wire:model="array_company.cancellation_comment"
                            label="Motivo de inactivación">
                        </x-inputs.textarea>
                    </div>
                @endif
                <div class="col-lg-6">
                    <x-inputs.text
                        name="array_company.latitude"
                        wire:model="array_company.latitude"
                        placeholder="Ejemplo: 14.154560"
                        label="Latitud">
                    </x-inputs.text>
                </div>
                <div class="col-lg-6">
                    <x-inputs.text
                        name="array_company.longitude"
                        wire:model="array_company.longitude"
                        placeholder="Ejemplo: -91.154560"
                        label="Longitud">
                    </x-inputs.text>
                </div>
                <div class="col-lg-6">
                    <x-inputs.image
                        name="location_image"
                        wire:model="location_image"
                        description="Imagen de referencia de la ubicación de la empresa."
                        label="Imagen de referencia">
                    </x-inputs.image>
                    @if($location_image)
                        <img style="width: 200px; height: 200px" src="{{ $location_image->temporaryUrl() }}" alt="Imagen de referencia">
                    @else
                        <img style="width: 200px; height: 200px" src="storage/{{ $this->company->location_image }}" alt="Imagen de referencia">
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar</button>
        <button type="submit" form="form-1" class="btn btn-success" wire:click="submit">Guardar <i class="fa-regular fa-paper-plane"></i></button>
    </div>
</div>

