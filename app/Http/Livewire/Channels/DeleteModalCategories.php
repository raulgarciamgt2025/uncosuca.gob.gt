<?php

namespace App\Http\Livewire\Channels;

use App\Models\ChannelCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteModalCategories extends ModalComponent
{
    public ?ChannelCategory $channelCategory;

    public function mount($id): void
    {
        $this->channelCategory = ChannelCategory::find($id);
    }

    public function submit(): void
    {
        $this->channelCategory->delete();
        $this->closeModal();
        $this->emit('refreshCategoriesTable');
        $this->emit('showAlert', ['type' => 'success', 'message' => 'Registro eliminado correctamente']);
    }

    public function render(): View
    {
        return view('livewire.channels.delete-modal-categories');
    }
}
