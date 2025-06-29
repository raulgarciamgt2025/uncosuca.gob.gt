@php
    $model = 'inputs.'.$field['name'];
    $label = mb_strtoupper($field['label']);
    $required = $field['required'] == 'required' ? '  (*)' : '';
@endphp
<x-inputs.group class="col-lg-6" >
    @if($this->correction)
        @if(key_exists($field['name'], $this->correction_fields))
            @if($field['name'] == 'department')
                <x-inputs.select
                    label="{{ $label.$required }}"
                    name="{{ $model }}"
                    wire:change="updateMunicipalityList($event.target.options[$event.target.selectedIndex].text)"
                    wire:model="{{ $model }}">
                    <option value="">Seleccione un departamento</option>
                    @foreach($this->departments as $department)
                        <option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
                    @endforeach
                </x-inputs.select>
            @elseif($field['name'] == 'municipality')
                <x-inputs.select
                    label="{{ $label.$required }}"
                    name="{{ $model }}"
                    wire:model="{{ $model }}">
                    <option value="">Seleccione un municipio</option>
                    @foreach($this->municipalities ?? [] as $municipality)
                        <option value="{{ $municipality['name'] }}">{{ $municipality['name'] }}</option>
                    @endforeach
                </x-inputs.select>
            @else
                <x-dynamic-component
                    :component="'inputs.'.$field['type']"
                    label="{{ $label.$required }}"
                    name="{{ $model }}"
                    wire:model="{{ $model }}">
                </x-dynamic-component>
            @endif
        @else
            @php
                unset($this->rules['inputs.'.$field['name']]);
                unset($this->inputs[$field['name']]);
                $value = $this->correction['form'][$field['name']] ?? $this->correction['seller'][$field['name']] ??
                $this->correction['new_owner'][$field['name']] ?? []
            @endphp
            @if($field['name'] == 'department')
                <x-inputs.select
                    label="{{ $label.$required }}"
                    name="{{ $model }}"
                    disabled
                    value="{{ $value['response'] ?? '' }}"
                    wire:change="updateMunicipalityList($event.target.options[$event.target.selectedIndex].text)"
                    wire:model="{{ $model }}">
                    <option value="">Seleccione un departamento</option>
                    @foreach($this->departments as $department)
                        <option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
                    @endforeach
                </x-inputs.select>
            @elseif($field['name'] == 'municipality')
                <x-inputs.select
                    label="{{ $label.$required }}"
                    name="{{ $model }}"
                    disabled
                    value="{{ $value['response'] ?? '' }}"
                    wire:model="{{ $model }}">
                    <option value="">Seleccione un municipio</option>
                    @foreach($this->municipalities ?? [] as $municipality)
                        <option value="{{ $municipality['name'] }}">{{ $municipality['name'] }}</option>
                    @endforeach
                </x-inputs.select>
            @else
                <x-dynamic-component
                    :component="'inputs.'.$field['type']"
                    disabled
                    label="{{ $label.$required }}"
                    name="{{ $model }}"
                    value="{{ $value['response'] ?? '' }}">
                </x-dynamic-component>
            @endif
        @endif
    @else
        {{--    AL SER DINÁMICO, SE DEBE DEFINIR UN TIPO DE SELECT ESPECÍFICO PARA EL DEPARTAMENTO Y MUNICIPIO    --}}
        @if($field['name'] == 'department')
            <x-inputs.select
                label="{{ $label.$required }}"
                name="{{ $model }}"
                wire:change="updateMunicipalityList($event.target.options[$event.target.selectedIndex].text)"
                wire:model="{{ $model }}">
                <option value="">Seleccione un departamento</option>
                @foreach($this->departments as $department)
                    <option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
                @endforeach
            </x-inputs.select>
        @elseif($field['name'] == 'municipality')
            <x-inputs.select
                label="{{ $label.$required }}"
                name="{{ $model }}"
                wire:model="{{ $model }}">
                <option value="">Seleccione un municipio</option>
                @foreach($this->municipalities ?? [] as $municipality)
                    <option value="{{ $municipality['name'] }}">{{ $municipality['name'] }}</option>
                @endforeach
            </x-inputs.select>
        @else
            <x-dynamic-component
                :component="'inputs.'.$field['type']"
                label="{{ $label.$required }}"
                name="{{ $model }}"
                wire:model="{{ $model }}">
            </x-dynamic-component>
        @endif
    @endif
</x-inputs.group>
<br>
