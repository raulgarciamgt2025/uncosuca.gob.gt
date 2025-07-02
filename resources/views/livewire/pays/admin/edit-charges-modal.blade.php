<div>
    <div class="modal-header">
        <h5 class="modal-title">
            <i class="fa-solid fa-coins"></i>
            Editar Cargos - Pago #{{ $pay->id }}
        </h5>
    </div>
    
    <div class="modal-body">
        <!-- Company Information -->
        <div class="alert alert-info mb-3">
            <strong>Empresa:</strong> {{ $pay->company->mercantile_name ?? 'N/A' }}<br>
            <strong>Año:</strong> {{ $pay->year }} | 
            <strong>Mes:</strong> {{ $pay->mount }}
        </div>

        <form wire:submit.prevent="save">
            <div class="row">
                <!-- Users Field -->
                <div class="col-md-12 mb-3">
                    <label for="usuarios" class="form-label">
                        <strong>Número de Usuarios</strong>
                    </label>
                    <input type="number" 
                           min="0" 
                           class="form-control @error('usuarios') is-invalid @enderror" 
                           id="usuarios" 
                           wire:model="usuarios"
                           placeholder="0">
                    @error('usuarios')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">
                        <i class="fa-solid fa-info-circle"></i>
                        Número de usuarios suscritos para este pago
                    </div>
                </div>
                
                <!-- Penalty Field -->
                <div class="col-md-6 mb-3">
                    <label for="penalty" class="form-label">
                        <strong>Multa</strong>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">Q</span>
                        <input type="number" 
                               step="0.01" 
                               min="0" 
                               class="form-control @error('penalty') is-invalid @enderror" 
                               id="penalty" 
                               wire:model="penalty"
                               placeholder="0.00">
                        @error('penalty')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">
                        <i class="fa-solid fa-info-circle"></i>
                        Monto de la multa aplicada
                    </div>
                </div>

                <!-- Variable Field -->
                <div class="col-md-6 mb-3">
                    <label for="variable" class="form-label">
                        <strong>Recargo</strong>
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">Q</span>
                        <input type="number" 
                               step="0.01" 
                               min="0" 
                               class="form-control @error('variable') is-invalid @enderror" 
                               id="variable" 
                               wire:model="variable"
                               placeholder="0.00">
                        @error('variable')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-text">
                        <i class="fa-solid fa-info-circle"></i>
                        Monto del recargo aplicado
                    </div>
                </div>
            </div>

            <!-- Current Values Display -->
            <div class="row mt-3">
                <div class="col-12">
                    <div class="card bg-light">
                        <div class="card-body py-2">
                            <h6 class="card-title mb-2">
                                <i class="fa-solid fa-calculator"></i>
                                Resumen de Cargos
                            </h6>
                            <div class="row text-center">
                                <div class="col-3">
                                    <strong>Monto:</strong><br>
                                    <span class="text-primary">Q {{ number_format((float)($pay->amount ?? 0), 2) }}</span>
                                </div>
                                <div class="col-3">
                                    <strong>Multa:</strong><br>
                                    <span class="text-danger">Q {{ number_format((float)($penalty ?? 0), 2) }}</span>
                                </div>
                                <div class="col-3">
                                    <strong>Recargo:</strong><br>
                                    <span class="text-warning">Q {{ number_format((float)($variable ?? 0), 2) }}</span>
                                </div>
                                <div class="col-3">
                                    <strong>Total:</strong><br>
                                    <span class="text-success">
                                        <strong>Q {{ number_format((float)($pay->amount ?? 0) + (float)($penalty ?? 0) + (float)($variable ?? 0), 2) }}</strong>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" wire:click="$emit('closeModal')">
            <i class="fa-solid fa-times"></i>
            Cancelar
        </button>
        <button type="button" class="btn btn-primary" wire:click="save">
            <i class="fa-solid fa-save"></i>
            Guardar Cargos
        </button>
    </div>
</div>

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('refresh-page', (data) => {
            setTimeout(() => {
                window.location.reload();
            }, data.delay || 1000);
        });
    });
</script>
