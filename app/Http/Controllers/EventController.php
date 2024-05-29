<?php

namespace App\Http\Controllers;
use App\Models\Event;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        $events = Event::paginate(15);
        
        return view('event.index', compact('events'));
    }

    public function create() {

        return view('event.create');
    }

    public function destroy(Event $event) {
        $event->delete();

        return redirect()->route('events.index');
    }
}
