<div>
    <div class="card-header p-2">
        <h4>Revisar datos de pago</h4>
    </div>
    <div class="card-body p-2">
        <h4 class="text-center">
            <strong>
                {{ $months[$pay->mount < 10 ? ltrim($pay->mount, '0') : $pay->mount].' '.$pay->year }}
            </strong>
        </h4>
        <p>Seleccione los datos incorrectos</p>
        <form>
            <div class="list-group">
                <label class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" wire:model="corrections.subscribers_number">
                    <strong>Número de suscriptores (Cuota):</strong> {{ $pay->pay }}
                </label>
                <label class="list-group-item">
                    <input class="form-check-input me-1" type="checkbox" wire:model="corrections.ticket_number">
                    <strong>Número formulario SAT:</strong> {{ $pay->ticket_number }}
                </label>
                <label>
                    <input class="form-check-input me-1" type="checkbox" wire:model="corrections.ticket_file">
                    <strong><a href="storage/{{ $pay->ticket_file }}" target="_blank" title="Ver en otra pestaña">Formulario SAT:</a></strong> <br>
                    <iframe src="storage/{{ $pay->ticket_file }}"></iframe>
                </label>
            </div>
            @if(in_array(true, $corrections))
                <x-inputs.textarea
                    name="observations"
                    wire:model="observations"
                    label="Observaciones adicionales"
                ></x-inputs.textarea>
            @endif
        </form>
    </div>
   <div class="card-footer text-end">
       <button class="btn btn-secondary" wire:click="$emit('closeModal')">Cerrar <i class="fa-solid fa-xmark"></i></button>
       @if(in_array(true, $corrections))
           <button class="btn btn-danger" wire:click="rejected">Enviar correcciones <i class="fa-regular fa-paper-plane"></i></button>
       @else
           <button class="btn btn-success" wire:click="submit">Aceptar <i class="fa-regular fa-paper-plane"></i></button>
       @endif
   </div>
</div>

