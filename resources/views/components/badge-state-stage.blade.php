@props(['state' => 0])

@switch($state)
    @case(1)
        <span class="badge bg-success"><i class="fa-solid fa-clipboard-check"></i> Finalizado</span>
        @break
    @default
        <span class="badge bg-secondary"><i class="fa-solid fa-spinner"></i> Pendiente</span>
@endswitch
