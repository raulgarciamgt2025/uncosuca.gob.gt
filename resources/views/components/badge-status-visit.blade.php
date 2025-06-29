@props(['status' => 0])

@switch($status)
    @case(1)
        <span class="badge bg-primary">Finalizado</span>
        @break
    @case(2)
        <span class="badge bg-success">Aceptado</span>
        @break
    @case(3)
        <span class="badge bg-danger">Rechazado</span>
        @break
    @default
        <span class="badge bg-secondary">Pendiente</span>
@endswitch
