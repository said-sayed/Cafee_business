<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Notification;
use App\Rules\DateBetween;
use App\Rules\TimeBetween;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BookingController extends Controller
{
    function booking(Request $request)
    {
        $data = $request->validate([
            'name' => ['string', 'required', 'min:3', 'max:20'],
            'email' => ['email', 'required', 'min:10', 'max:30'],
            'phone' => ['string', 'required', 'min:11', 'max:11'],
            'ofPeople' => ['integer', 'required', 'max:6'],
            'startDateTime' => ['required', 'date', new DateBetween, new TimeBetween],
            'table_id' => ['integer', 'required', 'exists:tables,id'],
            'message' => ['string', 'max:1000', 'nullable'],
        ]);

        $checkBooking = $this->checkBooking($data['table_id'], $data['startDateTime']);

        if (count($checkBooking) != 0) {
            return redirect()->back()->with(['error' => 'This Table is Not Avilable']);
        }

        $data['endDateTime'] = Carbon::parse($request->startDateTime)->addHour(1);
        $data['new'] = "new";
        Booking::create($data);
        $notification = Notification::find(1);
        if ($notification) {
            $number_notification = $notification->number;
            $notification->update([
                'number' => ++$number_notification
            ]);
        }
        return redirect()->back()->with(['massege' => 'Sucsess']);
    }

    function checkBooking($table_id, $startDateTime)
    {
        $checkBooking = Booking::where('table_id', $table_id)
            ->where('startDateTime', '<=', $startDateTime)
            ->where('endDateTime', '>=', $startDateTime)->get();
        return $checkBooking;
    }

    public function index()
    {
        $bookings = Booking::get();
        return view('aPanal/Booking/viewBookings', compact('bookings'));
    }
    public function show($id)
    {
        $booking = Booking::find($id);
        if (!$booking)
            return redirect('aPanal/dashboard');
        if ($booking->new == "new")
            $booking->update([
                'new' => "not new"
            ]);
        $notification = Notification::find(1);
        if ($notification) {
            $number_notification = $notification->number;

            $notification->update([
                'number' => --$number_notification
            ]);
        }
        return view('aPanal/Booking/viewBooking', compact('booking'));
    }
    public function delete($id)
    {
        $booking = Booking::find($id);
        if (!$booking)
            return redirect('aPanal/dashboard');
        $booking->delete();
        return back();
    }
}
