<?php

namespace App\Http\Livewire\Channels;

use App\Models\Channel;
use App\Models\ChannelCategory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class EditModalChannels extends ModalComponent
{
    public ?Channel $channel;
    public $channel_name, $category_id, $active;

    public function mount($id): void
    {
        $this->channel = Channel::find($id);
        $this->channel_name = $this->channel->name;
        $this->active = $this->channel->active;
        $this->category_id = $this->channel->channel_category_id;
    }

    public function submit(): void
    {
        $this->validate([
            'channel_name' => ['required', 'string', 'regex:/^[^.]+\S$/',],
            'active' => ['required', 'boolean'],
            'category_id' => ['required', 'exists:channel_categories,id'],
        ]);
        $this->channel->update([
            'name' => $this->channel_name,
            'active' => $this->active,
            'channel_category_id' => $this->category_id
        ]);
        $this->closeModal();
        $this->emit('refreshChannelsTable');
        $this->emit('showAlert', ['type' => 'success', 'message' => 'Registro editado correctamente']);
    }

    public function render(): View
    {
        $categories = ChannelCategory::all();
        return view('livewire.channels.edit-modal-channels', compact('categories'));
    }
}
