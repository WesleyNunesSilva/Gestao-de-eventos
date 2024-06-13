<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Event;
use App\Models\Registration;
use App\Models\Payment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $totalUsers = User::count();
        $totalEvents = Event::count();
        $totalRegistrations = Registration::count();
        $totalPayments = Payment::count();

        return view('home', compact('totalUsers', 'totalEvents', 'totalRegistrations', 'totalPayments'));
    }
}
