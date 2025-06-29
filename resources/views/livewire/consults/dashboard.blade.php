<div class="p-2">
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>
{{--    <div class="container text-center">--}}
{{--        <div class="btn-group bg-light py-4" role="group" aria-label="Basic example">--}}
{{--            <input type="radio" class="btn-check" name="type" id="1" autocomplete="off" checked>--}}
{{--            <label class="btn btn-outline-primary" for="1">Hoy</label>--}}
{{--            <input type="radio" class="btn-check" name="type" id="2" autocomplete="off">--}}
{{--            <label class="btn btn-outline-primary" for="2">Este Mes</label>--}}
{{--            <input type="radio" class="btn-check" name="type" id="3" autocomplete="off">--}}
{{--            <label class="btn btn-outline-primary" for="3">Este Año</label>--}}
{{--        </div>--}}
{{--    </div>--}}
    <section class="section dashboard">
        <div class="row pe-2">
            <div class="col-xxl-2 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">TOTAL</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-hashtag"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $total }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">FINALIZADO</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-check"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $success }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-xl-12">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">EN PROCESO</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-spinner"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $process }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="col-xxl-2 col-xl-12">--}}
{{--                <div class="card info-card requested-card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">SOLICITADO</h5>--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div--}}
{{--                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">--}}
{{--                                <i class="fa-solid fa-user-check"></i>--}}
{{--                            </div>--}}
{{--                            <div class="ps-3">--}}
{{--                                <h6>{{ $requested }}</h6>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-xxl-2 col-xl-12">
                <div class="card info-card failed-card">
                    <div class="card-body">
                        <h5 class="card-title">RECHAZADO</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-x"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $failed }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-xl-12">
                <div class="card info-card cancel-card">
                    <div class="card-body">
                        <h5 class="card-title">CANCELADO</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-user-xmark"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $cancel }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-2 col-xl-12">
                <div class="card info-card ranking-card">
                    <div class="card-body">
                        <h5 class="card-title">CALIFICACIÓN GENERAL</h5>
                        <div class="d-flex align-items-center">
                            <div
                                class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="fa-solid fa-star"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $general_ranking ?? 0 }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reports -->
{{--            <div class="col-12">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <h5 class="card-title">Reporte de Ventas</h5>--}}
{{--                        <!-- Line Chart -->--}}
{{--                        <div id="reportsChart"></div>--}}
{{--                        <!-- End Line Chart -->--}}
{{--                    </div>--}}

{{--                </div>--}}
{{--            </div>--}}
            <!-- End Reports -->
            <!-- Recent Sales -->
            <div class="col-12">
                <div class="card recent-sales overflow-auto">
                    <div class="card-body">
                        <h5 class="card-title">Procesos</h5>
                        <table class="table table-hover table-responsive">
                            <thead>
                            <tr>
                                <th scope="col">Nombre</th>
                                <th scope="col"  class="text-center">Finalizado</th>
                                <th scope="col"  class="text-center">En proceso</th>
{{--                                <th scope="col"  class="text-center">Solicitado</th>--}}
                                <th scope="col"  class="text-center">Rechazado</th>
                                <th scope="col"  class="text-center">Cancelado</th>
                                <th scope="col"  class="text-center">Total</th>
                                <th scope="col"  class="text-center">Calificación promedio</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($proceses as $process)
                                @php
                                    $requests = collect($process->workflowRequests()->get());
                                    $ranking = round($requests->where('ranking', '!=', null)->avg('ranking.stars'), 1);
                                    $type = $process->double_process == 1 ? '(Individual o Jurídico)' : '';
                                @endphp
                                <tr>
                                    <td>{{ $process->name .' '. $type }}</td>
                                    <td class="text-center">{{ $requests->where('state', 2)->count() }}</td>
                                    <td class="text-center">{{ $requests->where('state', 1)->count() }}</td>
{{--                                    <td class="text-center">{{ $requests->where('state', 0)->count() }}</td>--}}
                                    <td class="text-center">{{ $requests->where('state', 3)->count() }}</td>
                                    <td class="text-center">{{ $requests->where('state', 4)->count() }}</td>
                                    <td class="text-center">{{ $requests->where('state','>',  0)->count() }}
                                    <td class="text-center">{{ $ranking ?? 0 }} <i class="fa-solid fa-star" style="color: #ea9e44"></i></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
            <!-- End Recent Sales -->
        </div>
    </section>
</div>
