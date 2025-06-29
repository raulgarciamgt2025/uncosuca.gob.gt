@props(['id'])

<a
    class="btn btn-sm btn-primary"
    href="{{ route('make-visit', $id) }}">
    <i class="fa-solid fa-list-check"></i>
    Ejecutar
</a>
