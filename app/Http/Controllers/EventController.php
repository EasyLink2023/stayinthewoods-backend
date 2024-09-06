<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $data['events'] = Event::orderBy('id', 'desc')->get();
        return view('event', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'event_name' => 'required'
        ]);
        if ($request->has('event_image')) {
            $image = $request->file('event_image');
            $eventImageFileName = time() . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/event-images'), $eventImageFileName);
        }
        $date = Carbon::parse($request->date)->format('Y-m-d');
        $time = Carbon::parse($request->time)->format('h:i A');
        $new_event = new Event;
        $new_event->event_name = $request->event_name;
        $new_event->event_address = $request->event_address;
        $new_event->date = $date ?? null;
        $new_event->time = $time ?? null;
        $new_event->cover_image = $eventImageFileName ?? null;
        $new_event->note = $request->note ?? null;
        $new_event->save();
        return redirect()->back()->with('success', 'Event added Successfully');
    }

    public function delete($id)
    {
        $eventId = $id;
        $event = Event::find($eventId);

        if (!$event) {
            return redirect()->back()->with('error-delete', 'No Event Found');
        }
        $imagePath = public_path('uploads/event-images/') . $event->cover_image;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        $event->delete();
        return redirect()->back()->with('success-delete', 'Event deleted Successfully');
    }

    public function updateStatus($id) {
        $eventId = $id;
        $event = Event::find($eventId);

        if (!$event) {
            return redirect()->back()->with('error-delete', 'No Event Found');
        }

        $event->status = $event->status == '0' ? '1' : '0';
        $event->save();
        return redirect()->back()->with('success-delete', 'Event updated Successfully');
    }
}
