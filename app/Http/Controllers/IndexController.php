<?php

namespace App\Http\Controllers;

use App\Models\EventModel;
use App\Models\EventType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /**
     * Display the index page with events and event types.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $events = EventModel::all();
        $eventTypes = EventType::all();

        return view('index', compact('events', 'eventTypes'));
    }

    /**
     * Store a new event.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'event_type' => 'required',
            'date_start' => 'required',
            'date_end' => 'required',
        ]);

        $event = EventModel::create($request->all());

        if ($event) {
            return redirect()->back()->with('success', 'Event created successfully');
        }

        return redirect()->back()->with('error', 'Error creating event');
    }

    /**
     * Get all events in JSON format.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEvents()
    {
        $events = EventModel::all();

        $formattedEvents = [];
        foreach ($events as $event) {
            $formattedEvents[] = [
                'title' => $event->title,
                'event_type' => $event->event_type,
                'date_start' => $event->date_start,
                'date_end' => $event->date_end,
            ];
        }

        return response()->json($formattedEvents);
    }


    /**
     * Update the specified event in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOrDelete($id)
    {
        if (request()->isMethod('PUT')) {
            // Realizar la actualización del evento
            $event = EventModel::findOrFail($id);
            $event->title = request('title');
            $event->event_type = request('event_type');
            $event->date_start = request('date_start');
            $event->date_end = request('date_end');
            $event->save();
    
            return redirect()->back()->with('success', 'Event updated successfully');
        } elseif (request()->isMethod('DELETE')) {
            // Realizar la eliminación del evento
            $event = EventModel::findOrFail($id);
            $event->delete();
    
            return redirect()->back()->with('success', 'Event deleted successfully');
        }
    
        return redirect()->back()->with('error', 'Invalid request');
    }
    

    
}