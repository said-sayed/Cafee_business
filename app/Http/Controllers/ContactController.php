<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Notification;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //

    private $contactModel;
    public function __construct(Contact $contact)
    {
        $this->contactModel = $contact;
    }
    public function index()
    {
        $all_messages = $this->contactModel->all();
        return view('aPanal/Contact/viewAllMessage', ['messages' => $all_messages]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'email' => 'string|email|required',
            'subject' => 'string|required',
            'message' => 'string|required',
        ]);
        $data['is_reading'] = "not_reading";
        // return "said";
        $this->contactModel->create($data);
       
        return redirect()->back();
    }
    public function show($messageId)
    {
        $message = $this->contactModel->find($messageId);
        if ($message->is_reading == 'not_reading') {
            $message->update([
                'is_reading' => 'reading'
            ]);
           
        }

        return view('aPanal/Contact/viewMessage', ['message' => $message]);
    }
    public function delete($messageId)
    {
        $this->contactModel->find($messageId)->delete();
        return back();
    }
}
