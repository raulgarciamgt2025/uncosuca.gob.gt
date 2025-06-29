<?php

namespace App\Http\Livewire\Pays\Users;

use App\Models\Pay;
use App\Traits\Mails;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class PayModal extends ModalComponent
{
    use WithFileUploads;
    use Mails;

    public Pay $pay;
    public $subscribers_number, $ticket_number, $months, $ticket_file, $corrections = [];

    public function mount(): void
    {
        if ($this->pay->status == 3) {
            $rejections = $this->pay->rejections;
            $this->corrections = end($rejections)['corrections'];
            $this->subscribers_number = $this->pay->pay;
            $this->ticket_number = $this->pay->ticket_number;
        }
        $this->months =  [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];
    }
    public function submit(): void
    {
        $this->validate([
            'subscribers_number' => ['required', 'integer'],
            'ticket_number' => ['required', 'string'],
            'ticket_file' =>  key_exists('ticket_file', $this->corrections) ?  ['required', 'file', 'mimes:pdf'] : ['nullable', 'file', 'mimes:pdf'],
        ]);
        $this->pay->pay = $this->subscribers_number;
        $this->pay->ticket_number = $this->ticket_number;
        if ($this->ticket_file) {
            $this->pay->ticket_file = Storage::put('documents', $this->ticket_file);
        }
        $this->pay->status = 1;
        $this->pay->save();
        if ($this->pay->rejections) {
            $subject = 'Corrección de pago';
        } else {
            $subject = 'Nuevo pago registrado';
        }
        $data = [
            'subject' =>  $subject,
            'title' => $this->pay->company->mercantile_name.', '.$this->months[$this->pay->mount < 10 ?
                ltrim($this->pay->mount, '0') :
                $this->pay->mount].' '.$this->pay->year,
            'subtitle' => 'Ingresa al módulo de pagos en el portal de trámites para darle seguimiento.',
            'description' => '',
        ];
        $this->departmentsAlert($data);
        $this->closeModal();
        $this->emit('showAlert', [
            'type' => 'success',
            'message' => 'Se han cargado tus datos de pago'
        ]);
        $this->emit('refreshTable');
    }
    public function render(): View
    {
        return view('livewire.pays.users.pay-modal');
    }
}
