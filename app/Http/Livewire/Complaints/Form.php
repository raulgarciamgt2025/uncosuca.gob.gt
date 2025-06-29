<?php

namespace App\Http\Livewire\Complaints;

use App\Mail\UserNotify;
use App\Models\Complaint;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class Form extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $complains;
    public $description, $type, $business_name, $show_modal, $complain_user, $complain, $content, $phone, $alert;

    public function mount()
    {
        $this->type = 1;
    }
    public function save()
    {
        $this->validate([
            'description' => ['required', 'string'],
            'business_name' => ['required', 'string'],
            'phone' => ['required', 'numeric', 'digits:8'],
            'type' => ['required', 'integer'],
        ]);
        $content = json_encode([
            'business_name' => $this->business_name,
            'description' => $this->description,
        ]);
        Complaint::create([
            'content' => $content,
            'user_id' => auth()->id(),
            'type' => $this->type,
            'status' => 1,
        ]);
        $auth_user = auth()->user();
        $type = match ($this->type) {
            1 => 'queja',
            2 => 'denuncia',
            default => 'sugerencia',
        };
        $data = [
            'subject' =>  'Quejas, denuncias y sugerencias',
            'title' => 'Se generado un nuevo registro',
            'subtitle' => 'El usuario '.$auth_user->name.' '.$auth_user->surname. ' ha creado una '.$type.'.',
            'list' => [
                'Empresa: '.$this->business_name
            ],
            'description' => 'Descripción: "'. $this->description .'"',
        ];
        $mail_list = explode(', ', trim(env('MAILS_FOR_COMPLAINTS'), "[]"));
        Mail::to($mail_list)->send(new UserNotify($data));
        $this->description = null;
        $this->business_name = null;
        $this->phone = null;
    }

    public function showModal(Complaint $complain): void
    {
        $this->complain = $complain;
        $this->content = json_decode($complain->content, true);
        $this->show_modal = true;
        if (auth()->user()->type == 3) {
            $complain->status = 2;
            $complain->save();
        }
    }
    public function render()
    {
        $user = auth()->user();
        $where = match ($user->type) {
            1 => 'user_id = '.$user->id,
            2 => false,
            default => true
        };
        $complains = Complaint::whereRaw($where)->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.complaints.form', compact('complains'));
    }
}
