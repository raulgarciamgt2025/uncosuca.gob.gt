<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Perfil</strong>
    </h2>
    <div class="card-body">
        <form wire:submit.prevent="submit">
            <h3>Datos del usuario:</h3>
            <hr class="my-2">
            <div class="row">
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        label="NOMBRES"
                        name="name"
                        placeholder=""
                        wire:model="name">
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        label="APELLIDOS"
                        name="surname"
                        placeholder=""
                        wire:model="surname">
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        label="CORREO ELECTRÓNICO"
                        name="email"
                        placeholder=""
                        wire:model="email">
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        label="CONTRASEÑA"
                        name="password"
                        placeholder=""
                        wire:model="password">
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        label="CUI"
                        name="cui"
                        placeholder=""
                        wire:model="cui">
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        label="NIT"
                        name="nit"
                        placeholder=""
                        wire:model="nit">
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        label="USUARIO DE FIRMA"
                        name="signature_user"
                        placeholder="Opcional"
                        wire:model="signature_user">
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.text
                        label="CONTRASEÑA DE FIRMA"
                        name="signature_password"
                        placeholder="Opcional"
                        wire:model="signature_password">
                    </x-inputs.text>
                </x-inputs.group>
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.image
                        label="IMAGEN DE FIRMA GRÁFICA (200x200 px)"
                        name="signature_image"
                        description="Una imagen de tu firma sin fondo o fondo blanco"
                        wire:model="signature_image">
                    </x-inputs.image>
                    @if ($signature_image)
                        <img style="width: 200px; height: 200px" src="{{ $signature_image->temporaryUrl() }}">
                    @elseif($user->signature_image)
                        <img style="width: 200px; height: 200px" src="{{ 'storage/'.$user->signature_image }}">
                    @endif
                </x-inputs.group>
            </div>
        </form>
        <hr class="my-2">
        <button type="button" wire:click="submit" class="btn btn-primary">Guardar datos</button>
    </div>
</div>



