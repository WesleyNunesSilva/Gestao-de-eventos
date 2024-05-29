<?php

namespace App\Http\Controllers;
use App\Models\User;


use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(15);

        return view('user.index', compact('users'));
    }

  

    public function update(Request $request, User $user) {
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'type' => $request->input('type'),
 
        ]);
    
        return redirect()->route('users.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function create() {

        return view('user.create');
    }

    public function store(Request $request) {
        User::create(array_merge($request->all(), ['password' => bcrypt($request->input('password'))]));

        return redirect()->route('users.index');
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('users.index');
    }
}