@props(['status' => 0])

@switch($status)
    @case(1)
        <span class="badge bg-primary">Enviado</span>
        @break
    @case(2)
        <span class="badge bg-success">Visto</span>
        @break
    @default
        <span class="badge bg-secondary">Desconocido</span>
@endswitch
