<?php

namespace App\Http\Livewire\Pays\Admin;

use App\Models\Pay;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use LivewireUI\Modal\ModalComponent;

class EditChargesModal extends ModalComponent
{
    use LivewireAlert;
    
    public $payId;
    public $penalty = 0;
    public $variable = 0;
    public $usuarios = 0;
    public $pay;

    public function mount($payId): void
    {
        $this->payId = $payId;
        $this->pay = Pay::with('company')->findOrFail($payId);
        $this->penalty = (float)($this->pay->penalty ?? 0);
        $this->variable = (float)($this->pay->variable ?? 0);
        $this->usuarios = (int)($this->pay->usuarios ?? 0);
    }

    protected $rules = [
        'penalty' => 'nullable|numeric|min:0',
        'variable' => 'nullable|numeric|min:0',
        'usuarios' => 'required|integer|min:0',
    ];

    protected $messages = [
        'penalty.numeric' => 'La multa debe ser un número válido.',
        'penalty.min' => 'La multa no puede ser negativa.',
        'variable.numeric' => 'El recargo debe ser un número válido.',
        'variable.min' => 'El recargo no puede ser negativo.',
        'usuarios.required' => 'El número de usuarios es obligatorio.',
        'usuarios.integer' => 'El número de usuarios debe ser un número entero.',
        'usuarios.min' => 'El número de usuarios no puede ser negativo.',
    ];

    public function save(): void
    {
        $this->validate();

        try {
            $this->pay->update([
                'penalty' => (float)($this->penalty ?: 0),
                'variable' => (float)($this->variable ?: 0),
                'pay' => (int)($this->usuarios ?: 0),
            ]);

            $this->alert('success', 'Cargos actualizados exitosamente');
            
            // Emit event to refresh the admin table
            $this->emit('refreshTable');
            
            $this->closeModal();
            
            // Force a page refresh as backup
            $this->dispatchBrowserEvent('refresh-page', ['delay' => 1500]);
            
        } catch (\Exception $e) {
            $this->alert('error', 'Error al actualizar los cargos');
        }
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render(): View
    {
        return view('livewire.pays.admin.edit-charges-modal');
    }
}
