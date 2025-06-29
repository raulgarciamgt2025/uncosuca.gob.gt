<div class="card">
    <div class="card-header p-2">
        <h3 class="text-center">Historial de la empresa {{ $company->mercantile_name ?? '' }}</h3>
    </div>
    <div class="card-body p-2">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Solicitud</th>
                    <th>Resolución</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            @foreach($history as $item)

                <tr>
                    @if(isset($item['process_type']))
                        @php
                            $workflow = \App\Models\Workflow::where('type', $workflowRequest['process_type'])->first()
                        @endphp
                        <td>Trámite</td>
                        <td>{{ $workflow->name ?? '' }}</td>
                        <td>
                            <a target="_blank" class="btn btn-link" href="{{ 'storage/'.$workflowRequest['resolution_url'] }}">
                                Abrir <i class="fa-solid fa-file-pdf"></i>
                            </a>
                        </td>
                        <td>{{ $workflowRequest['resolution_date'] }}</td>
                        <td>
                            <a target="_blank" class="btn btn-link" href="{{ route('details-key', $workflowRequest['key']) }}">
                                Expediente <i class="fa-solid fa-square-arrow-up-right"></i>
                            </a>
                        </td>
                    @else
                        <td>Supervisión</td>
                        <td></td>
                        <td></td>
                        <td>{{ \Illuminate\Support\Carbon::parse($item['created_at'])->format('d/m/Y') }}</td>
                        <td>
                            <a target="_blank" class="btn btn-link" href="{{ route('show-visit', $item['id']) }}">
                                Expediente <i class="fa-solid fa-square-arrow-up-right"></i>
                            </a>
                        </td>
                    @endif

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
   <div class="card-footer text-right">
       <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar</button>
   </div>
</div>

