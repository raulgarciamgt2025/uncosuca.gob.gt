@props(['state' => 0])

@switch($state)
    @case(1)
        <span class="badge bg-primary">En proceso</span>
        @break
    @case(2)
        <span class="badge bg-success">Finalizado</span>
        @break
    @case(3)
        <span class="badge bg-danger">Rechazado</span>
        @break
    @case(4)
        <span class="badge bg-secondary">Cancelado</span>
        @break
    @default
        <span class="badge bg-secondary">Solicitado</span>
@endswitch
