<?php

namespace App\Http\Livewire\Consults;

use App\Models\Workflow;
use App\Models\WorkflowRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Dashboard extends Component
{
    use AuthorizesRequests;
    public $total, $success, $process, $cancel, $proceses, $requested, $failed, $general_ranking;
    public function mount()
    {
        $this->authorize('Dashboard');
        $process_collect = collect(WorkflowRequest::all());
        $this->general_ranking = round($process_collect->where('ranking', '!=', null)->avg('ranking.stars'),1);
        $this->total = $process_collect->where('state','>',  0)->count();
        $this->success = $process_collect->where('state', 2)->count();
        $this->requested = $process_collect->where('state', 0)->count();
        $this->process = $process_collect->where('state', 1)->count();
        $this->cancel = $process_collect->where('state', 4)->count();
        $this->failed = $process_collect->where('state', 3)->count();
        $this->proceses = Workflow::get();
    }
    public function render()
    {
        return view('livewire.consults.dashboard');
    }
}
