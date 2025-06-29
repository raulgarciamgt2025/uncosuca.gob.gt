<div class="card p-0">
    <h2 class="card-title px-4">
        <strong>Ejecutando supervisión de la empresa {{ $this->company->mercantile_name ?? '' }}</strong>
    </h2>
    <hr class="my-2">
    <div class="card-body">
        @if($this->visit->status == 3)
            <div class="alert alert-danger">
                <h5><strong>Motivo de rechazo: </strong>{{ $this->visit->reject_motive }}</h5>
            </div>
        @endif
        <form wire:submit.prevent="submit">
            <div class="alert alert-primary text-center">
                <h5><strong>Instrucciones: </strong>Complete el formulario de supervisión.</h5>
            </div>
            <h3 class="card-title">
                <strong>Datos de la empresa</strong>
            </h3>
            <ul class="list-group">
                <div class="row">
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Nombre:</strong>
                            {{ $company->mercantile_name ?? '' }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>NIT:</strong>
                            {{ $company->nit ?? '' }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Municipio:</strong>
                            {{ $company->municipality->name ?? '' }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Departamento:</strong>
                            {{ $company->municipality->province->name ?? '' }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Aldea:</strong>
                            {{ $company->village }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Dirección:</strong>
                            {{ $company->address }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Estación Terrena:</strong>
                            {{ $company->station_address }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Cobertura:</strong>
                            {{ $company->coverage }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Propietarios:</strong>
                            {{ $company->owners }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Representante Legal:</strong>
                            {{ $company->legal_representative }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>DPI:</strong>
                            {{ $company->cui }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Teléfonos:</strong>
                            {{ $company->phone }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Correos:</strong>
                            {{ ($company->emails[0] ?? null) .' '. ($emails[1] ?? null) }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Usuarios:</strong>
                            {{ $company->users_number }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Resolución:</strong>
                            {{ $company->resolution }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Latitud:</strong>
                            {{ $company->latitude }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Longitud:</strong>
                            {{ $company->longitude }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Fecha Inicio:</strong>
                            {{ $company->start_date->format('d/m/Y') }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Fecha Fin:</strong>
                            {{ $company->end_date->format('d/m/Y') }}
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Tipo:</strong>
                            <x-company-type-badge :type="$company->company_type"/>
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Estado:</strong>
                            <x-company-status :status="$company->status"/>
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Pagos:</strong>
                            <x-company-payment-status :status="$company->payment_status"/>
                        </li>
                    </div>
                </div>
                <ul class="list-group">
                    <div class="row">
                        <div class="col-6">
                            <li class="list-group-item">
                                    <strong>¿Legalmente inscrita?:</strong>
                                <input wire:model="visitData.legally_registered" class="form-check-input" type="checkbox">
                            </li>
                        </div>
                        <div class="col-6">
                            <li class="list-group-item">
                                <strong>¿Autorizada?:</strong>
                                <input wire:model="visitData.authorized" class="form-check-input" type="checkbox">
                            </li>
                        </div>
{{--                        <div class="col-6">--}}
{{--                            <li class="list-group-item">--}}
{{--                                <strong>¿Autorizada?:</strong>--}}
{{--                                <input wire:model="visitData.authorized" class="form-check-input" type="text">--}}
{{--                            </li>--}}
{{--                        </div>--}}
                    </div>
                </ul>
            </ul>
            <h3 class="card-title">
                <strong>Señales encontradas en supervisión</strong>
            </h3>
            <ul class="list-group">
                <div class="row">
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Canales varios:</strong>
                            <input wire:model="visitData.channels.varios" class="form-check-input" type="checkbox">
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Canales varios 2:</strong>
                            <input wire:model="visitData.channels.varios2" class="form-check-input" type="checkbox">
                        </li>
                    </div>
                    <div class="col-12 text-start px-sm-3">
                        <br>
                        <strong><h5> Canales con representación</h5></strong>
                    </div>
                    @foreach($channels as $channel)
                        <div class="col-12">
                            <li class="list-group-item">
                                <div class="row">
                                    <label for="inputPassword" class="col-sm-2 col-form-label">{{ $channel }}</label>
                                    <div class="col-sm-2">
                                        <input wire:model="visitData.channelsRepresentation.{{ $channel }}.active" class="form-check-input" type="checkbox">
                                    </div>
                                    <div class="col-sm-8">
                                        <input wire:model="visitData.channelsRepresentation.{{ $channel }}.note" type="text" class="form-control" placeholder="NOTA">
                                    </div>
                                </div>
                            </li>
                        </div>
                    @endforeach
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Calidad de la señal</strong>
                            <select class="form-control"  wire:model="visitData.signal_quality">
                                <option value="Buena">Buena</option>
                                <option value="Regular">Regular</option>
                                <option value="Mala">Mala</option>
                            </select>
                        </li>
                    </div>
                    <div class="col-6">
                        <li class="list-group-item">
                            <strong>Número de canales</strong>
                            <input type="number" class="form-control" wire:model="visitData.number_channels">
                        </li>
                    </div>
                </div>
            </ul>
            <h3 class="card-title">
                <strong>Red de distribución y captación de señales</strong>
                <p>Mantenga presionado CTRL para seleccionar varias opciones</p>
            </h3>
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">RED:</label>
                                <div class="col-sm-9">
                                    <select wire:model="visitData.network.distribution" multiple size="{{ count($distributionsNetwork) }}" class="form-control">
                                        @foreach($distributionsNetwork as $key => $distributionNetwork)
                                            <option value="{{ $distributionNetwork }}">{{ $distributionNetwork }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-2 col-form-label">ANTENA:</label>
                                <div class="col-sm-9">
                                    <select wire:model="visitData.network.catchment" multiple size="{{ count($signalPickup) }}" class="form-control">
                                        @foreach($signalPickup as $key => $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Servicio de internet:</label>
                                <div class="col-sm-9">
                                    <input wire:model="visitData.internetService" class="form-check-input" type="checkbox">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="mb-3 row">
                                <label for="inputPassword" class="col-sm-3 col-form-label">Persona que atendió:</label>
                                <div class="col-sm-8">
                                    <input wire:model="visitData.person_who_attended" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="row">
                        <div class="col-sm-6">
                            <x-inputs.text
                                name="latitude"
                                required
                                label="Latitud"
                                wire:model="visitData.latitude">
                            </x-inputs.text>
                        </div>
                        <div class="col-sm-6">
                            <x-inputs.text
                                name="longitude"
                                required
                                label="Longitud"
                                wire:model="visitData.longitude">
                            </x-inputs.text>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <x-inputs.textarea
                    name="observations"
                    label="Observaciones"
                    wire:model="visitData.observations">
                    </x-inputs.textarea>
                </li>
            </ul>
            <h3 class="card-title">
                <strong>Canales</strong>
            </h3>
            <ul class="list-group">
                <div class="row">
                    @foreach($channelCategories as $category)
                        <strong> {{ $category->name }}</strong>

                            @foreach($category->channels as $item)
                                <div class="col-sm-auto">
                                    <li class="list-group-item">
                                        <strong>{{ $item->name }}:</strong>
                                        <input  wire:model="visitData.companyChannels.{{ $category->name }}.{{ $item->name }}"
                                                class="form-control" type="text" placeholder="Número actual">
                                    </li>
                                </div>
                            @endforeach
                    @endforeach
                </div>
            </ul>
            <h3 class="card-title">
                <strong>Fotografías</strong>
                <p>Mantenga presionado CTRL para seleccionar varias imágenes</p>
            </h3>
            <div class="row">
                <x-inputs.group class="col-lg-6" >
                    <x-inputs.image
                        label="IMÁGENES"
                        multiple="multiple"
                        name="visitData.images"
                        description="Seleccione las imágenes necesarias"
                        wire:model="visitData.images"
                    >
                    </x-inputs.image>
                </x-inputs.group>
            </div>
            <br>
        <button type="submit" class="btn btn-success">Enviar Formulario <i class="fa-regular fa-paper-plane"></i></button>
        </form>
    </div>
</div>
