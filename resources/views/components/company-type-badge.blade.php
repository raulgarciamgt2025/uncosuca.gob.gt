@props(['type' => 0])

@switch($type)
    @case(1)
        <span class="badge bg-primary">Individual</span>
        @break
    @default
        <span class="badge bg-primary">Jurídico</span>
@endswitch
