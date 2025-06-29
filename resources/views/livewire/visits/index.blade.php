<div class="card p-0">
    <h2 class="card-title px-4">
        <strong>Supervisiones</strong>
    </h2>
    <div class="card-body">
        <hr class="my-2">
        <div class="text-center p-1">
            <a class="btn btn-sm btn-outline-primary" href="{{ route('new-visit') }}"><i class="fa-solid fa-plus"></i> Nueva supervisión</a>
            <a class="btn btn-sm btn-outline-secondary" href="{{ route('visits') }}"><i class="fa-solid fa-rotate"></i> Recargar</a>
            <button type="button" class="btn btn-sm btn-outline-danger " wire:click="showModalReport"><i class="fa-solid fa-file-pdf"></i> Generar informe</button>
        </div>
        <livewire:visits.visits-table/>
    </div>
    <x-modal wire:model="modalReport" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Generar informe PDF por departamento</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('modalReport')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <x-inputs.group class="col-lg-6" >
                        <x-inputs.select
                            wire:model="department"
                            label="Departamento"
                            name="department">
                            <option value="">Seleccione un departamento</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                    <x-inputs.group class="col-lg-6">
                        <x-inputs.date
                            wire:model="start_date"
                            label="Fecha inicial"
                            name="start_date">
                        </x-inputs.date>
                    </x-inputs.group>
                    <x-inputs.group class="col-lg-6" >
                        <x-inputs.date
                            wire:model="end_date"
                            label="Fecha final"
                            name="end_date">
                        </x-inputs.date>
                    </x-inputs.group>
                    <x-inputs.group class="col-lg-6" >
                        <x-inputs.text
                            placeholder="Ejemplo: 079-2024"
                            wire:model="requirements"
                            label="Requerimientos de traslado"
                            name="requirements">
                        </x-inputs.text>
                    </x-inputs.group>
                </div>
                <button class="btn btn-outline-danger my-2" wire:click="generateReport">
                    <i class="fa-solid fa-file-pdf"></i>
                    Generar informe
                </button>
                @if($report)
                    <a class="btn btn-link" target="_blank" href="{{ $report }}">Ver en otra pestaña</a>
    {{--                    <button class="btn btn-outline-danger my-2" wire:click="downloadReport">--}}
    {{--                        <i class="fa-solid fa-file-download"></i>--}}
    {{--                        Descargar--}}
    {{--                    </button>--}}
                    <iframe class="my-2" style="width: 100%; height: 500px" src="{{ $report }}"></iframe>
                @endif
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('modalReport')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
            </div>
        </div>
    </x-modal>
</div>
