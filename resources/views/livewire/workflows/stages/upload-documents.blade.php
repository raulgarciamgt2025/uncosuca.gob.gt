<div class="card">
    <div class="card-header">
        <h2 class="card-title px-4">
            <strong>Requisitos - {{ $this->workflowRequest->workflow->name }} {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}</strong>
        </h2>
    </div>
    <div class="card-body">
        <form wire:submit.prevent="submit">
            <div class="alert alert-primary text-center">
                <h5><strong>Instrucciones: </strong>Llene el siguiente formulario y cargue los archivos solicitados en pdf. Los campos con (*) son obligatorios.</h5>
            </div>
            @if(count($this->form) > 0)
                <h3>Formulario</h3>
                <hr class="my-2">
                <div class="row">
                    @foreach($this->form as $field)
                        @include('livewire.components.form-upload-documents')
                    @endforeach
                </div>
            @else
                <h3>Datos del vendedor</h3>
                <hr class="my-2">
                <div class="row">
                    @foreach($this->seller as $field)
                        @include('livewire.components.form-upload-documents')
                    @endforeach
                </div>
                <hr class="my-2">
                <h3>Datos del comprador o nuevo propietario</h3>
                <hr class="my-2">
                <div class="row">
                    @foreach($this->new_owner_data as $field)
                        @include('livewire.components.form-upload-documents')
                    @endforeach
                </div>
            @endif
            <hr class="my-2">
            @if(count($this->documents) > 0)
                <h3>Documentos:</h3>
                <hr class="my-2">
                <div class="row">
                    @foreach($this->documents as $document)
                        @php
                            $model_document = 'inputs.'.$document['name'];
                            $required = $document['required'] == 'required' ? '  (*)' : '';
                        @endphp
                        @if($this->correction)
                            @if(key_exists($document['name'], $this->correction_fields))
                                <x-inputs.group class="col-lg-6">
                                    <x-inputs.file
                                        label="{{ mb_strtoupper($document['label']).$required}}"
                                        description="{{ $document['description'] }}"
                                        name="{{ $model_document }}"
                                        wire:model="{{ $model_document }}"/>
                                </x-inputs.group>
                            @else
                                @php
                                    unset($this->rules['inputs.'.$document['name']]);
                                    unset($this->inputs[$document['name']])
                                @endphp
                            @endif
                        @else
                            <x-inputs.group class="col-lg-6">
                                <x-inputs.file
                                    label="{{ mb_strtoupper($document['label']).$required}}"
                                    description="{{ $document['description'] }}"
                                    name="{{ $model_document }}"
                                    wire:model="{{ $model_document }}"/>
                            </x-inputs.group>
                        @endif
                    @endforeach

                </div>
                <hr class="my-2">
            @endif
            <button type="submit" class="btn btn-primary">Enviar información</button>
            <button type="button" wire:click="showModalCancel" class="btn btn-danger">Anular proceso</button>
        </form>
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
                    <div wire:loading.remove wire:target="cancelProcess">
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

