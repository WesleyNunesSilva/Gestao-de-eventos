<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationConfirmedMail;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->type === 'admin') {
            $payments = Payment::with('registration.event')->paginate(15);
        } elseif ($user->type === 'organizer') {
            $eventIds = Event::where('organizer_id', $user->id)->pluck('id');
            $registrationIds = Registration::whereIn('event_id', $eventIds)->pluck('id');
            $payments = Payment::whereIn('registration_id', $registrationIds)
                                ->with('registration.event')
                                ->paginate(15);
        } else {
            $payments = Payment::whereHas('registration', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('registration.event')->paginate(15);
        }

        return view('payment.index', compact('payments'));
    }

    public function create($registrationId)
    {
        $registration = Registration::findOrFail($registrationId);
        $event = Event::findOrFail($registration->event_id);

        return view('payment.create', compact('registration', 'event'));
    }

    public function store(Request $request, $registrationId) {
        $user = Auth::user();
        $registration = Registration::findOrFail($registrationId);
    
        if ($registration->hasPayment()) {
            return redirect()->back()->with('error', 'Pagamento já realizado para esta inscrição.');
        }
    
        if ($user->id !== $registration->user_id) {
            return redirect()->back()->with('error', 'Você não tem permissão para fazer este pagamento.');
        }
    
        $event = Event::findOrFail($registration->event_id);
        $value = $event->price;
    
        // Cria o pagamento
        $payment = Payment::create([
            'value' => $value,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_date' => now(),
            'registration_id' => $registrationId,
        ]);
    
        // Atualiza o status do pagamento e da inscrição se o pagamento for bem-sucedido
        if ($payment) {
            $payment->status = 'completed';
            $payment->save();
    
            $registration->status = 'confirmed';
            $registration->save();
    
            Mail::to($registration->user->email)->send(new RegistrationConfirmedMail($registration));
        }
        
        return redirect()->route('payments.index')->with('success', 'Pagamento realizado com sucesso!');
    }

    public function showEventPayments(Event $event) {
        $payments = Payment::where('event_id', $event->id)->get();
    
        return view('events.payments', compact('event', 'payments'));
    }

    public function financialReport() {
        $user = Auth::user();
        if ($user->type === 'organizer' || $user->type === 'admin') {
            $eventIds = Event::where('organizer_id', $user->id)->pluck('id');
            $payments = Payment::whereIn('registration_id', function($query) use ($eventIds) {
                $query->select('id')
                    ->from('registrations')
                    ->whereIn('event_id', $eventIds);
            })->where('status', 'completed')->get();
    
            $totalReceived = $payments->sum('value');
            $totalPending = Payment::whereIn('registration_id', function($query) use ($eventIds) {
                $query->select('id')
                    ->from('registrations')
                    ->whereIn('event_id', $eventIds);
            })->where('status', 'pending')->sum('value');
    
            return view('payment.financial', compact('payments', 'totalReceived', 'totalPending'));
        }
    
        return redirect()->back()->with('error', 'Você não tem permissão para acessar esta página.');
    }

}