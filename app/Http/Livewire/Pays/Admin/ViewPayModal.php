<?php

namespace App\Http\Livewire\Pays\Admin;

use App\Models\Pay;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class ViewPayModal extends ModalComponent
{
    public $pay;
    public $months = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    ];

    public function mount($pay): void
    {
        $this->pay = Pay::with('company')->findOrFail($pay);
    }

    public function render(): View
    {
        return view('livewire.pays.admin.view-pay-modal');
    }
}
