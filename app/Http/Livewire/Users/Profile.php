<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;
    public User $user;
    public $email, $name, $surname, $password, $cui, $nit, $signature_user, $signature_password, $signature_image;
    public function mount(): void
    {
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->surname = $this->user->surname;
        $this->email = $this->user->email;
        $this->cui = $this->user->cui;
        $this->nit = $this->user->nit;
        $this->signature_user = $this->user->signature_user;
        $this->signature_password = $this->user->signature_password;
    }

    public function submit(): void
    {
        $required_image = $this->user->signature_image ? 'nullable' : 'required_with:signature_user,signature_password';
        $validate = $this->validate([
            'name' => ['required', 'string'],
            'surname' => ['required', 'string'],
            'email' => ['required', 'string', Rule::unique('users', 'email')->ignore($this->user)],
            'cui' => ['required', 'string'],
            'nit' => ['required', 'string', 'max:15'],
            'signature_user' => ['nullable', 'required_with:signature_password,signature_image', 'string'],
            'signature_password' => ['nullable', 'required_with:signature_user,signature_image', 'string'],
            'signature_image' => ['nullable', $required_image, 'image', 'mimes:png,jpg', 'dimensions:width=200, height=200'],
        ]);
        if (!$this->signature_image && !$validate['signature_image']) {
            unset($validate['signature_image']);
        }
        if ($this->password) {
            $validate['password'] = Hash::make($this->password);
        }
        if ($this->signature_image) {
            Storage::delete($this->user->signature_image ?? '');
            $validate['signature_image'] = Storage::put('images', $this->signature_image);
        }
        $this->user->update($validate);
        session()->flash('success', 'Datos actualizados');
        $this->redirect('/');
    }
    public function render()
    {
        return view('livewire.users.profile');
    }
}
