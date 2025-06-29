<?php

namespace App\Http\Livewire\Channels;

use App\Models\Channel;
use App\Models\ChannelCategory;
use Livewire\Component;

class Channels extends Component
{
    public $name, $category, $modal_create = false, $active = false;


    public function showModalCreate()
    {
        $this->modal_create = true;
    }
    public function create()
    {
        $this->validate([
            'name' => ['required', 'string', 'regex:/^[^.]+\S$/',],
            'active' => ['required', 'boolean'],
            'category' => ['required', 'exists:channel_categories,id']
        ]);
        Channel::create([
            'name' => $this->name,
            'active' => $this->active,
            'channel_category_id' => $this->category,
        ]);
        $this->name = null;
        $this->category = null;
        $this->modal_create = false;
        $this->emit('refreshChannelsTable');
        $this->emit('showAlert', ['type' => 'success', 'message' => 'Canal creado correctamente']);
    }
    public function render()
    {
        $categories = ChannelCategory::all();
        return view('livewire.channels.channels', compact('categories'));
    }
}
