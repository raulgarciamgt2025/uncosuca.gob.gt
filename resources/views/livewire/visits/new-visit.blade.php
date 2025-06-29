<div class="card p-0">
    <h2 class="card-title px-4">
        <strong>Nueva supervisión</strong>
    </h2>
    <div class="card-body">
        <hr class="my-2">
        <div class="p-1">

            <div class="row">
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.select
                    wire:model="department"
                    label="Departamento"
                    name="department"
                    wire:change="changeDepartment()">
                        <option value="">Todos</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </x-inputs.select>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.select
                        wire:model="municipality"
                        label="Municipio"
                        name="municipality"
                        wire:change="updateCompanies()">
                        <option value="">Todos</option>
                        @foreach($municipalities as $municipality)
                            <option value="{{ $municipality->id }}">{{ $municipality->name }}</option>
                        @endforeach
                    </x-inputs.select>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.select
                        name="company_id"
                        label="EMPRESA"
                        wire:change="showChannels"
                        wire:model="company_id">
                        <option value="">SELECCIONE UNA EMPRESA</option>
                        @foreach($companies as $id => $company_item)
                            <option value="{{ $id }}">{{ $company_item }}</option>
                        @endforeach
                    </x-inputs.select>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.select
                        name="supervisor_id"
                        label="SUPERVISOR"
                    wire:model="supervisor_id">
                        <option value="">SELECCIONE UN SUPERVISOR</option>
                        @foreach($supervisors as $supervisor)
                            <option value="{{ $supervisor->id}}">{!! $supervisor->name !!}</option>
                        @endforeach
                    </x-inputs.select>
                </x-inputs.group>
            </div>
            <hr>
            <button class="btn btn-success {{ !$company_id || !$supervisor_id ? 'disabled' : '' }}" wire:click="submit">
                <i class="fa-regular fa-circle-check"></i>
                Crear ficha de supervisión
            </button>
        </div>
    </div>

</div>
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        document.addEventListener('livewire:load', function () {--}}
{{--            let selectChannel = $('#select-channel')--}}
{{--            selectChannel.select2().on('change', function() {--}}
{{--                @this.set('channels_id', $(this).val());--}}
{{--            })--}}
{{--            Livewire.hook('message.processed', () => {--}}
{{--                selectChannel.select2().on('change', function() {--}}
{{--                    @this.set('channels_id', $(this).val());--}}
{{--                })--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}
