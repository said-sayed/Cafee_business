<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventFeature;
use Illuminate\Http\Request;

class EventFeatureController extends Controller
{
    private $featureModel;
    public function __construct(EventFeature $feature, Event $event)
    {
        $this->featureModel = $feature;
        $this->eventeModel = $event;
    }
    public function index()
    {
        $all_feature = $this->featureModel->all();
        $all_events = $this->eventeModel->all();
        return view('/aPanal/Event/viewFeature', [
            'features' => $all_feature,
            'events' => $all_events
        ]);
    }
    public function create($eventId)
    {
        // dd($eventId);
        return view('/aPanal/Event/addFeature', ['eventId' => $eventId]);
    }
    public function store(Request $request)
    {
        $all_events = $this->eventeModel->all();
        $data = $request->validate([
            'ourFeatures' => "string|required",
            'event_id' => "integer|required"
        ]);
        // dd("said");
        // dd($data['event_id']);
        $this->featureModel->create($data);
        session()->flash('Add_success', 'Add Feature Of Event  Done');

        return redirect()->back()->with('event_id', $data['event_id']);
    }
    public function edit($eventId)
    {
        $features = $this->featureModel->select('id' ,'ourFeatures', 'event_id')->where('event_id', '=', $eventId)->get();
        return view('/aPanal/Event/viewFeature', [
            'eventId' => $eventId,
            'features' => $features,

        ]);
    }
    public function update(Request $request, $featureId)
    {
        $data = $request->validate([
            'ourFeatures' => "string|required",
            'event_id' => "integer|required"
        ]);
        // dd($data);
        $events = $this->eventeModel->all();
        $this->featureModel->find($featureId)->update($data);
        session()->flash('Update_success', 'Update Feature Of Event Done');

        return redirect()->back();
    }
    public function delete($featureId)
    {
        $this->featureModel->find($featureId)->delete();
        return redirect()->back();
    }
}
