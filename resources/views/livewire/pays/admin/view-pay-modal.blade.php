<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="fa-solid fa-eye"></i>
            Detalles del Pago #{{ $pay->id }}
        </h5>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Company Information -->
            <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Empresa:</strong></label>
                <p class="form-control-plaintext">{{ $pay->company->mercantile_name ?? 'N/A' }}</p>
            </div>
            
            <!-- Payment Status -->
            <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Estado del Pago:</strong></label>
                <div class="form-control-plaintext">
                    @switch($pay->status)
                        @case(0)
                            <span class="badge bg-warning">PENDIENTE</span>
                            @break
                        @case(2)
                            <span class="badge bg-success">APROBADO</span>
                            @break
                        @case(3)
                            <span class="badge bg-danger">RECHAZADO</span>
                            @break
                        @default
                            <span class="badge bg-secondary">DESCONOCIDO</span>
                    @endswitch
                </div>
            </div>
            
            <!-- Payment Type -->
            <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Tipo:</strong></label>
                <div class="form-control-plaintext">
                    @if($pay->estado)
                        <span class="badge {{ $pay->estado === 'CUOTA' ? 'bg-primary' : 'bg-info' }}">
                            {{ $pay->estado }}
                        </span>
                    @else
                        <span class="text-muted">-</span>
                    @endif
                </div>
            </div>
            
            <!-- Year and Month -->
            <div class="col-md-3 mb-3">
                <label class="form-label"><strong>Año:</strong></label>
                <p class="form-control-plaintext">{{ $pay->year }}</p>
            </div>
            
            <div class="col-md-3 mb-3">
                <label class="form-label"><strong>Mes:</strong></label>
                <p class="form-control-plaintext">{{ $months[$pay->mount] ?? $pay->mount }}</p>
            </div>
            
            <!-- Users and Amount -->
            <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Número de Usuarios:</strong></label>
                <p class="form-control-plaintext">{{ number_format($pay->pay ?? 0) }}</p>
            </div>
            
            <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Total:</strong></label>
                <p class="form-control-plaintext">
                    <strong>Q {{ number_format($pay->amount ?? 0, 2) }}</strong>
                </p>
            </div>
            
            <!-- Payment Date -->
            <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Fecha de Pago:</strong></label>
                <p class="form-control-plaintext">
                    {{ $pay->fecha_pago ? $pay->fecha_pago->format('d/m/Y') : '-' }}
                </p>
            </div>
            
            <!-- Form Number -->
            <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Número de Formulario:</strong></label>
                <p class="form-control-plaintext">{{ $pay->ticket_number ?: '-' }}</p>
            </div>
            
            <!-- Document -->
            <div class="col-md-12 mb-3">
                <label class="form-label"><strong>Documento PDF:</strong></label>
                <div class="form-control-plaintext">
                    @if($pay->ticket_file)
                        <a href="{{ asset('storage/' . $pay->ticket_file) }}" 
                           target="_blank" 
                           class="btn btn-sm btn-outline-danger">
                            <i class="fa-solid fa-file-pdf"></i> Ver Documento PDF
                        </a>
                    @else
                        <span class="badge bg-secondary">Sin documento</span>
                    @endif
                </div>
            </div>
            
            <!-- Observations -->
            <div class="col-md-12 mb-3">
                <label class="form-label"><strong>Observaciones:</strong></label>
                <div class="form-control-plaintext">
                    {{ $pay->observaciones ?: 'Sin observaciones' }}
                </div>
            </div>
            
            <!-- Created Date -->
            <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Fecha de Creación:</strong></label>
                <p class="form-control-plaintext">{{ $pay->created_at->format('d/m/Y H:i') }}</p>
            </div>
            
            <!-- Updated Date -->
            <div class="col-md-6 mb-3">
                <label class="form-label"><strong>Última Actualización:</strong></label>
                <p class="form-control-plaintext">{{ $pay->updated_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-secondary" wire:click="$emit('closeModal')">
            <i class="fa-solid fa-times"></i> Cerrar
        </button>
    </div>
</div>
