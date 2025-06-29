@props(['type' => 0])

@switch($type)
    @case(1)
        <span class="badge bg-warning text-dark">Queja <i class="fa-solid fa-circle-xmark"></i></span>
        @break
    @case(2)
        <span class="badge bg-danger">Denuncia <i class="fa-solid fa-circle-exclamation"></i></span>
        @break
    @default
        <span class="badge bg-secondary">Sugerencia <i class="fa-solid fa-file-pen"></i></span>
@endswitch
