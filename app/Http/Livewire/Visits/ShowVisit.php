<?php

namespace App\Http\Livewire\Visits;

use App\Mail\UserNotify;
use App\Models\Visit;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ShowVisit extends Component
{
    public Visit $visit;
    public $pdf, $modal_rejected = false, $observations;

    public function mount(Visit $visit)
    {
        $this->visit = $visit;
        $this->pdf = $this->generatePdf();
    }

    public function generatePdf()
    {
        $visit = $this->visit;
        $response_visit = $visit->response;
        if ($response_visit) {
            $pdf = Pdf::loadView('documents.visits.pdf-visit', compact('visit', 'response_visit'))
                ->setPaper('A4');
            $pdf_url = 'storage/documents/visit_'.$this->visit->id.'.pdf';
            $pdf->save($pdf_url);
            return $pdf_url;
        }
    }

    public function shoModal()
    {
        $this->modal_rejected = true;
    }

    public function rejected()
    {
        $this->validate([
            'observations' => ['required', 'string']
        ]);
        $this->visit->status = 3;
        $this->visit->reject_motive = $this->observations;
        $this->visit->save();
        $data = [
            'subject' =>  'Rechazo de visita',
            'title' => 'Se ha rechazado la supervisión No. '.$this->visit->id,
            'subtitle' => '',
            'description' => $this->observations,
        ];
        Mail::to($this->visit->user->email)->send(new UserNotify($data));
        $this->redirect(route('visits'));
    }

    public function submit()
    {
        $this->visit->status = 2;
        $this->visit->acceptance_date = date('Y-m-d H:i:s');
        $this->visit->save();
        $this->redirect(route('visits'));
    }

    public function render()
    {
        return view('livewire.visits.show-visit');
    }
}
