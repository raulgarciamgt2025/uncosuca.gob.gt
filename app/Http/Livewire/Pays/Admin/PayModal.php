<?php

namespace App\Http\Livewire\Pays\Admin;

use App\Mail\UserNotify;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use LivewireUI\Modal\ModalComponent;

class PayModal extends ModalComponent
{
    use WithFileUploads;

    public Pay $pay;
    public $corrections = [], $months = [], $observations;

    public function mount(): void
    {
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

    public function rejected(): void
    {
        $emails = User::whereIn('id', $this->pay->company->assignedUsers()->pluck('user_id')->toArray())
            ->pluck('email')->toArray();
        $data = [
            'subject' => 'Revisión de pago',
            'title' => $this->pay->company->mercantile_name.', '.$this->months[$this->pay->mount < 10 ?
                    ltrim($this->pay->mount, '0') :
                    $this->pay->mount].' '.$this->pay->year,
            'subtitle' => 'Se ha revisado el pago y existen datos incorrectos. Ingresa al portal de trámites para realizar las correcciones.',
            'description' => 'Observaciones de UNCOSU: '.$this->observations
        ];
        Mail::to($emails)->send(new UserNotify($data));
        $this->pay->status = 3;
        $history = $this->pay->rejections;
        $history[] = [
            'user_id' => auth()->user()->id,
            'date' => date('Y-m-d H:i:s'),
            'corrections' => $this->corrections,
            'observations' => $this->observations
        ];
        $this->pay->rejections = $history;
        $this->pay->save();
        $this->closeModal();
        $this->emit('showAlert', [
            'type' => 'success',
            'message' => 'Se han enviado las correcciones al usuario'
        ]);
        $this->emit('refreshTable');
    }

    public function submit(): void
    {
        $this->pay->status = 2;
        $this->pay->save();
        $this->closeModal();
        $this->emit('showAlert', [
            'type' => 'success',
            'message' => 'Pago aceptado correctamente'
        ]);
        $this->emit('refreshTable');
    }
    public function render(): View
    {
        return view('livewire.pays.admin.pay-modal');
    }
}
