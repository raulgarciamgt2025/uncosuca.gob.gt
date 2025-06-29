<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Firma de Resolución - {{ $this->workflowRequest->workflow->name }} {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}  {{ $this->workflowRequest->start_date->format('d/m/Y') }}</strong>
    </h2>
    <div class="card-body">
        <form wire:submit.prevent="submit">
            <h3>Datos para Resolución:</h3>
            <hr class="my-2">
            <div class="row">
                @foreach($this->fields_name as $field)
                    <x-inputs.group class="col-lg-6" >
                        <x-inputs.text
                            label="{{ $this->form_responses[$field]['description'] ?? 'NÚMERO'}}"
                            name="fields.{{$field}}"
                            placeholder=""
                            wire:model.defer="fields.{{$field}}">
                        </x-inputs.text>
                    </x-inputs.group>
                @endforeach
            </div>
            <hr class="my-2">
        </form>
        <p>
            <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#expedient" role="button" aria-expanded="false" aria-controls="collapseExample">
                VER EXPEDIENTE <i class="fa-solid fa-eye"></i>
            </a>
            <a class="btn btn-outline-primary" data-bs-toggle="collapse" href="#opinion" role="button" aria-expanded="false" aria-controls="collapseExample">
                VER DICTAMEN FIRMADO <i class="fa-solid fa-file-signature"></i>
            </a>
            <button type="button" class="btn btn-primary" wire:click="preview">
                <div wire:loading.remove wire:target="preview">
                    PREVISUALIZAR AUTORIZACIÓN
                    <i class="fa-solid fa-file-pdf"></i>
                </div>
                <div wire:loading wire:target="preview">
                    <div class="spinner-border text-white" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </button>
        </p>
        <div wire:loading wire:target="preview">
            <div class="spinner-border text-white" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div class="collapse" id="expedient">
            @include('livewire.components.view-data')
        </div>
        <div class="collapse" id="opinion">
            @if($this->signed_opinion['opinion'] ?? null)
                <div class="card-body" style="text-align: center">
                    <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{ $this->signed_opinion['opinion'] ?? '' }}">
                        <h4>{{ $this->signed_opinion['description'] ?? '' }} <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                    </a>
                    <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $this->signed_opinion['opinion'] ?? '' }}?time={{date('Y-m-d H:i:s')}}"></iframe>
                </div>
            @else
                <div class="alert alert-danger text-center">
                    <h5>No se ha cargado este documento</h5>
                </div>
            @endif
        </div>
        @if($this->preview_pdf)
            <div class="card-body" style="text-align: center">
                <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{ $this->preview_pdf }}">
                    <h4>AUTORIZACIÓN <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                </a>
                <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $this->preview_pdf }}?time={{date('Y-m-d H:i:s')}}"></iframe>
            </div>
        @endif
        <hr class="my-2">
        <button type="button" wire:click="showModal('modal_pin')" class="btn btn-primary">Firmar Documento</button>
    </div>
    <x-modal wire:model="modal_pin" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">RECUERDA CONFIGURAR TUS CREDENCIALES EN TU PERFIL</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('modal_pin')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <x-inputs.text
                    name="pin"
                    label="INGRESA TU PIN"
                    wire:model="pin">
                </x-inputs.text>
                <br>
                @if($this->alert)
                    <div class="alert alert-danger" role="alert">
                        {{ $this->alert }}
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('modal_pin')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" wire:click="generateAuthorization">
                    <div wire:loading.remove wire:target="generateAuthorization">
                        <i class="fa-solid fa-file-signature"></i>
                        Firmar
                    </div>
                    <div wire:loading wire:target="generateAuthorization">
                        <div class="spinner-border text-white" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </x-modal>
</div>





