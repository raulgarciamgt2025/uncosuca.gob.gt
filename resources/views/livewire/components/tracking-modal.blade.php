<div class="card">
    <div class="card-header p-2">
        <h3 class="text-center">Detalle de etapas</h3>
    </div>
    <div class="card-body p-2">
        <ul class="list-group border">
            @foreach($stages as $key => $stage)
                @php
                    $date = $stage->state == 1 ?  $stage->updated_at : null;
                    $this_stage =  $this->workflowRequest->stateStages[$key];
                    $next_stage = $this->workflowRequest->stateStages[$key + 1] ?? null;
                    $status = $this->workflowRequest->state;
                    $rejected_motive = $this->workflowRequest->getRejectedMotive()
                @endphp
                <li class="list-group-item d-flex">
                    <h5>
                        <span class="badge  bg-primary">{{ $date ? $date->format('d/m/Y - h:i A')
                            : 'Pendiente'}}</span>
                        @if($status == 3  || $status == 4)
                            @if($this_stage->state == 1 && $next_stage && $next_stage->state == 0)
                                <i class="fa-solid fa-circle-xmark"
                                   style="color: #ef4444; cursor: pointer"></i>
                            @elseif($this_stage->state == 0)
                                <i class="fa-solid fa-spinner" style="color: gray"></i>
                            @else
                                <i class="fa-solid fa-circle-check" style="color: #7AB700"></i>
                            @endif
                        @else
                            @if($this_stage->state == 1)
                                <i class="fa-solid fa-circle-check" style="color: #7AB700"></i>
                            @else
                                <i class="fa-solid fa-spinner" style="color: gray"></i>
                            @endif
                        @endif
                    </h5>&nbsp;
                    {{ $stage['description'] }}
                </li>
            @endforeach
        </ul>
        @if($this->finish)
            <h5 class="text-center">Proceso finalizado en {{ $this->finish }}</h5>
        @endif
        @if($rejected_motive)
            <div class="alert alert-danger p-2" role="alert">
                <strong>Motivo:</strong> {{$rejected_motive}}
            </div>
        @endif
    </div>
   <div class="card-footer text-right">
       <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar</button>
   </div>
</div>

