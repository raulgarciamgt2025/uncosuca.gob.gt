<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Firma de Dictamen - {{ $this->workflowRequest->workflow->name }} {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}  {{ $this->workflowRequest->start_date->format('d/m/Y') }}</strong>
    </h2>
    <div class="card-body">
        <form wire:submit.prevent="submit">
            <h3>Datos para dictamen:</h3>
            <hr class="my-2">
            <div class="row">
                @foreach($this->fields_name as $field)
                    <x-inputs.group class="col-lg-6" >
                        <x-inputs.text
                            label="{{ $this->form_responses[$field]['description'] ?? 'NUMERO'}}"
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
            <button type="button" class="btn btn-primary" wire:click="preview">
                <div wire:loading.remove wire:target="preview">
                    PREVISUALIZAR DICTAMEN
                    <i class="fa-solid fa-file-pdf"></i>
                </div>
                <div wire:loading wire:target="preview">
                    <div class="spinner-border text-white" role="status">
                        <span class="sr-only"></span>
                    </div>
                </div>
            </button>
        </p>
        <div class="collapse" id="expedient">
            @include('livewire.components.view-data')
        </div>
        @if($this->preview_pdf)
            <div class="card-body" style="text-align: center">
                <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{ $this->preview_pdf }}">
                    <h4>DICTAMEN <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                </a>
                <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $this->preview_pdf }}?time={{date('Y-m-d H:i:s')}}"></iframe>
            </div>
        @endif
        <hr class="my-2">
        <button type="button" wire:click="generateOpinion" class="btn btn-primary">Firmar Dictamen</button>
        <button type="button" wire:click="showModal('modal_cancel')" class="btn btn-danger">Anular proceso</button>
    </div>
    <x-modal wire:model="modal_cancel" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¡ESTA ACCIÓN ANULARÁ POR COMPLETO EL PROCESO!</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('modal_cancel')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <x-inputs.textarea
                    name="observations"
                    label="Indica el motivo"
                    wire:model="observations">
                </x-inputs.textarea>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('modal_cancel')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" wire:click="cancelProcess">
                    <div wire:loading.remove wire:target="rejected">
                        <i class="fas fa-save"></i>
                        Continuar
                    </div>
                    <div wire:loading wire:target="cancelProcess">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </x-modal>
</div>


