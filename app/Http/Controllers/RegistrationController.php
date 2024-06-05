<?php

namespace App\Http\Controllers;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\IntegrityConstraintViolationException;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function index() {
        $registrations = Registration::paginate(15) ;
        return view('registration.index', compact('registrations'));
    }

    public function store(Request $request, $event) {
        $user_id = Auth::id();
        $event_id= $event;
    
        // Verificar se já existe uma inscrição para o usuário e evento
        if (Registration::where('user_id', $user_id)->where('event_id', $event_id)->exists()) {
            return redirect()->back()->with('error', 'Você já está inscrito neste evento.');
        }
    
        try {
            // Tentar criar uma nova inscrição
            Registration::create([
                'user_id' => $user_id,
                'event_id' => $event_id,
                'registration_date' => now(),
                'status' => 'pending', // Defina o status como pendente por padrão
            ]);
    
            return redirect()->route('registrations.index')->with('success', 'Inscrição feita com sucesso!');
        } catch (IntegrityConstraintViolationException $e) {
            // Em caso de erro, redirecionar de volta com uma mensagem de erro
            return redirect()->back()->with('error', 'Ocorreu um erro ao processar sua inscrição. Por favor, tente novamente.');
        }
    }

    public function update (Request $request, $id) {
        $registration = Registration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();


        return redirect()->route('registrations.index')->with('success', 'Inscrição feita com sucesso!');
    }

    public function destroy(Registration $registration) {

        $registration->delete();

        return redirect()->route('registrations.index');
    }
}
