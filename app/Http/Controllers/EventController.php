<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index() {
        {
            $events = Event::with('organizer')->paginate(15);
            return view('event.index', compact('events'));
        }
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

    public function edit( Event $event) {

        if (Auth::user()->type !== 'admin' && Auth::id() !== $event->organizer_id) {
            return redirect()->route('events.index')->with('error', 'Você não pode editar este evento');
            abort(403, 'Acesso negado.');
        }
        return view('event.edit', compact('event'));
    }

    public function update(Request $request, Event $event) {
        if (Auth::user()->type !== 'admin' && Auth::id() !== $event->organizer_id) {
            abort(403, 'Acesso negado.');
        }

        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Evento atualizado com sucesso!');
    }

    public function destroy(Event $event) {
        $event->delete();

        return redirect()->route('events.index');
    }
}
