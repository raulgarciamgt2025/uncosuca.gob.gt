<?php

namespace App\Http\Livewire\Channels;

use App\Models\ChannelCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class EditModalCategories extends ModalComponent
{
    public ?ChannelCategory $channelCategory;
    public $category_name, $active;

    public function mount($id): void
    {
        $this->channelCategory = ChannelCategory::find($id);
        $this->category_name = $this->channelCategory->name;
        $this->active =  $this->channelCategory->active;
    }

    public function submit(): void
    {
        $this->validate([
            'category_name' => ['required', 'string', 'regex:/^[^.]+\S$/', 'max:191'],
            'active' => ['required', 'boolean']
        ]);
        $this->channelCategory->update([
            'name' => $this->category_name,
            'active' => $this->active
        ]);
        $this->closeModal();
        $this->emit('refreshCategoriesTable');
        $this->emit('showAlert', ['type' => 'success', 'message' => 'Registro editado correctamente']);
    }

    public function render(): View
    {
        return view('livewire.channels.edit-modal-categories');
    }
}
