<div class="card">
    <div class="card-header py-0">
        <h3 class="card-title">Historial de mis solicitudes</h3>
    </div>
    <div class="card-body">
        <div class="col-md-3 py-2">
            <div class="input-group">
                <input
                    type="text"
                    name="search"
                    placeholder="{{ __('crud.common.search') }}"
                    wire:model="search"
                    class="form-control"
                    autocomplete="off"
                /> &nbsp;
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Solicitud</th>
                    <th>Código</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Estado</th>
                    <th>Etapa actual</th>
                    <th class="text-center">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @forelse($workflowRequests as $request)
                    @php
                        $show = $request->hasPermission() ? '' : 'hidden';
                        $stage = $request->getLastStage()
                    @endphp
                    <tr>
                        <td>{{$request->workflow->name}}</td>
                        <td>{{$request->key}}</td>
                        <td>{{optional($request->start_date)->format('d/m/y - H:i') ?? '-'}}</td>
                        <td>{{optional($request->end_date)->format('d/m/y - H:i')  ?? '-' }}</td>
                        <td>
                            <x-badge-status :state="$request->state"/>
                        </td>
                        <td>{{$stage->description  ?? '-' }}</td>
                        <td>
                            <div class="btn-group-md text-center">
                                <button class="btn btn-success " {{ $show }} wire:click="showRequest({{$request}})">Procesar</button>
                                <button class="btn btn-primary" wire:click="$emit('openModal', 'components.tracking-modal',
                            {{ json_encode(['key' => $request->key ])  }})">Detalles</button>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            @lang('crud.common.no_items_found')
                        </td>
                    </tr>
                @endforelse
                </tbody>
                @if($workflowRequests->hasPages())
                    <tfoot>
                    <tr>
                        <td colspan="5">{{$workflowRequests->links()}}</td>
                    </tr>
                    </tfoot>
                @endif
            </table>
        </div>
    </div>
    @if($this->workflow_request ?? null)
        <x-modal wire:model="modal_ranking" maxWidth="lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">¡CALIFÍCANOS!</h5>
                    <button
                        type="button"
                        class="btn"
                        wire:click="$toggle('modal_ranking')"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <h6>¡Tu {{  $this->workflow_request->workflow->name ?? null}} ha finalizado correctamente!</h6>
                    <br>
                    <div wire:ignore class="rating">
                        <input wire:change="countStars(5)" type="radio" id="star5" name="rating">
                        <label for="star5"></label>
                        <input wire:change="countStars(4)" type="radio" id="star4" name="rating">
                        <label for="star4"></label>
                        <input wire:change="countStars(3)" type="radio" id="star3" name="rating">
                        <label for="star3"></label>
                        <input wire:change="countStars(2)" type="radio" id="star2" name="rating">
                        <label for="star2"></label>
                        <input wire:change="countStars(1)" type="radio" id="star1" name="rating">
                        <label for="star1"></label>
                    </div>
                    @if($ranking_void)
                        <h6 style="color: #ef4444">Selecciona la cantidad de estrellas</h6>
                    @endif
                    <br>
                    <x-inputs.textarea
                        wire:model="message"
                        label="Tu opinión es importante para nosotros"
                        name="message"
                        placeholder="Escribe tus comentarios aquí..."
                    >
                    </x-inputs.textarea>
                    <br>
                    <button type="button" class="btn btn-primary" wire:click="setRanking">
                        <div wire:loading.remove wire:target="setRanking">
                            Enviar calificación
                            <i class="fa-brands fa-telegram"></i>
                        </div>
                        <div wire:loading wire:target="setRanking">
                            <div class="spinner-border text-secondary" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </button>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-danger"
                        wire:click="$toggle('modal_ranking')"
                    >
                        <i class="fas fa-times"></i>
                        Cerrar
                    </button>
                </div>
            </div>
        </x-modal>
        @push('style')
            <style>
                .rating {
                    display: inline-block;
                    direction: rtl; /* Cambiar la dirección a derecha a izquierda */
                }

                .rating input {
                    display: none;
                }

                .rating label {
                    cursor: pointer;
                    width: 40px;
                    height: 40px;
                    font-size: 45px;
                    color: #ccc;
                    margin: 0;
                    padding: 0;
                    line-height: 30px;
                    text-align: center;
                }

                .rating label:before {
                    content: '\2605';
                }

                .rating input:checked ~ label {
                    color: #e0a62e;
                }

                .rating label:hover,
                .rating label:hover ~ label {
                    color: #e0a62e;
                }

            </style>
        @endpush
    @endif
</div>
@push('scripts')
    <script>
        window.addEventListener('load', function () {
            @this.
            set('modal_ranking', true)
        });
    </script>
@endpush
