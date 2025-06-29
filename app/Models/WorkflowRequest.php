<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class WorkflowRequest extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'key',
        'start_date',
        'end_date',
        'state',
        'resolution_number',
        'company_id',
        'ranking',
        'process_type',
        'request_user_id',
        'workflow_id',
    ];


    protected $searchableFields = ['*'];

    protected $table = 'workflow_requests';

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'ranking' => 'json',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->key = (string)Str::uuid();
            $model->request_user_id = auth()->user()->id;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'request_user_id');
    }

    public function company(): HasOne
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function stateStages()
    {
        return $this->hasMany(StateStage::class)->orderBy('stage');
    }

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function getLastStage()
    {
        return collect($this->stateStages)
            ->where('state', 0)
            ->sortKeys()
            ->first();
    }

    public function getPreviousStage()
    {
        return collect($this->stateStages)
            ->where('state', 1)
            ->sortKeysDesc()
            ->first();
    }

    public function hasPermission(): bool
    {
        $user = auth()->user();
        $stage = $this->getLastStage();
        if ($stage  && in_array($this->state, [0,1])) {
            $department_id = $stage->department_id;
            if ($department_id) {
                $manager = $stage->manager;
                if ($manager == 1) {
                    $result = $user->id == $stage->department->manager_id;
                } else {
                    $result = in_array($department_id, $user->departments()->pluck('id')->toArray());
                }
            } else {
                $result = $this->request_user_id == $user->id;
            }
        } else {
            $result = false;
        }
        return $result;
    }

    public function getRejectedMotive()
    {
        $previous_stage = json_decode($this->getPreviousStage()->json ??
            $this->getLastStage()->json ?? '{}', true);
        return $previous_stage['observations'] ?? null;
    }
}
