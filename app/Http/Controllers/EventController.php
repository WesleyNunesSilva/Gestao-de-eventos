<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index() {
        $events = Event::paginate(20);
        return view('layouts.app', compact('events'));
    }
}
