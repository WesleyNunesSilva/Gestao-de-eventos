<?php

namespace App\Http\Controllers;
use App\Models\Registration;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Database\IntegrityConstraintViolationException;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{

    public function index() {
        $user = Auth::user();

        if ($user->type === 'admin') {
            $registrations = Registration::paginate(10);
        } elseif ($user->type === 'organizer') {
            $eventIds = Event::where('organizer_id', $user->id)->pluck('id');
            $registrations = Registration::whereIn('event_id', $eventIds)->paginate(10);
        } else {
            $registrations = Registration::where('user_id', $user->id)->paginate(10);
        }
        return view('registration.index', compact('registrations'));
    }

    public function store(Request $request, $event) {
        $user_id = Auth::id();
        $event_id= $event;
    
        $existingRegistration = Registration::where('user_id', $user_id)->where('event_id', $event_id)->exists();
        
        if ($existingRegistration  ) {
            return redirect()->back()->with('error', 'Você já está inscrito neste evento.');
        }
    
        try {
            Registration::create([
                'user_id' => $user_id,
                'event_id' => $event_id,
                'registration_date' => now(),
                'status' => 'pending',
            ]);
    
            return redirect()->route('registrations.index')->with('success', 'Inscrição feita com sucesso!');
        } catch (IntegrityConstraintViolationException $e) {

            return redirect()->back()->with('error', 'Ocorreu um erro ao processar sua inscrição. Por favor, tente novamente.');
        }
    }

    public function update (Request $request, $id) {
        $registration = Registration::findOrFail($id);
        $registration->status = $request->status;
        $registration->save();

        $message = ($registration->status == 'canceled') ? 'Inscrição cancelada com sucesso!' : 'Inscrição atualizada com sucesso!';
        return redirect()->route('registrations.index')->with('success', $message);
    }

    public function destroy(Registration $registration) {
        $registration->delete();

        return redirect()->route('registrations.index')->with('success', 'Inscrição excluída com sucesso!');
    }
}
