<div class="card p-1">
    <h2 class="card-title px-4">
        <strong>DETALLE DE PROCESO - {{ $this->workflowRequest->workflow->name }}  {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}</strong>
    </h2>
    <h5 class="text-center">
        Estado: <x-badge-status :state="$this->workflowRequest->state"/>
    </h5>
    <div class="card-body" wire:ignore>
        <hr class="my-2">
        <p class="p-1">
            @foreach($steps as $step)
                @php
                    $icon = $step->state == 1 ? 'fa-clipboard-check': 'fa-spinner';
                    $color = $step->state == 1 ? 'success': 'secondary';
                    $title = $step->state == 1 ? 'Finalizado': 'Pendiente'
                @endphp
                <a class="btn btn-outline-{{$color}}" data-bs-toggle="collapse" href="#step-{{  $step->type }}" role="button"
                   aria-expanded="false" aria-controls="collapseExample" title="{{ $title }}">
                    {{ $step->type }}. {{$step['description']}} <i class="fa-solid {{ $icon }}"></i>
                </a>
            @endforeach
        </p>
        @foreach($steps as $key => $step)
            @switch($step->type)
                @case(1)
                    <div class="collapse" id="step-{{ $step->type }}">
                        <hr class="my-2">
                        <h4> {{ ($step->type).'. '. $step->description }}</h4>
                        <ul class="list-group">
                            <li class="list-group-item disabled" aria-disabled="true"><strong>ESTADO: </strong><x-badge-state-stage :state="$step->state"/></li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>RESPONSABLE: </strong>Solicitante</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>USUARIO: </strong>{{ $step->user->name ?? ''}} {{ $step->user->surname  ?? ''}}</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>FECHA Y HORA DE FINALIZACIÓN DE ETAPA: </strong>
                                {{ $step->state == 1 ? $step->updated_at->format('d/m/Y h:i A') : ''}}</li>
                            <li class="list-group-item " aria-disabled="false">
                                <button type="button" class="btn btn-primary" wire:click="showModalHistory('{{ $step->type }}')">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    Ver historial
                                </button>
                            </li>
                        </ul>
                        <br>
                        <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#detail-0" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Ver Expediente <i class="fa-solid fa-eye"></i>
                        </a>
                        <div class="collapse" id="detail-0">
                            <br>
                            @include('livewire.components.view-data')
                        </div>
                    </div>
                    @break
                @case(2)
                    <div class="collapse" id="step-{{ $step->type }}">
                        <hr class="my-2">
                        <h4>{{ ($step->type).'. '. $step->description }}</h4>
                        <ul class="list-group">
                            <li class="list-group-item disabled" aria-disabled="true"><strong>ESTADO: </strong><x-badge-state-stage :state="$step->state"/></li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>RESPONSABLE: </strong>Auxiliar del Departamento de Registro</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>USUARIO: </strong>{{ $step->user->name ?? ''}} {{ $step->user->surname  ?? ''}}</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>FECHA Y HORA DE FINALIZACIÓN DE ETAPA: </strong>{{ $step->state == 1 ? $step->updated_at->format('d/m/Y h:i A') : ''}}</li>
                            <li class="list-group-item " aria-disabled="false">
                                <button type="button" class="btn btn-primary" wire:click="showModalHistory('{{ $step->type }}')">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    Ver historial
                                </button>
                            </li>
                        </ul>
                        <hr class="my-2">
                    </div>
                    @break
                @case(3)
                    <div class="collapse" id="step-{{ $step->type }}">
                        <h4>{{ ($step->type).'. '. $step->description }}</h4>
                        <ul class="list-group">
                            <li class="list-group-item disabled" aria-disabled="true"><strong>ESTADO: </strong><x-badge-state-stage :state="$step->state"/></li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>RESPONSABLE: </strong>Jefe del Departamento de Registro</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>USUARIO: </strong>{{ $step->user->name ?? ''}} {{ $step->user->surname  ?? ''}}</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>FECHA Y HORA DE FINALIZACIÓN DE ETAPA: </strong>{{ $step->state == 1 ? $step->updated_at->format('d/m/Y h:i A') : ''}}</li>
                            <li class="list-group-item " aria-disabled="false">
                                <button type="button" class="btn btn-primary" wire:click="showModalHistory('{{ $step->type }}')">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    Ver historial
                                </button>
                            </li>
                        </ul>
                        <hr class="my-2">
                    </div>
                    @break
                @case(4)
                    <div class="collapse" id="step-{{ $step->type }}">
                        <h4>{{ ($step->type).'. '. $step->description }}</h4>
                        <ul class="list-group">
                            <li class="list-group-item disabled" aria-disabled="true"><strong>ESTADO: </strong><x-badge-state-stage :state="$step->state"/></li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>RESPONSABLE: </strong>Auxiliar del Departamento Jurídico</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>USUARIO: </strong>{{ $step->user->name ?? ''}} {{ $step->user->surname  ?? ''}}</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>FECHA Y HORA DE FINALIZACIÓN DE ETAPA: </strong>{{ $step->state == 1 ? $step->updated_at->format('d/m/Y h:i A') : ''}}</li>
                            <li class="list-group-item " aria-disabled="false">
                                <button type="button" class="btn btn-primary" wire:click="showModalHistory('{{ $step->type }}')">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    Ver historial
                                </button>
                            </li>
                        </ul>
                        <hr class="my-2">
                    </div>
                    @break
                @case(5)
                    <div class="collapse" id="step-{{ $step->type }}">
                        @php($json = json_decode($step->json, true))
                        <h4>{{ ($step->type).'. '. $step->description }}</h4>
                        <ul class="list-group">
                            <li class="list-group-item disabled" aria-disabled="true"><strong>ESTADO: </strong><x-badge-state-stage :state="$step->state"/></li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>RESPONSABLE: </strong>Jefe del Departamento Jurídico</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>USUARIO: </strong>{{ $step->user->name ?? '' }} {{ $step->user->surname ?? ''}}</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>FECHA Y HORA DE FINALIZACIÓN DE ETAPA: </strong>{{ $step->state == 1 ? $step->updated_at->format('d/m/Y h:i A') : ''}}</li>
                            <li class="list-group-item " aria-disabled="false">
                                <button type="button" class="btn btn-primary" wire:click="showModalHistory('{{ $step->type }}')">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    Ver historial
                                </button>
                            </li>
                        </ul>
                        <br>
                        <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#detail-4" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Ver Dictamen <i class="fa-solid fa-eye"></i>
                        </a>
                        <div class="collapse text-center" id="detail-4">
                            <br>
                            @if($json['opinion'] ?? null)
                                <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{  $json['opinion'] ?? '' }}">
                                    <h4>{{ $json['description'] ?? '' }} <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                                </a>
                                <br>
                                <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $json['opinion'] }}"></iframe>
                            @else
                                <div class="alert alert-danger text-center">
                                    <h5>No se ha cargado este documento</h5>
                                </div>
                            @endif
                        </div>
                        <hr class="my-2">
                    </div>
                    @break
                @case(6)
                    <div class="collapse" id="step-{{ $step->type }}">
                        @php($json = json_decode($step->json, true))
                        <h4>{{ ($step->type).'. '. $step->description }}</h4>
                        <ul class="list-group">
                            <li class="list-group-item disabled" aria-disabled="true"><strong>ESTADO: </strong><x-badge-state-stage :state="$step->state"/></li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>RESPONSABLE: </strong>Director UNCOSU</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>USUARIO: </strong>{{ $step->user->name ?? '' }} {{ $step->user->surname ?? ''}}</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>FECHA Y HORA DE FINALIZACIÓN DE ETAPA: </strong>{{ $step->state == 1 ? $step->updated_at->format('d/m/Y h:i A') : ''}}</li>
                            <li class="list-group-item " aria-disabled="false">
                                <button type="button" class="btn btn-primary" wire:click="showModalHistory('{{ $step->type }}')">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    Ver historial
                                </button>
                            </li>
                        </ul>
                        <br>
                        <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#detail-5" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Ver Resolución <i class="fa-solid fa-eye"></i>
                        </a>
                        <div class="collapse text-center" id="detail-5">
                            <br>
                            @if($json['authorization'] ?? null)
                                <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{  $json['authorization'] ?? '' }}">
                                    <h4>{{ $json['description'] ?? '' }} <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                                </a>
                                <br>
                                <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $json['authorization'] }}"></iframe>
                            @else
                                <div class="alert alert-danger text-center">
                                    <h5>No se ha cargado este documento</h5>
                                </div>
                            @endif
                        </div>
                        <hr class="my-2">
                    </div>
                    @break
                @case(7)
                    <div class="collapse" id="step-{{ $step->type }}">
                        @php($json = json_decode($step->json, true))
                        <h4>{{ ($step->type).'. '. $step->description }}</h4>
                        <ul class="list-group">
                            <li class="list-group-item disabled" aria-disabled="true"><strong>ESTADO: </strong><x-badge-state-stage :state="$step->state"/></li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>RESPONSABLE: </strong>Jefe del Departamento de Registro </li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>USUARIO: </strong>{{ $step->user->name ?? '' }} {{ $step->user->surname ?? ''}}</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>FECHA Y HORA DE FINALIZACIÓN DE ETAPA: </strong>{{ $step->state == 1 ? $step->updated_at->format('d/m/Y h:i A') : ''}}</li>
                            <li class="list-group-item " aria-disabled="false">
                                <button type="button" class="btn btn-primary" wire:click="showModalHistory('{{ $step->type }}')">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    Ver historial
                                </button>
                            </li>
                        </ul>
                        <br>
                        @if($this->workflowRequest->workflow->type == 1)
                            <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#detail-6" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Ver Boleta <i class="fa-solid fa-eye"></i>
                            </a>
                            <div class="collapse text-center" id="detail-6">
                                <br>
                                @if($json['pay_slip'] ?? null)
                                    <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{  $json['pay_slip'] ?? '' }}">
                                        <h4>{{ $json['description'] ?? 'Boleta de pago' }} <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                                    </a>
                                    <br>
                                    <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $json['pay_slip'] }}"></iframe>
                                @else
                                    <div class="alert alert-danger text-center">
                                        <h5>No se ha cargado este documento</h5>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <hr class="my-2">
                    </div>
                    @break
                @case(8)
                    <div class="collapse" id="step-{{ $step->type }}">
                        @php($json = json_decode($step->json, true))
                        <h4>{{ ($step->type).'. '. $step->description }}</h4>
                        <ul class="list-group">
                            <li class="list-group-item disabled" aria-disabled="true"><strong>ESTADO: </strong><x-badge-state-stage :state="$step->state"/></li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>RESPONSABLE: </strong>Solicitante</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>USUARIO: </strong>{{ $step->user->name ?? '' }} {{ $step->user->surname ?? ''}}</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>FECHA Y HORA DE FINALIZACIÓN DE ETAPA: </strong>{{ $step->state == 1 ? $step->updated_at->format('d/m/Y h:i A') : ''}}</li>
                            <li class="list-group-item " aria-disabled="false">
                                <button type="button" class="btn btn-primary" wire:click="showModalHistory('{{ $step->type }}')">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                    Ver historial
                                </button>
                            </li>
                        </ul>
                        <br>
                        <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#detail-7" role="button" aria-expanded="false" aria-controls="collapseExample">
                            Ver Datos <i class="fa-solid fa-eye"></i>
                        </a>
                        <div class="collapse text-center" id="detail-7">
                            <br>
                            <ul class="list-group">
                                <li class="list-group-item disabled" aria-disabled="true"><strong>NÚMERO DE SUSCRIPTORES: </strong>{{ $json['subscribers_number'] ?? '' }}</li>
                                <li class="list-group-item disabled" aria-disabled="true"><strong>NÚMERO DE BOLETA: </strong>{{ $json['voucher_number'] ?? '' }}</li>
                                <li class="list-group-item disabled" aria-disabled="true"><strong>MONTO DE BOLETA: </strong>{{ $json['voucher_amount'] ?? '' }}</li>
                            </ul>
                            @if($json['voucher'] ?? null)
                                <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{  $json['voucher'] ?? '' }}">
                                    <h4>{{ $json['description'] ?? 'Boleta' }} <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                                </a>
                                <br>
                                <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $json['voucher'] }}"></iframe>
                            @else
                                <div class="alert alert-danger text-center">
                                    <h5>No se ha cargado este documento</h5>
                                </div>
                            @endif
                        </div>
                        <hr class="my-2">
                    </div>
                    @break
                @default
                    <div class="collapse" id="step-{{ $step->type }}">
                        <h4>{{ ($step->type).'. '. $step->description }}</h4>
                        <ul class="list-group">
                            <li class="list-group-item disabled" aria-disabled="true"><strong>ESTADO: </strong><x-badge-state-stage :state="$step->state"/></li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>RESPONSABLE: </strong>Jefe del Departamento de Registro</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>USUARIO: </strong>{{ $step->user->name ?? ''}} {{ $step->user->surname  ?? ''}}</li>
                            <li class="list-group-item disabled" aria-disabled="true"><strong>FECHA Y HORA DE FINALIZACIÓN DE ETAPA: </strong>{{ $step->state == 1 ? $step->updated_at->format('d/m/Y h:i A') : ''}}</li>
                        </ul>
                        <hr class="my-2">
                    </div>

            @endswitch
        @endforeach
        @if($this->workflowRequest->state == 3 || $this->workflowRequest->state == 4)
            <br>
            <div class="alert alert-danger">
                <h5>{{ $this->workflowRequest->getRejectedMotive() }}</h5>
            </div>
        @endif
        @if($this->workflowRequest->state == 2)
            <br>
            <div class="alert alert-success p-2 text-center">
                <h5>Proceso finalizado en: {{ $this->finish }}</h5>
                @if(count($this->ranking ?? []) > 0)
                    <h5>Calificación: {{ $this->ranking['stars'] ?? '0' }} Estrellas
                        <button type="button" class="btn btn-sm btn-primary" title="Ver mensaje" data-bs-toggle="collapse" data-bs-target="#message" aria-expanded="false" >
                            <i class="fa-solid fa-comment-dots"></i>
                        </button>
                    </h5>
                    <div class="collapse" id="message">
                        {{ $this->ranking['message'] ?? '' }}
                    </div>
                @endif
            </div>
        @endif
    </div>
    <x-modal wire:model="modal_history" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Historial de acciones</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('modal_history')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                @forelse(($this->history ?? []) as $item)
                    <div class="card">
                        <div class="card-header">
                            {{ $item['title'] }} - {{ \Illuminate\Support\Carbon::parse($item['date'])->format('d/m/Y H:i A') ?? '' }}
                        </div>

                        <div class="card-body">
                            <ul>
                                @foreach(($item['list'] ?? []) as $item_list)
                                    <li>{{ $item_list }}</li>
                                @endforeach
                            </ul>
                            <p><strong>Descripción: </strong> {{ $item['description'] ?? '' }}</p>
                        </div>
                    </div>
                @empty
                    <p>No hay registros</p>
                @endforelse
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('modal_history')"
                >
                    <i class="fas fa-times"></i>
                    Cerrar
                </button>
            </div>
        </div>
    </x-modal>
</div>




