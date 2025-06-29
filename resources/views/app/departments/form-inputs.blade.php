@php $editing = isset($department) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.text
            name="name"
            label="Nombre"
            :value="old('name', ($editing ? $department->name : ''))"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.select name="manager_id" label="Responsable">
            @php $selected = old('manager_id', ($editing ? $department->manager_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>Please select the User</option>
            @foreach($managers as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-4">
        <x-inputs.checkbox
            name="active"
            label="Activo"
            :checked="old('active', ($editing ? $department->active : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12">
        <x-inputs.textarea
            name="description"
            label="Descripción"
            maxlength="255"
            >{{ old('description', ($editing ? $department->description : ''))
            }}</x-inputs.textarea
        >
    </x-inputs.group>

    <div class="form-group col-sm-12 mt-4">
        <h4>Agregar Auxiliares</h4>

        @foreach($users as $value => $label)
        <div>
            <x-inputs.checkbox
                id="user{{ $value }}"
                name="users[]"
                label="{{ ucfirst($label) }}"
                value="{{ $value }}"
                :checked="isset($department) ? $department->users()->where('id', $value)->exists() : false"
                :add-hidden-value="false"
            ></x-inputs.checkbox>
        </div>
        @endforeach
    </div>
</div>
