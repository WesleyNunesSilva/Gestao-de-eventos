<?php

namespace App\Http\Controllers;
use App\Models\Registration;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function index() {
        $registrations = Registration::paginate(15) ;
        return view('registration.index', compact('registrations'));
    }
}
