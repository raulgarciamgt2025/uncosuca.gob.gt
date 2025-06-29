<div class="card">
    <div class="card-header p-2">
        <h3 class="text-center">Historial de la empresa {{ $company->mercantile_name ?? '' }}</h3>
    </div>
    <div class="card-body p-2">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Descripción</th>
                <th>Observaciones</th>
                <th>Documento</th>
                <th>Fecha de creación</th>
            </tr>
            </thead>
            <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{ $document->description }}</td>
                    <td>{{ $document->observations }}</td>
                    <td class="text-center">
                        <a target="_blank" class="link-success"
                           title="Abrir en otra pestaña"
                           href="storage/{{ $document->url }}">
                            <i class="fa-solid fa-file-pdf"></i>
                            Ver
                        </a>
                    </td>
                    <td>{{ $document->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer text-right">
        <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar</button>
    </div>
</div>

