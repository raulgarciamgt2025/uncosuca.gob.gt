<?php

namespace App\Http\Livewire\Visits;

use App\Http\Livewire\Components\VisitIndex;
use App\Models\Channel;
use App\Models\ChannelCategory;
use App\Models\Company;
use App\Models\Visit;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class MakeVisit extends VisitIndex
{
    use WithFileUploads;

    public Visit $visit;
    public Company $company;
    public $channels, $distributionsNetwork, $signalPickup, $companyChannels, $channelCategories, $visitData = [], $images;

    public function mount(Visit $visit): void
    {
        $this->visitData = [
            'channels' => [
                'varios' => false,
                'varios2' => false,
            ],
            'network' => [
                'distribution' => null,
                'catchment' => null,
            ],
            'internetService' => null,
            'signal_quality' => null,
            'number_channels' => 0,
            'person_who_attended' => null,
            'observations' => null,
            'images' => []
        ];
        $this->channels = $this->getChannels();
        $this->distributionsNetwork = $this->getDistributionsNetwork();
        $this->signalPickup = $this->getSignalPickup();
        $this->visit = $visit;
        $this->company = $this->visit->company;
        $this->channelCategories = ChannelCategory::where('active', 1)->get(['id', 'name']);
        foreach($this->channelCategories as $category) {
            foreach($category->channels as $item) {
                $this->visitData['companyChannels'][$category->name][$item->name] = null;
            }
        }
        foreach ($this->channels ?? [] as $channel) {
            $this->visitData['channelsRepresentation'][$channel]['active'] = false;
            $this->visitData['channelsRepresentation'][$channel]['note'] = null;
        }
        if ($visit->status == 3) {
            $this->visitData = $this->visit->response;
            $this->images = $this->visitData['images'];
            $this->visitData['images'] = [];
        }
    }

    public function submit(): void
    {
        $this->visitData['date'] = date('Y-m-d H:i:s');
        if ($this->visit->status == 3 && count($this->visitData['images']) == 0) {
            $this->visitData['images'] = $this->images;
        } else {
            foreach ($this->visitData['images'] as $key => $image) {
                $this->visitData['images'][$key] = Storage::put('images', $image);
            }
        }
        $this->visit->filling_date = date('Y-m-d H:i:s');
        $this->visit->response = $this->visitData;
        $this->visit->status = 1;
        $this->visit->save();
        $this->company->latitude = $this->visitData['latitude'];
        $this->company->longitude = $this->visitData['longitude'];
        $this->company->save();
        $this->redirect(route('my-visits'));
    }
    public function render(): View
    {
        return view('livewire.visits.make-visit');
    }
}
