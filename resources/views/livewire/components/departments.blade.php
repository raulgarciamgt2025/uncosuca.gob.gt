<x-inputs.group class="col-lg-6">
    <label class="label" for="department">
        <strong>DEPARTAMENTO</strong>
    </label>
    <select class="form-control" name="department" id="department" wire:model="department" wire:change="municipalities">
        <option value="0" selected>Seleccione un departamento</option>
        @foreach($this->departments as $department_name => $municipalities)
            <option value="{{ $department_name }}">{{ $department_name }}</option>
        @endforeach
    </select>
</x-inputs.group>
<x-inputs.group class="col-lg-6">
    <label class="label" for="municipality">
        <strong>MUNICIPIO</strong>
    </label>
    <select class="form-control" name="municipality" id="municipality" wire:model="municipality">
        <option value="0" selected>Seleccione un departamento</option>
        @foreach($this->municipalities ?? [] as $municipality_name)
            <option value="{{ $municipality_name }}">{{ $municipality_name }}</option>
        @endforeach
    </select>
</x-inputs.group>
