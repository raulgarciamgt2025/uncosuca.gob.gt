<div>
    <div class="card-header p-2">
        <h3>Crear nuevo pago</h3>
    </div>
    <div class="card-body p-2">
        <form wire:submit.prevent="submit">
            <div class="row">
                @if(count($companies) > 0)
                    <x-inputs.group class="col-lg-12">
                        <x-inputs.select
                            label="EMPRESA"
                            name="company_id"
                            wire:model="company_id"
                        >
                            @if(count($companies) > 1)
                                <option value="">Seleccione una empresa</option>
                            @endif
                            @foreach($companies as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                @else
                    <div class="col-lg-12">
                        <div class="alert alert-warning">
                            <i class="fa-solid fa-exclamation-triangle"></i>
                            <strong>Atención:</strong> No tiene empresas asignadas. Contacte al administrador para que le asigne una empresa y pueda crear pagos.
                        </div>
                    </div>
                @endif
                
                @if(count($companies) > 0)
                    <x-inputs.group class="col-lg-6">
                        <x-inputs.select
                            label="ESTADO"
                            name="estado"
                            wire:model="estado"
                        >
                            @foreach($estados as $value => $name)
                                <option value="{{ $value }}">{{ $name }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                    
                    <x-inputs.group class="col-lg-6">
                        <x-inputs.number
                            label="USUARIOS"
                            name="usuarios"
                            wire:model="usuarios"
                            min="0"
                            placeholder="Número de usuarios"
                            readonly
                        >
                        </x-inputs.number>
                        <div class="form-text">
                            <i class="fa-solid fa-info-circle"></i>
                            Campo solo de lectura
                        </div>
                    </x-inputs.group>
                @endif
                
                @if(count($companies) > 0)
                    <x-inputs.group class="col-lg-6">
                        <x-inputs.select
                            label="MES"
                            name="month"
                            wire:model="month"
                        >
                            @foreach($months as $value => $name)
                                <option value="{{ $value }}">{{ $name }}</option>
                            @endforeach
                        </x-inputs.select>
                    </x-inputs.group>
                    
                    <x-inputs.group class="col-lg-6">
                        <x-inputs.number
                            label="AÑO"
                            name="year"
                            wire:model="year"
                            min="2023"
                            max="{{ date('Y') + 1 }}"
                        >
                        </x-inputs.number>
                    </x-inputs.group>
                    
                    <x-inputs.group class="col-lg-6">
                        <x-inputs.text
                            label="MONTO"
                            name="total"
                            wire:model="total"
                            type="number"
                            step="0.01"
                            min="0"
                            placeholder="0.00"
                        >
                        </x-inputs.text>
                    </x-inputs.group>
                    
                    <x-inputs.group class="col-lg-6">
                        <x-inputs.text
                            label="FECHA DE PAGO"
                            name="fecha_pago"
                            wire:model="fecha_pago"
                            type="date"
                        >
                        </x-inputs.text>
                    </x-inputs.group>
                    
                    <x-inputs.group class="col-lg-12">
                        <x-inputs.text
                            label="NÚMERO DE FORMULARIO"
                            name="numero_formulario"
                            wire:model="numero_formulario"
                            placeholder="Ingrese el número de formulario"
                        >
                        </x-inputs.text>
                    </x-inputs.group>
                    
                    <x-inputs.group class="col-lg-12">
                        <label for="pdf_document" class="form-label">DOCUMENTO PDF</label>
                        <input type="file" 
                               class="form-control @error('pdf_document') is-invalid @enderror" 
                               id="pdf_document" 
                               wire:model="pdf_document"
                               accept=".pdf">
                        @error('pdf_document')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">
                            <i class="fa-solid fa-info-circle"></i>
                            Seleccione un archivo PDF (máximo 10MB) - Opcional
                        </div>
                        @if ($pdf_document)
                            <div class="mt-2">
                                <i class="fa-solid fa-file-pdf text-danger"></i>
                                <small class="text-success">Archivo seleccionado: {{ $pdf_document->getClientOriginalName() }}</small>
                            </div>
                        @endif
                    </x-inputs.group>
                    
                    <x-inputs.group class="col-lg-12">
                        <x-inputs.textarea
                            label="OBSERVACIONES"
                            name="observaciones"
                            wire:model="observaciones"
                            placeholder="Observaciones adicionales (opcional)"
                            rows="3"
                        >
                        </x-inputs.textarea>
                    </x-inputs.group>
                @endif
            </div>
            
            @if(count($companies) > 0)
                <div class="alert alert-info mt-3">
                    <i class="fa-solid fa-info-circle"></i>
                    <strong>Nota:</strong> Complete todos los campos requeridos para crear el registro de pago.
                </div>
            @endif
        </form>
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar <i class="fa-solid fa-xmark"></i></button>
        @if(count($companies) > 0)
            <button class="btn btn-primary" wire:click="submit" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submit">Crear pago <i class="fa-solid fa-plus"></i></span>
                <span wire:loading wire:target="submit">
                    <i class="fa-solid fa-spinner fa-spin"></i> Creando...
                </span>
            </button>
        @endif
        
        <!-- File upload progress indicator -->
        <div wire:loading wire:target="pdf_document" class="mt-2">
            <div class="text-primary">
                <i class="fa-solid fa-spinner fa-spin"></i>
                Cargando archivo...
            </div>
        </div>
    </div>
</div>
