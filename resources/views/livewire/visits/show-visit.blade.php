<div class="card p-0">
    <h2 class="card-title px-4">
        <strong>Visita {{ $this->visit->id }} - {{ $this->visit->company->mercantile_name }}</strong>
    </h2>
    @if($this->visit->response)
        <div class="card-body">
            <hr class="my-2">
            <div class="text-center">
                @if($this->pdf)
                    <iframe style="width: 60%; height: 60rem" src="/{{ $this->pdf }}"></iframe>
                @endif
            </div>
            @if($this->visit->status == 1)
                <button type="button" class="btn btn-success" wire:click="submit">Aceptar visita <i class="fa-regular fa-paper-plane"></i></button>
                <button type="button" class="btn btn-danger" wire:click="shoModal">Rechazar visita <i class="fa-solid fa-xmark"></i></button>
            @endif
        </div>
        <x-modal wire:model="modal_rejected" maxWidth="lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">RECHAZAR VISITA</h5>
                    <button
                        type="button"
                        class="btn"
                        wire:click="$toggle('modal_rejected')"
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
                        wire:click="$toggle('modal_rejected')"
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
    @else
        <div class="card-body">
            <h6>Aún no se cargan datos de la visista</h6>
        </div>
    @endif
</div>
