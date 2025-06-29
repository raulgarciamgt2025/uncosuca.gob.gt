<form>
    <div class="alert alert-primary text-center">
        <h5>Expediente completo</h5>
    </div>
    @if($this->last_stage->json ?? null)
        <div class="alert alert-danger text-center">
            <h5><strong>Motivo de rechazo: </strong>{{ json_decode($this->last_stage->json, true)['reject_motive'] ?? '' }}</h5>
        </div>
    @endif
    @if(count($this->form))
        <h3>Formulario:</h3>
        <hr class="my-2">
        @foreach($form as $key => $field)
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>{{ mb_strtoupper($field['description']) }}:</strong>
                    {{ $field['response'] }}
                </li>
            </ul>
        @endforeach
        <hr class="my-2">
    @endif
    @if(count($this->seller))
        <h3>Datos del vendedor</h3>
        <hr class="my-2">
        @foreach($seller as $key => $field)
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>{{ mb_strtoupper($field['description']) }}:</strong>
                    {{ $field['response'] }}
                </li>
            </ul>
        @endforeach
        <hr class="my-2">
        <h3>Datos del comprador o nuevo propietario</h3>
        <hr class="my-2">
        @foreach($new_owner as $key => $field)
            <ul class="list-group">
                <li class="list-group-item">
                    <strong>{{ mb_strtoupper($field['description']) }}:</strong>
                    {{ $field['response'] }}
                </li>
            </ul>
        @endforeach
    @endif
    <h3>Documentos:</h3>
    <hr class="my-2">
    @php($first_item = true)
    <ul wire:ignore class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        @foreach($documents as $name => $document)
            @php($selected = $first_item ? 'active' : '')
            <li class="nav-item" role="presentation">
                <button class="nav-link border {{ $selected }}" data-bs-toggle="pill"
                        data-bs-target="#document-{{ $name }}" type="button" role="tab"
                        aria-controls="#document-{{ $name }}" aria-selected="true">{{  mb_strtoupper($document['description'] ?? '') }}</button>
            </li>
            @php($first_item = false)
        @endforeach
    </ul>
    <div wire:ignore class="tab-content text-center" id="pills-tabContent">
        @php($first_item = true)
        @foreach($documents as $name => $document)
            @php($selected = $first_item ? 'active' : '')
            <div class="tab-pane fade show {{ $selected }} " id="document-{{ $name }}" role="tabpanel" aria-labelledby="{{ $name }}">
                @if($document['url'] ?? null)
                    <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{ $document['url']}}">
                        <h4>{{ $document['description'] }} <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                    </a>
                    <br>
                    <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $document['url'] }}"></iframe>
                @else
                    <a class="link-dark">
                        <h4>{{ $document['description'] }} <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                    </a>
                    <br>
                    <div class="alert alert-danger text-center">
                        <h5>No se ha cargado este documento</h5>
                    </div>
                @endif
            </div>
            @php($first_item = false)
        @endforeach
    </div>
    <hr class="my-2">
</form>
