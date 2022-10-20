<?php

namespace App\Http\Controllers;

use App\Events\message;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class NotificationController extends Controller
{
    public function index()
    {
        $notification = Notification::first();
        return view('aPanal/_Layout' ,['notification' => $notification]);
        // event(new message($notification));
        // return view('testNotification', ['notification' => $notification->number]);
    }
}
