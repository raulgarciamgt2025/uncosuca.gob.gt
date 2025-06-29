<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Revisión de datos de pago - {{ $this->workflowRequest->workflow->name }} {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}</strong>
    </h2>
    <div class="card-body">
        <form>
            <div class="alert alert-primary text-center">
                <h5><strong>Instrucciones: </strong>Seleccione los datos que deben corregirse.</h5>
            </div>
            <h3>Formulario:</h3>
            <hr class="my-2">
            <ul class="list-group">
                <li class="list-group-item">
                    <div class="form-check form-switch">
                        <input class="form-check-input" wire:change="updateMessage" type="checkbox" role="switch" wire:model="{{ 'inputs.subscribers_number' }}">
                        <strong>{{ $this->inputs_desc['subscribers_number'] }}:</strong>
                        {{ $this->upload_documents_json['subscribers_number'] }}
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-check form-switch">
                        <input class="form-check-input" wire:change="updateMessage" type="checkbox" role="switch" wire:model="{{ 'inputs.voucher_number' }}">
                        <strong>{{ $this->inputs_desc['voucher_number'] }}:</strong>
                        {{ $this->upload_documents_json['voucher_number'] }}
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="form-check form-switch">
                        <input class="form-check-input" wire:change="updateMessage" type="checkbox" role="switch" wire:model="{{ 'inputs.voucher_amount' }}">
                        <strong>{{ $this->inputs_desc['voucher_amount'] }}:</strong>
                        {{ $this->upload_documents_json['voucher_amount'] }}
                    </div>
                </li>
            </ul>
            <hr class="my-2">
            <h3>Boleta:</h3>
            <hr class="my-2">
            <div style="text-align: center">
                <div class="form-switch" style="display: inline-flex">
                    <input class="form-check-input" type="checkbox" wire:change="updateMessage"
                           wire:model="inputs.voucher">
                    &nbsp;
                    <a class="link-dark" target="_blank" title="Abrir en otra pestaña" href="/storage/{{ $this->upload_documents_json['voucher'] }}">
                        <h4>Boleta o comprobante de pago <i class="fa-solid fa-square-arrow-up-right"></i></h4>
                    </a>
                </div>
                <br>
                <iframe style="width: 60%; height: 60rem"  src="/storage/{{ $this->upload_documents_json['voucher'] }}"></iframe>
            </div>
            <hr class="my-2">
            <button type="button" class="btn btn-primary" wire:click="showConfirmModal">
                <div wire:loading.remove wire:target="showConfirmModal">
                    <i class="fas fa-save"></i>
                    {{ $this->message }}
                </div>
                <div wire:loading wire:target="showConfirmModal">
                    <div class="spinner-border text-white" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </button>
        </form>
    </div>
    <x-modal wire:model="confirm_modal" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">DATOS A CORREGIR</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('confirm_modal')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach($this->rejected_inputs ?? [] as $key => $value)
                        <li>
                            {{ $this->inputs_desc[$key] }}
                        </li>
                        @php($this->json[$key] = $this->inputs_desc[$key] )
                    @endforeach
                </ul>
                <x-inputs.textarea
                    name="observations"
                    label="Observaciones adicionales"
                    wire:model="observations">
                </x-inputs.textarea>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('confirm_modal')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" wire:click="submit">
                    <div wire:loading.remove wire:target="submit">
                        <i class="fas fa-save"></i>
                        Continuar
                    </div>
                    <div wire:loading wire:target="submit">
                        <div class="spinner-border text-white" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </x-modal>
</div>

