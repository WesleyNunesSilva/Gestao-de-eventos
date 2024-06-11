<?php
namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Event;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $payments = Payment::paginate(15);
        
        if ($user->type === 'admin') {
            $payments = Payment::paginate(15);
        } elseif ($user->type === 'organizer') {
            $eventIds = Event::where('organizer_id', $user->id)->pluck('id');
            $registrationIds = Registration::whereIn('event_id', $eventIds)->pluck('id');
            $payments = Payment::whereIn('registration_id', $registrationIds)->paginate(15);
        } 

        return view('payment.index', compact('payments'));
    }

    public function create($registrationId)
    {
        $registration = Registration::findOrFail($registrationId);
        $event = Event::findOrFail($registration->event_id);

        return view('payment.create', compact('registration', 'event'));
    }

    public function store(Request $request, $registrationId)
    {
        $user = Auth::user();
        $registration = Registration::findOrFail($registrationId);

        if ($user->id !== $registration->user_id) {
            return redirect()->back()->with('error', 'Você não tem permissão para fazer este pagamento.');
        }

        $event = Event::findOrFail($registration->event_id);
        $value = $event->price;

        Payment::create([
            'value' => $value,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'payment_date' => now(),
            'registration_id' => $registrationId,
        ]);

        return redirect()->route('payments.index')->with('success', 'Pagamento realizado com sucesso!');
    }

    public function updateStatus($id, Request $request)
    {
        $payment = Payment::findOrFail($id);
        $payment->status = $request->status;
        $payment->save();

        return redirect()->route('payments.index')->with('success', 'Status do pagamento atualizado com sucesso!');
    }
}