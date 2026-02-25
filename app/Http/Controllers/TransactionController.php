<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Rental;
use App\Models\RentalDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Snap;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->status;
        $start = $request->start_date;
        $end = $request->end_date;

        $query = Rental::query();

        if($status){
            $query = $query->where('status', 'LIKE', "%{$status}%");
        }
        if($start && $end){
            $query = $query->whereBetween('created_at', [$start, $end]);
        }

        $transactions = $query->with('user')->get();
        return view('pages.transactions.index', compact('transactions', 'status', 'start', 'end'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'note' => 'nullable|string',
        ]);
        DB::beginTransaction();

        try {
            $start = Carbon::parse($request->start_date);
            $end = Carbon::parse($request->end_date);
            $total_days = $start->diffInDays($end) + 1;

            $total_product = $user->carts->sum('subtotal');
            $grand_total = $total_days * $total_product;

            $orderId = 'RENT-' . Str::uuid();

            $rental = Rental::create([
                'user_id' => $user->id,
                'start_date' => $start,
                'end_date' => $end,
                'total_price' => $grand_total,
                'status' => 'pending',
                'note' => $request->note ?? null,
            ]);

            $item_details = [];

            foreach ($user->carts as $cart) {

                RentalDetail::create([
                    'rental_id' => $rental->id,
                    'multimedia_item_id' => $cart->multimedia_item_id,
                    'price_per_day' => $cart->price_per_day,
                    'quantity' => $cart->quantity,
                    'subtotal' => $cart->subtotal,
                ]);

                $item_details[] = [
                    'id' => $cart->multimedia_item_id,
                    'price' => $cart->price_per_day * $total_days,
                    'quantity' => $cart->quantity,
                    'name' => $cart->multimediaItem->name,
                ];
            }

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $grand_total,
                ],
                'item_details' => $item_details,
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
                'enabled_payments' => [
                    'credit_card',
                    'bca_va',
                    'bni_va',
                    'bri_va',
                    'permata_va',
                    'other_va',
                    'gopay',
                    'shopeepay',
                    'qris',
                    'indomaret',
                    'alfamart',
                    'danamon_online',
                    'akulaku'
                ],
            ];

            $transaction = Snap::createTransaction($params);

            Payment::create([
                'rental_id' => $rental->id,
                'payment_method' => null,
                'payment_reference' => $orderId,
                'payment_url' => $transaction->redirect_url,
                'snap_token' => $transaction->token,
                'status' => 'pending',
            ]);

            DB::commit();
            return redirect()->route('payment.index')->with('success', 'Silahkan segera melakukan pembayaran.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal memproses pembayaran.');
        }
    }

    public function update(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);

        if (in_array($rental->status, ['completed', 'cancelled'])) {
            return redirect()->back()->with('error', 'Transaksi yang sudah selesai atau dibatalkan tidak dapat diubah lagi.');
        }

        $request->validate([
            'status' => 'required|in:paid,ongoing,completed,cancelled',
            'note' => $request->status === 'cancelled' ? 'required|string' : 'nullable|string',
        ], [
            'note.required' => 'Catatan wajib diisi jika status dibatalkan.'
        ]);

        $rental->update([
            'status' => $request->status,
            'note' => $request->note,
        ]);

        return redirect()->back()->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function callback(Request $request)
    {
        DB::beginTransaction();

        try {

            \Log::info('MIDTRANS CALLBACK:', $request->all());

            $orderId = $request->order_id;
            $status = $request->transaction_status;
            $paymentType = $request->payment_type;
            $grossAmount = $request->gross_amount;
            $statusCode = $request->status_code;
            $signatureKey = $request->signature_key;

            $serverKey = config('midtrans.server_key');

            $validSignature = hash(
                'sha512',
                $orderId . $statusCode . $grossAmount . $serverKey
            );

            if ($signatureKey !== $validSignature) {
                return response()->json(['message' => 'Invalid signature'], 403);
            }

            $payment = Payment::where('payment_reference', $orderId)->first();

            if (!$payment) {
                return response()->json(['message' => 'Payment not found'], 404);
            }

            if (in_array($status, ['capture', 'settlement'])) {

                $payment->update([
                    'status' => 'success',
                    'payment_method' => $paymentType
                ]);

                $payment->rental->update([
                    'status' => 'paid'
                ]);

                // Hapus item keranjang yang sesuai dengan item yang disewa
                $itemIds = $payment->rental->details->pluck('multimedia_item_id');
                $payment->rental->user->carts()->whereIn('multimedia_item_id', $itemIds)->delete();
                
                \Log::info("Payment success for Order ID: $orderId");
            }

            if ($status == 'pending') {
                $payment->update([
                    'payment_method' => $paymentType
                ]);
                \Log::info("Payment pending for Order ID: $orderId");
            }

            if (in_array($status, ['expire', 'cancel', 'deny'])) {

                $payment->update(['status' => 'failed']);

                $payment->rental->update([
                    'status' => 'cancelled'
                ]);
                \Log::info("Payment failed/cancelled for Order ID: $orderId, Status: $status");
            }

            DB::commit();

            return response()->json(['message' => 'OK'], 200);

        } catch (\Exception $e) {

            DB::rollBack();
            \Log::error('MIDTRANS ERROR: ' . $e->getMessage());

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
