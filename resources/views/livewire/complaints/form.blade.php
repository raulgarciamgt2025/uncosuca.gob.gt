<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Quejas, denuncias o sugerencias</strong>
    </h2>
    <div class="card-body">
        @if(auth()->user()->type == 1)
            <form wire:submit.prevent="save">
                <h3>Nueva Queja, Denuncia o Consulta:</h3>
                <hr class="my-2">
                <div class="row">
                    <x-inputs.group class="col-lg-6" >
                        <x-inputs.text
                            label="NOMBRE DE EMPRESA"
                            name="business_name"
                            placeholder=""
                            wire:model="business_name"
                        >
                        </x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="col-lg-6" >
                        <label for="type"><strong>TIPO DE FORMULARIO</strong></label>
                        <select class="form-control" wire:model="type" name="type" id="type">
                            <option value="1">Queja</option>
                            <option value="2">Denuncia</option>
                            <option value="3">Sugerencia</option>
                        </select>
                    </x-inputs.group>
                    <x-inputs.group class="col-lg-6" >
                        <x-inputs.text
                            label="NÚMERO DE TELÉFONO"
                            name="phone"
                            placeholder=""
                            wire:model="phone"
                        >
                        </x-inputs.text>
                    </x-inputs.group>
                    <x-inputs.group class="col-lg-6" >
                        <x-inputs.textarea
                            label="DESCRIPCION"
                            name="description"
                            placeholder=""
                            wire:model="description"
                        >
                        </x-inputs.textarea>
                    </x-inputs.group>
                </div>
                <button type="button" wire:click="save" class="btn btn-primary">Guardar datos</button>
            </form>
        @endif
        <hr class="my-2">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Número</th>
                    <th>Usuario</th>
                    <th>Fecha de creación</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($complains ?? [] as $complain)
                    <tr>
                        <td>{{ $complain->id ?? '-' }}</td>
                        <td>{{ $complain->user->name ?? '-' }}</td>
                        <td>{{  $complain->created_at->format('d/m/Y H:i A') ?? '-' }}</td>
                        <td> <x-complain-types :type="$complain->type"/></td>
                        <td> <x-complain-status :status="$complain->status"/></td>
                        <td class="text-center" style="width: 134px;">
                            <div
                                role="group"
                                aria-label="Row Actions"
                                class="btn-group"
                            >
                                <button
                                    type="button"
                                    class="btn btn-light"
                                    wire:click="showModal({{ $complain->id }})"
                                >
                                    <i class="icon ion-md-eye"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            @lang('crud.common.no_items_found')
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="8">{!! $complains->render() !!}</td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <x-modal wire:model="show_modal" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DETALLE DE LA QUEJA, DENUNCIA O SUGERENCIA</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('show_modal')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item disabled" aria-disabled="true"><strong> NOMBRE COMPLETO:</strong> {{ $this->complain->user->name ?? null }} {{ $this->complain->user->surname ?? null }}</li>
                    <li class="list-group-item disabled" aria-disabled="true"><strong> EMPRESA:</strong> {{ $this->content['business_name'] ?? null }}</li>
                    <li class="list-group-item disabled" aria-disabled="true"><strong> DPI:</strong> {{ $this->complain->user->cui ?? null }}</li>
                    <li class="list-group-item disabled" aria-disabled="true"><strong> CORREO:</strong> {{ $this->complain->user->email ?? null }}</li>
                    <li class="list-group-item disabled" aria-disabled="true"><strong> DESCRIPCIÓN:</strong> {{ $this->content['description'] ?? null }}</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary"
                    wire:click="$toggle('show_modal')"
                >
                    <i class="fas fa-times"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </x-modal>
</div>



