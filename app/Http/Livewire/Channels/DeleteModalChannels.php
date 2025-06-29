<?php

namespace App\Http\Livewire\Channels;

use App\Models\Channel;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteModalChannels extends ModalComponent
{
    public ?Channel $channel;

    public function mount($id): void
    {
        $this->channel = Channel::find($id);
    }

    public function submit(): void
    {
        $this->channel->delete();
        $this->closeModal();
        $this->emit('refreshChannelsTable');
        $this->emit('showAlert', ['type' => 'success', 'message' => 'Registro eliminado correctamente']);
    }

    public function render(): View
    {
        return view('livewire.channels.delete-modal-channels');
    }
}
