@props(['status' => 0])

@switch($status)
    @case(1)
        <span class="badge bg-success">Activa</span>
        @break
    @default
        <span class="badge bg-danger">Inactiva</span>
@endswitch
