<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index() {    
        $events = Event::with('organizer')->paginate(15);
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
}
