<div class="card p-2">
    <h2 class="card-title px-4">
        <strong>Autorización de requisitos - {{ $this->workflowRequest->workflow->name }} {{ $this->workflowRequest->process_type ?
            $this->workflowRequest->process_type == 1 ? '(Individual)' : '(Jurídico)' : ''}}</strong>
    </h2>
    <div class="card-body">
        @include('livewire.components.view-data')
        <button type="button" wire:click="submit" class="btn btn-primary">Confirmar autorización</button>
        <button type="button" wire:click="showModal('modal_reject')" class="btn btn-secondary">Rechazar documentos</button>
        <button type="button" wire:click="showModal('modal_cancel')" class="btn btn-danger">Anular proceso</button>
    </div>
    <x-modal wire:model="modal_reject" maxWidth="lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">REGRESAR EXPEDIENTE A LOS AUXILIARES DE REGISTRO</h5>
                <button
                    type="button"
                    class="btn"
                    wire:click="$toggle('modal_reject')"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <x-inputs.textarea
                    name="observations"
                    label="Motivo de rechazo"
                    wire:model="observations">
                </x-inputs.textarea>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-danger"
                    wire:click="$toggle('modal_reject')"
                >
                    <i class="fas fa-times"></i>
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" wire:click="rejected">
                    <div wire:loading.remove wire:target="rejected">
                        <i class="fas fa-save"></i>
                        Continuar
                    </div>
                    <div wire:loading wire:target="rejected">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                </button>
            </div>
        </div>
    </x-modal>
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

