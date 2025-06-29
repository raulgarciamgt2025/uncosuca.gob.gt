<div class="card">
    <div class="card-header">
        <h3 class="card-title">Historial de solicitudes</h3>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Solicitud</th>
                <th>Fecha creación</th>
                <th>Usuario</th>
                <th>Fecha Inicio</th>
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
                    <td>{{$request->created_at->format('d/m/y - H:i')}}</td>
                    <td>{{ $request->user?->name }}</td>
                    <td>{{optional($request->start_date)->format('d/m/y - H:i') ?? '-'}}</td>
                    <td>
                        <x-badge-status :state="$request->state"/>
                    </td>
                    <td>{{$stage->description  ?? '-' }}</td>
                    <td>
                        <div class="btn-group-md text-center">
                            <button class="btn btn-success" {{ $show }} wire:click="showRequest({{$request}})">Procesar</button>
                            <button class="btn btn-primary" wire:click="$emit('openModal', 'components.tracking-modal',
                            {{ json_encode(['json' => $request->status_log, 'key' => $request->key ])  }})">Detalles</button>
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
            <tfoot>
                <tr>
                    <td colspan="7">{!! $links !!} </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
