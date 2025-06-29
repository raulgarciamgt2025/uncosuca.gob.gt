<?php

namespace App\Http\Livewire\Visits;

use App\Models\Province;
use App\Models\Visit;
use App\Traits\StringDates;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    use StringDates;

    public $departments, $department, $start_date, $end_date, $report, $modalReport = false, $requirements;

    public function mount(): void
    {
        $this->departments = Province::get(['id', 'name']);
    }

    public function showModalReport(): void
    {
        $this->modalReport = true;
    }

    public function generateReport(): void
    {
        $this->validate([
            'department' => ['required', 'integer', 'exists:provinces,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'requirements' => ['required', 'string', 'max:191']
        ]);
        $visits = Visit::whereBetween('filling_date',
            [$this->start_date.' 00:00:00', $this->end_date.' 23:59:59'])
            ->whereHas('company.municipality', function ($municipality) {
                $municipality->where('province_id', $this->department);
            })
            ->orderBy('filling_date')
            ->get();
        $department = Province::find($this->department);
        $start_date = Carbon::parse($this->start_date);
        $end_date = Carbon::parse($this->end_date);
        $uuid = uuid_create();
        $pdf = Pdf::loadView('documents.visits.report-department', [
            'visits' => $visits,
            'department' => $department,
            'start_date' => $this->stringDate($start_date->day, $start_date->month, $start_date->year),
            'end_date' => $this->stringDate($end_date->day, $end_date->month, $end_date->year),
            'requirements' => $this->requirements
            ])
            ->setPaper('A4');
        if (!Storage::exists('temp')) {
            Storage::makeDirectory('temp');
        }
        $pdf_url = "storage/temp/report-$uuid.pdf";
        $pdf->save($pdf_url);
        $this->report = $pdf_url;
    }

    public function downloadReport()
    {
        Storage::download($this->report);
    }

    public function render(): View
    {
        return view('livewire.visits.index');
    }
}
