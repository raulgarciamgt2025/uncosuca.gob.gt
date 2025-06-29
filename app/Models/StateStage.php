<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StateStage extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'workflow_request_id',
        'state',
        'stage',
        'type',
        'json',
        'description',
        'department_id',
        'user_id',
        'history',
        'manager',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'history' => 'json'
    ];

    protected $table = 'state_stages';

    public function workflowRequest()
    {
        return $this->belongsTo(WorkflowRequest::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }
}
