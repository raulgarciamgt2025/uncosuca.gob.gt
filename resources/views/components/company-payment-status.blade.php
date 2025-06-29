@props(['status' => 0])

@switch($status)
    @case(1)
        <span class="badge bg-success">Solvente</span>
        @break
    @default
        <span class="badge bg-danger">Morosa</span>
@endswitch
