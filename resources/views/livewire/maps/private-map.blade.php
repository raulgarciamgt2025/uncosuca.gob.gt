<div class="card p-0">
    <h2 class="card-title px-4 row">
        <div class="col">
            <strong>Mapa de ubicación de empresas</strong>
        </div>
    </h2>
    <hr>
    <div class="card-body mb-0 row justify-content-center" wire:ignore>
        <livewire:companies.company-table to_beat="false" to_map="true"/>
        <div style="height :65vh; width: 90%"  id="map"></div>
{{--        <div class="row">--}}
{{--            <div class="col-lg-6">--}}
{{--                <livewire:companies.company-table to_beat="false" to_map="true"/>--}}
{{--            </div>--}}
{{--            <div class="col-lg-6">--}}
{{--                <div style="height :70vh; width: 100%"  id="map"></div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
    <x-modal wire:model="modal_company" maxWidth="xl">
        @if($this->company ?? null)
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title px-4">{{ $this->company->mercantile_name }}</h5>
                    <button
                        type="button"
                        class="btn"
                        wire:click="$toggle('modal_company')"
                    >
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <ul class="list-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <li class="list-group-item">
                                        <strong>Nombre:</strong>
                                        {{ $company->mercantile_name ?? '' }}
                                    </li>
                                </div>
                                <div class="col-lg-6">
                                    <li class="list-group-item">
                                        <strong>Municipio:</strong>
                                        {{ $company->municipality->name ?? '' }}
                                    </li>
                                </div>
                                <div class="col-lg-6">
                                    <li class="list-group-item">
                                        <strong>Departamento:</strong>
                                        {{ $company->municipality->province->name ?? '' }}
                                    </li>
                                </div>
                                <div class="col-lg-6">
                                    <li class="list-group-item">
                                        <strong>Teléfonos:</strong>
                                        {{ $company->phone }}
                                    </li>
                                </div>
                                <div class="col-lg-6">
                                    <li class="list-group-item">
                                        <strong>Correos:</strong>
                                        {{ ($company->emails[0] ?? null) .' '. ($emails[1] ?? null) }}
                                    </li>
                                </div>
                                <div class="col-lg-6">
                                    <li class="list-group-item">
                                        <strong>Latitud:</strong>
                                        {{ $company->latitude }}
                                    </li>
                                </div>
                                <div class="col-lg-6">
                                    <li class="list-group-item">
                                        <strong>Longitud:</strong>
                                        {{ $company->longitude }}
                                    </li>
                                </div>
                                @auth()
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Imagen de referencia:</strong>
                                            @if($company->location_image)
                                                <a target="_blank" href="storage/{{ $company->location_image }}">Ver <i class="fa-solid fa-location-dot"></i></a>
                                            @else
                                                No encontrada
                                            @endif
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>NIT:</strong>
                                            {{ $company->nit ?? '' }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Aldea:</strong>
                                            {{ $company->village }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Dirección:</strong>
                                            {{ $company->address }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Estación Terrena:</strong>
                                            {{ $company->station_address }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Cobertura:</strong>
                                            {{ $company->coverage }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Propietarios:</strong>
                                            {{ $company->owners }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Representante Legal:</strong>
                                            {{ $company->legal_representative }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>DPI:</strong>
                                            {{ $company->cui }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Usuarios:</strong>
                                            {{ $company->users_number }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Resolución:</strong>
                                            {{ $company->resolution }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Fecha Inicio:</strong>
                                            {{ $company->start_date->format('d/m/Y') }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Fecha Fin:</strong>
                                            {{ $company->end_date->format('d/m/Y') }}
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Tipo:</strong>
                                            <x-company-type-badge :type="$company->company_type"/>
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Estado:</strong>
                                            <x-company-status :status="$company->status"/>
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Pagos:</strong>
                                            <x-company-payment-status :status="$company->payment_status"/>
                                        </li>
                                    </div>
                                    <div class="col-lg-6">
                                        <li class="list-group-item">
                                            <strong>Historial de trámites:</strong>
                                            <x-modal-history-button company_id="{{ $company->id }}"></x-modal-history-button>
                                        </li>
                                    </div>
                                @endauth
                            </div>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-danger"
                        wire:click="$toggle('modal_company')"
                    >
                        <i class="fas fa-times"></i>
                        Cerrar
                    </button>
                </div>
            </div>
        @endif
    </x-modal>
</div>
@push('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ env('MAPS_KEY') }}" async defer>
    </script>
    <script>
        let map;
        window.addEventListener('load', function () {
            Livewire.emit('loadMap')
        });
        Livewire.on('load-map', points => {
            initMap(points)
        })
        function initMap(points) {
            // Configura el mapa
            if (points) {
                let points_parse = JSON.parse(points)
                let map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: 15.801009, lng: -90.258745}, // Cambia estas coordenadas por las deseadas
                    zoom: 7 // Puedes ajustar el nivel de zoom
                });
                points_parse.forEach(function(company) {
                    let point = {
                        lat: parseFloat(company.latitude),
                        lng: parseFloat(company.longitude),
                    }
                    let marker = new google.maps.Marker({
                        position: point,
                        map: map,
                        icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
                        title: "Clic para ver detalles",
                    });
                    marker.addListener("click", () => {
                        map.setZoom(16);
                        map.setCenter(marker.getPosition());
                        Livewire.emit('showCompany', company.id)
                    });
                });
            }
        }
    </script>
@endpush
