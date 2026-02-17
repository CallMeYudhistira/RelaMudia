<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $query = Payment::query();

        if($status){
            $query = $query->where('status', 'LIKE', "%{$status}%");
        }

        $payments = $query->with('rental')->get();

        return view('pages.payments.index', compact('payments', 'status'));
    }

    public function detail($id)
    {
        $payment = Payment::with('rental')->find($id);

        return view('pages.payments.detail', compact('payment'));
    }
}
