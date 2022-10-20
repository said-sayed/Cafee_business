<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    //

    private $evntModel;
    public function __construct(Event $event)
    {
        $this->evntModel = $event;
    }
    public function index()
    {
        $all_event = $this->evntModel->all();
        return view('/aPanal/Event/viewEvent', ['events' => $all_event]);
    }
    public function create()
    {
        $all_event = $this->evntModel->all();
        return view('/aPanal/Event/addEvent', ['events' => $all_event]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'event_name' => "string|required",
            'event_price' => "string|required",
            'event_image' => "image|required",
            'event_desc_top' => "string|required",
            'event_desc_bottom' => "string|required",
        ]);
        if ($request->hasFile('event_image')) {
            $path = "Images/Event/";
            $image_name = "_Event" . time() . "." . $request->event_image->extension();

            $request->event_image->move(public_path($path), $image_name);
            $data['event_image'] = $image_name;
        }

        $this->evntModel->create($data);
        session()->flash('Add_success', 'Add Event Done');

        return redirect()->back();
    }

    public function edit($eventId)
    {
        $event = $this->evntModel->find($eventId);
        return view('/aPanal/Event/editEvent', ['event' => $event]);
    }
    public function update(Request $request, $eventId)
    {
        $updateEvent = $this->evntModel->find($eventId);
        if ($updateEvent) {

            $data = $request->validate([
                'event_name' => "string|required",
                'event_price' => "string|required",
                'event_image' => "image|nullable",
                'event_desc_top' => "string|required",
                'event_desc_bottom' => "string|required",
            ]);

            $path = "Images/Event/";
            $olde_image = public_path($path) . $updateEvent->event_image;
            if ($request->hasFile('event_image')) {
                // dd("Said");
                $image_name = "_Event" . time() . "." . $request->event_image->extension();
                $request->event_image->move(public_path($path), $image_name);
                $data['event_image'] = $image_name;
                $this->evntModel->find($eventId)->update($data);
                if (File::exists($olde_image)) {
                    unlink($olde_image);
                }
            } else {
                $this->evntModel->find($eventId)->update($data);
            }
            session()->flash('Update_success', 'Update Event Done');
        }
        return redirect()->back();
    }
    public function delete($eventId)
    {
        $this->evntModel->find($eventId)->delete();
        return redirect()->back();
    }
}
