<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles;
    use Notifiable;
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'cui',
        'nit',
        'type',
        'password',
        'signature_user',
        'signature_password',
        'signature_image',
        'active',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password', 'remember_token', 'signature_user', 'signature_password'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
    ];

    public function manager_department()
    {
        return $this->hasMany(Department::class, 'manager_id');
    }

    public function workflowRequests()
    {
        return $this->hasMany(WorkflowRequest::class, 'request_user_id');
    }

    public function assignedCompanies()
    {
        return $this->hasMany(UserCompany::class, 'user_id', 'id');
    }

    public function stateStages()
    {
        return $this->hasMany(StateStage::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function isSuperAdmin(): bool
    {
        return $this->hasRole('super-admin');
    }
}
