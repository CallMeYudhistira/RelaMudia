<x-layout>
    <x-slot:title>Detail Transaksi #RENT-{{ $payment->id }} | RelaMudia</x-slot:title>

    <div class="bg-slate-50 min-h-screen pt-8 pb-20">
        <div class="max-w-6xl mx-auto px-6">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div class="flex items-center gap-4">
                    <a href="{{ route('payment.index') }}"
                        class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-600 hover:bg-slate-50 transition-all">
                        <i class="bx bx-arrow-back text-xl"></i>
                    </a>
                    <div>
                        <h1 class="text-2xl font-extrabold text-slate-900">Detail Transaksi</h1>
                        <p class="text-sm text-slate-500">ID Pesanan: <span
                                class="font-mono font-bold text-teal-600">#RENT-{{ $payment->id }}</span></p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button onclick="window.print()"
                        class="px-5 py-2.5 bg-white border border-slate-200 rounded-xl text-sm font-bold text-slate-600 flex items-center gap-2 hover:bg-slate-50 transition-all">
                        <i class="bx bx-printer"></i> Cetak Invoice
                    </button>
                    @if ($payment->status == 'pending')
                        <button onclick="pay('{{ $payment->snap_token }}')"
                            class="px-5 py-2.5 bg-teal-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-teal-500/20 hover:bg-teal-700 transition-all">
                            Bayar Sekarang
                        </button>
                    @endif
                </div>
            </div>

            <script type="text/javascript">
                function pay(snapToken) {
                    window.snap.pay(snapToken, {
                        onSuccess: function(result) {
                            console.log(result);
                            window.location.reload();
                        },
                        onPending: function(result) {
                            console.log(result);
                            window.location.reload();
                        },
                        onError: function(result) {
                            console.log(result);
                            window.location.reload();
                        },
                        onClose: function() {
                            alert('You closed the popup without finishing the payment');
                        }
                    })
                }
            </script>

            <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm mb-8">
                <h3 class="font-bold text-slate-800 mb-8 flex items-center gap-2">
                    <i class="bx bx-time-five text-teal-600 text-xl"></i> Timeline Penyewaan
                </h3>

                @php
                    $status = $payment->rental->status;
                    $isPaid = in_array($status, ['paid', 'ongoing', 'completed']);
                    $isOngoing = in_array($status, ['ongoing', 'completed']);
                    $isCompleted = $status === 'completed';

                    $progressWidth = '0%';
                    if ($status === 'ongoing') {
                        $progressWidth = '50%';
                    } elseif ($status === 'completed') {
                        $progressWidth = '100%';
                    }
                @endphp

                <div class="relative">
                    <div class="absolute top-5 left-[16.6%] right-[16.6%] h-0.5 bg-slate-100 hidden md:block">
                        <div class="absolute top-0 left-0 h-full bg-teal-500 transition-all duration-500"
                            style="width: {{ $progressWidth }}"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                        <div class="flex flex-row md:flex-col items-start md:items-center gap-4 md:text-center group">
                            <div
                                class="w-10 h-10 rounded-full {{ $isPaid ? 'bg-teal-500' : 'bg-slate-200' }} border-4 border-white shadow-md z-10 flex-shrink-0 transition-colors duration-300">
                            </div>
                            <div>
                                <p
                                    class="text-xs font-black {{ $isPaid ? 'text-slate-800' : 'text-slate-400' }} uppercase tracking-wider mb-1">
                                    Pengambilan</p>
                                <p class="text-sm text-slate-500">
                                    {{ \Carbon\Carbon::parse($payment->rental->start_date)->translatedFormat('d M Y') }}</p>
                                <p
                                    class="text-[10px] {{ $isPaid ? 'text-teal-600' : 'text-slate-400' }} font-bold uppercase mt-1">
                                    Gudang RelaMudia</p>
                            </div>
                        </div>

                        <div class="flex flex-row md:flex-col items-start md:items-center gap-4 md:text-center group">
                            <div
                                class="w-10 h-10 rounded-full {{ $isOngoing ? 'bg-teal-500' : 'bg-slate-200' }} border-4 border-white shadow-md z-10 flex-shrink-0 transition-colors duration-300">
                            </div>
                            <div>
                                <p
                                    class="text-xs font-black {{ $isOngoing ? 'text-slate-800' : 'text-slate-400' }} uppercase tracking-wider mb-1">
                                    Masa Sewa</p>
                                @php
                                    $start = \Carbon\Carbon::parse($payment->rental->start_date);
                                    $end = \Carbon\Carbon::parse($payment->rental->end_date);
                                    $total_days = $start->diffInDays($end) + 1;
                                @endphp
                                <p class="text-sm text-slate-500 font-bold">{{ $total_days }} Hari Penuh</p>
                                <p
                                    class="text-[10px] {{ $isOngoing ? 'text-teal-600' : 'text-slate-400' }} font-bold uppercase mt-1">
                                    Durasi Pemakaian</p>
                            </div>
                        </div>

                        <div class="flex flex-row md:flex-col items-start md:items-center gap-4 md:text-center group">
                            <div
                                class="w-10 h-10 rounded-full {{ $isCompleted ? 'bg-teal-500' : 'bg-slate-200' }} border-4 border-white shadow-md z-10 flex-shrink-0 transition-colors duration-300">
                            </div>
                            <div>
                                <p
                                    class="text-xs font-black {{ $isCompleted ? 'text-slate-800' : 'text-slate-400' }} uppercase tracking-wider mb-1">
                                    Pengembalian</p>
                                <p class="text-sm text-slate-500">
                                    {{ \Carbon\Carbon::parse($payment->rental->end_date)->translatedFormat('d M Y') }}</p>
                                <p
                                    class="text-[10px] {{ $isCompleted ? 'text-teal-600' : 'text-slate-400' }} font-bold uppercase mt-1">
                                    Maks. Pukul 21:00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
                <div class="lg:col-span-2 space-y-8">
                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-8 py-6 border-b border-slate-50">
                            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                                <i class="bx bx-box text-teal-600 text-xl"></i> Daftar Produk
                            </h3>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead class="bg-slate-50/50">
                                    <tr class="text-[10px] uppercase tracking-widest text-slate-400 font-bold">
                                        <th class="px-8 py-4">Item</th>
                                        <th class="px-4 py-4 text-center">Qty</th>
                                        <th class="px-8 py-4 text-right">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach ($payment->rental->details as $item)
                                        <tr>
                                            <td class="px-8 py-5">
                                                <div class="flex items-center gap-4">
                                                    <img src="{{ $item->multimediaItem->image }}"
                                                        class="w-12 h-12 rounded-xl object-contain bg-slate-50 border border-slate-100">
                                                    <div>
                                                        <p class="font-bold text-slate-800 text-sm">{{ $item->multimediaItem->name }}</p>
                                                        <p class="text-[11px] text-slate-400 italic">Rp {{ number_format($item->price_per_day, 0, ',', '.') }} / hari</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-5 text-center font-bold text-slate-700 text-sm">{{ $item->quantity }}x</td>
                                            <td class="px-8 py-5 text-right font-bold text-slate-900 text-sm">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                            <h3 class="font-bold text-slate-800 mb-6 flex items-center gap-2 text-sm uppercase tracking-tight">
                                <i class="bx bx-user text-teal-600 text-xl"></i> Data Penyewa
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <p class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">Nama Lengkap</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $payment->rental->user->name }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] uppercase text-slate-400 font-bold tracking-wider">Email Terdaftar</p>
                                    <p class="text-sm font-bold text-slate-700">{{ $payment->rental->user->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                            <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                                <i class="bx bx-radio-circle-marked text-teal-600 text-xl"></i> Status Penyewaan
                            </h3>
                            <p class="text-sm text-slate-600 leading-relaxed mb-4">
                                @php
                                    $status = $payment->rental->status;
                                    if ($status === 'pending') {
                                        $status = 'Menunggu Pembayaran';
                                    } elseif ($status === 'ongoing') {
                                        $status = 'Sedang Disewa';
                                    } elseif ($status === 'paid') {
                                        $status = 'Telah Dibayar';
                                    } elseif ($status === 'completed') {
                                        $status = 'Selesai Dikembalikan';
                                    } elseif ($status === 'cancelled') {
                                        $status = 'Dibatalkan';
                                    } else {
                                        $status = 'Gagal';
                                    }
                                @endphp
                                {{ $status }}
                            </p>
                            <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2 text-sm uppercase tracking-tight">
                                <i class="bx bx-note text-teal-600 text-xl"></i> Catatan Khusus
                            </h3>
                            <div class="p-4 bg-amber-50/50 rounded-2xl mb-4 border border-amber-100/50">
                                <p class="text-xs text-amber-800 leading-relaxed italic">
                                    "{{ $payment->rental->note ?? 'Tidak ada catatan khusus.' }}"
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:sticky lg:top-8 space-y-8">
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                        <h3 class="font-bold mb-6 flex items-center gap-2 text-slate-800">
                            <div class="w-8 h-8 rounded-lg bg-teal-50 flex items-center justify-center">
                                <i class="bx bx-receipt text-teal-600"></i>
                            </div>
                            Ringkasan Pesanan
                        </h3>

                        <div class="space-y-4">
                            <div class="flex justify-between text-sm text-slate-500">
                                <span>Durasi Sewa</span>
                                @php
                                    $start = \Carbon\Carbon::parse($payment->rental->start_date);
                                    $end = \Carbon\Carbon::parse($payment->rental->end_date);
                                    $total_days = $start->diffInDays($end) + 1;
                                @endphp
                                <span class="font-bold text-slate-800">{{ $total_days }} Hari</span>
                            </div>

                            <div class="flex justify-between text-sm text-slate-500">
                                <span>Subtotal Produk</span>
                                <span class="font-bold text-slate-800 text-right">
                                    Rp {{ number_format($payment->rental->details->sum('subtotal'), 0, ',', '.') }}
                                </span>
                            </div>

                            <div class="border-t border-dashed border-slate-200 pt-4 flex justify-between text-sm text-slate-500">
                                <span>Metode Pembayaran</span>
                                <span class="font-bold text-slate-800 text-right">
                                    @php
                                        $method = $payment->payment_method;

                                        if ($method === 'bank_transfer') {
                                            $method = 'Transfer Bank';
                                        } elseif ($method === 'credit_card') {
                                            $method = 'Kartu Kredit';
                                        } elseif ($method === 'gopay') {
                                            $method = 'GoPay';
                                        } elseif ($method === 'shopeepay') {
                                            $method = 'ShopeePay';
                                        } elseif ($method === 'qris') {
                                            $method = 'QRIS';
                                        } elseif ($method === 'cstore') {
                                            $method = 'Convenience Store (Indomaret/Alfamart)';
                                        } elseif ($method === 'akulaku') {
                                            $method = 'Akulaku PayLater';
                                        } elseif ($method === 'kredivo') {
                                            $method = 'Kredivo';
                                        } elseif ($method === 'dana') {
                                            $method = 'DANA';
                                        } elseif ($method === 'linkaja') {
                                            $method = 'LinkAja';
                                        } elseif ($method === 'bca_klikbca') {
                                            $method = 'KlikBCA';
                                        } elseif ($method === 'bca_klikpay') {
                                            $method = 'BCA KlikPay';
                                        } elseif ($method === 'mandiri_clickpay') {
                                            $method = 'Mandiri ClickPay';
                                        } elseif ($method === 'cimb_clicks') {
                                            $method = 'CIMB Clicks';
                                        } elseif ($method === 'danamon_online') {
                                            $method = 'Danamon Online Banking';
                                        } elseif ($method === 'bri_epay') {
                                            $method = 'BRI e-Pay';
                                        } elseif ($method === 'uob_ezpay') {
                                            $method = 'UOB EZPay';
                                        } else {
                                            $method = ucfirst(str_replace('_', ' ', $method));
                                        }
                                    @endphp

                                    {{ $method }}
                                </span>
                            </div>

                            <div class="border-t border-dashed border-slate-200 pt-4 flex justify-between items-end">
                                <span class="text-sm font-bold text-slate-800">Total Bayar</span>
                                <span class="text-2xl font-black text-teal-600 leading-none">
                                    Rp {{ number_format($payment->rental->total_price, 0, ',', '.') }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-slate-50">
                            <div class="flex items-center gap-4 p-4 bg-slate-50 rounded-2xl">
                                <div
                                    class="w-10 h-10 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400">
                                    <i class="bx bx-credit-card-alt text-xl"></i>
                                </div>
                                <div>
                                    <p
                                        class="text-[10px] text-slate-400 uppercase font-bold tracking-widest leading-none mb-[5px]">
                                        Status Pembayaran
                                    </p>
                                    <div class="flex items-center gap-1.5">
                                        <div
                                            class="w-2 h-2 rounded-full {{ $payment->status == 'success' ? 'bg-emerald-500' : 'bg-amber-500' }}">
                                        </div>
                                        <p
                                            class="text-xs font-bold uppercase {{ $payment->status == 'success' ? 'text-emerald-600' : 'text-amber-600' }}">
                                            @php
                                                $statusPayment = $payment->status;
                                                if ($statusPayment === 'pending') {
                                                    $statusPayment = 'Menunggu Pembayaran';
                                                } elseif ($statusPayment === 'success') {
                                                    $statusPayment = 'Berhasil';
                                                } elseif ($statusPayment === 'failed') {
                                                    $statusPayment = 'Gagal / Dibatalkan';
                                                } else {
                                                    $statusPayment = 'Gagal';
                                                }
                                            @endphp
                                            {{ $statusPayment }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="flex items-center justify-center gap-2 p-4 bg-white border border-slate-200 rounded-2xl text-xs font-bold text-slate-500 hover:bg-slate-50 transition-all">
                        <i class="bx bxl-whatsapp text-lg text-emerald-500"></i> Hubungi Admin WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
