@php $editing = isset($user) @endphp

<div class="row">
    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="name"
            label="Nombres"
            :value="old('name', ($editing ? $user->name : ''))"
            maxlength="255"
            placeholder="Nombres"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="surname"
            label="Apellidos"
            :value="old('surname', ($editing ? $user->surname : ''))"
            maxlength="255"
            placeholder="Apellidos"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.email
            name="email"
            label="Correo electrónico"
            :value="old('email', ($editing ? $user->email : ''))"
            placeholder="Correo electrónico"
            required
        ></x-inputs.email>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.password
            name="password"
            label="Contraseña"
            placeholder="Contraseña"
            :required="!$editing"
        ></x-inputs.password>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="cui"
            label="CUI"
            :value="old('cui', ($editing ? $user->cui : ''))"
            maxlength="13"
            placeholder="CUI"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.text
            name="nit"
            label="NIT"
            :value="old('nit', ($editing ? $user->nit : ''))"
            placeholder="NIT"
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.select name="type" label="Tipo">
            <option value="">Seleccione un tipo de usuario</option>
            @foreach($roles as $role)
                <option value="{{  $role->id }}" {{ $editing ? $user->type == $role->id ? 'selected' : '' : '' }}>{{ $role->name }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="col-sm-12 col-lg-6">
        <x-inputs.checkbox
            name="active"
            label="Activo"
            :checked="old('active', ($editing ? $user->active : 0))"
        ></x-inputs.checkbox>
    </x-inputs.group>
</div>
