<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Request $request) {   
        $query = Event::with('organizer');
    
        if($request->has('title') && $request->input('title') != '') {
            $query->where('title', 'LIKE', "%{$request->input('title')}%")
                  ->orWhere('description', 'LIKE', "%{$request->input('title')}%")
                  ->orWhere('location', 'LIKE', "%{$request->input('title')}%");
        }
    
        $events = $query->paginate(15);
    
        return view('event.index', compact('events'));      
    }

    public function create() {
        return view('event.create');
    }

    public function store(Request $request) {

        $organizer_id = Auth::id();

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'organizer_id' => $organizer_id,
            'capacity' => $request->capacity,
            'price' => $request->price,
        ]);
        return redirect()->route('events.index')->with('success', 'Evento criado com sucesso!');
    }

    public function edit(Event $event) {
        $this->authorize('update', $event);
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, Event $event) {
        $this->authorize('update', $event);

        $event->update($request->all());
        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(Event $event) {
        $this->authorize('delete', $event);
    
        $event->delete();
    
        return redirect()->route('events.index')->with('success', 'Evento excluído com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('event.show', compact('event'));
    }

    public function showEventPayments($eventId) {
        $event = Event::findOrFail($eventId);
        $payments = Payment::whereHas('registration', function ($query) use ($eventId) {
            $query->where('event_id', $eventId);
        })->paginate(15);

        return view('event.payments', compact('event', 'payments'));
    }
}
