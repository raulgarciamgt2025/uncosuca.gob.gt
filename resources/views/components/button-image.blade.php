@props([
    'image_url'
])
@if($image_url)
    <a class="btn btn-sm btn-info" href="storage/{{ $image_url }}" target="_blank" title="Ver"><i class="fa-solid fa-location-dot"></i></a>
@endif
