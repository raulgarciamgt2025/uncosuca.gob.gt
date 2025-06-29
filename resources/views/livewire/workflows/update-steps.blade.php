<div class="container">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Seleccionar</th>
        </tr>
        </thead>
        <tbody>
        @foreach($workflows as $workflow)
            <tr>
                <th scope="row">{{ $workflow->id }}</th>
                <td>{{ $workflow->name }}</td>
                <td>
                    <button wire:click="selectWorkflow({{ $workflow->id }})" class="btn btn-sm btn-primary">
                        Seleccionar
                    </button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
         @if($workflowSelected ?? null)
            <div class="alert alert-danger">
                Estos cambios afectarán a los nuevos trámites de <strong>{{ $workflowSelected->name }}</strong>
            </div>
         @endif
        <div wire:ignore id="jsoneditor" style="width: 100%; height: 500px;"></div>
        <button wire:click="save" class="btn btn-success my-2">Guardar</button>
        <script src="https://cdn.jsdelivr.net/npm/jsoneditor@9.5.6/dist/jsoneditor.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/jsoneditor@9.5.6/dist/jsoneditor.min.css" rel="stylesheet" type="text/css">
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let container = document.getElementById('jsoneditor');
            let options = {
                mode: 'tree',
                onChange: function () {
                    @this.set('jsonData', JSON.stringify(editor.get()));
                }
            };
            let editor = new JSONEditor(container, options);

            Livewire.on('showJson', data => {
                editor.set(JSON.parse(data.jsonData));
            });
        });
    </script>
@endpush
