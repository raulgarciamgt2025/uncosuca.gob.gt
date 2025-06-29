@props(['status'])

@switch($status)
    @case(1)
        <span class="badge bg-primary">EN REVISIÓN</span>
        @break
    @case(2)
        <span class="badge bg-success">PAGADO</span>
        @break
    @case(3)
        <span class="badge bg-danger">RECHAZADO</span>
        @break
    @default
        <span class="badge bg-secondary">PENDIENTE</span>
@endswitch
