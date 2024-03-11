<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(15);

        return view('layouts.app', compact('users'));
    }
}
