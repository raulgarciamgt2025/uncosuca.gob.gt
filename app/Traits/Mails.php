<?php
namespace App\Traits;
use App\Http\Workflows\WorkflowManager;
use App\Mail\UserNotify;
use App\Models\Department;
use Illuminate\Support\Facades\Mail;

trait Mails
{
    public function rejectedMail($workflowRequest, $observations): void
    {
        $title = 'El proceso ha sido anulado';
        $data = [
            'subject' =>  $workflowRequest->workflow->name,
            'title' => $title,
            'subtitle' => 'Tu trámite fue rechazado por el siguiente motivo:',
            'description' => $observations,
            'key' => $workflowRequest->key
        ];
        Mail::to($workflowRequest->user->email)->send(new UserNotify($data));
        $workflowRequest->state = 3;
        $workflowRequest->end_date = date('Y-m-d H:i:s');
        $workflowRequest->save();
        $last_stage = $workflowRequest->getLastStage();
        $history = $last_stage->history;
        $history[] = [
            'title' => $title,
            'list' => [],
            'description' => $observations,
            'date' => date('Y-m-d H:i:s')
        ];
        $last_stage->history = $history;
        $last_stage->save();
        $workflowManager = new WorkflowManager($workflowRequest);
        $observations = json_encode([
            'observations' => $observations
        ]);
        $workflowManager->acceptCurrentStage($observations);
    }

    public function departmentsAlert(array $data): void
    {
        $auxiliaries = Department::find(1)->users()->pluck('email')->toArray();
        $manager = Department::find(1)->user()->pluck('email')->toArray();
        Mail::to(array_merge($auxiliaries, $manager))->send(new UserNotify($data));
    }
}
