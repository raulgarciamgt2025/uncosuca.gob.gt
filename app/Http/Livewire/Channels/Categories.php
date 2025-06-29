<?php

namespace App\Http\Livewire\Channels;

use App\Models\ChannelCategory;
use Livewire\Component;

class Categories extends Component
{
    public $name, $active = false, $modal_create = false;


    public function showModalCreate()
    {
        $this->modal_create = true;
    }
    public function create()
    {
        $validate = $this->validate([
            'name' => ['required', 'string', 'regex:/^[^.]+\S$/', 'max:191'],
            'active' => ['required', 'boolean']
        ]);
        ChannelCategory::create($validate);
        $this->name = null;
        $this->modal_create = false;
        $this->emit('refreshCategoriesTable');
        $this->emit('showAlert', ['type' => 'success', 'message' => 'Categoría creada correctamente']);
    }
    public function render()
    {
        return view('livewire.channels.categories');
    }
}
