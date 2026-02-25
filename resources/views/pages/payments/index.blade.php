<x-layout>
    <x-slot:title>Riwayat Transaksi | RelaMudia</x-slot:title>

    <div class="bg-white min-h-screen pt-8 pb-20">
        <div class="max-w-5xl mx-auto px-6">

            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-6">
                <a href="/" class="hover:text-teal-600 transition-colors">Home</a>
                <i class="bx bx-chevron-right"></i>
                <span class="text-slate-800 font-medium">Riwayat Transaksi</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Transaksi Saya</h1>
                    <p class="text-slate-500">Pantau status penyewaan dan unduh invoice Anda.</p>
                </div>

                <div class="flex gap-2">
                    @php
                        $active = "bg-teal-600 text-white text-xs font-bold shadow-lg shadow-teal-500/20";
                        $unactive = "bg-white border border-slate-200 text-slate-600 text-xs font-bold hover:bg-slate-50 transition-all";
                    @endphp
                    <a class="px-4 py-2 rounded-xl {{ $status ? $unactive : $active }}" href="{{ route('payment.index', 'status=') }}">Semua</a>
                    <a class="px-4 py-2 rounded-xl {{ 'pending' == $status ? $active : $unactive }}" href="{{ route('payment.index', 'status=' . 'pending') }}"">Menunggu</a>
                    <a class="px-4 py-2 rounded-xl {{ 'success' == $status ? $active : $unactive }}" href="{{ route('payment.index', 'status=' . 'success') }}"">Selesai</a>
                    <a class="px-4 py-2 rounded-xl {{ 'failed' == $status ? $active : $unactive }}" href="{{ route('payment.index', 'status=' . 'failed') }}"">Gagal</a>
                </div>
            </div>

            <div class="space-y-4">
                @forelse ($payments as $transaction)
                    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-md transition-all group">
                        <div class="flex flex-col lg:flex-row lg:items-center gap-6">

                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-3 mb-4">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-400 px-3 py-1 bg-slate-50 rounded-full border border-slate-100">
                                        #RENT-{{ $transaction->id }}
                                    </span>

                                    @if($transaction->status == 'pending')
                                        <span class="text-[10px] font-bold uppercase px-3 py-1 bg-amber-50 text-amber-600 rounded-full border border-amber-100">Menunggu Pembayaran</span>
                                    @elseif($transaction->status == 'success')
                                        <span class="text-[10px] font-bold uppercase px-3 py-1 bg-emerald-50 text-emerald-600 rounded-full border border-emerald-100">Berhasil</span>
                                    @else
                                        <span class="text-[10px] font-bold uppercase px-3 py-1 bg-rose-50 text-rose-600 rounded-full border border-rose-100">Gagal / Dibatalkan</span>
                                    @endif

                                    <span class="text-xs text-slate-400 ml-auto lg:ml-0">
                                        <i class="bx bx-calendar-alt"></i> {{ $transaction->created_at->format('d M Y, H:i') }}
                                    </span>
                                </div>

                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 rounded-2xl bg-slate-50 flex items-center justify-center text-teal-600 border border-slate-100">
                                        <i class="bx bx-package text-2xl"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-slate-800 leading-tight">
                                            {{ $transaction->rental->details->first()->multimediaItem->name }}
                                            @if($transaction->rental->details->count() > 1)
                                                <span class="text-teal-600 text-xs font-medium">+{{ $transaction->rental->details->count() - 1 }} produk lainnya</span>
                                            @endif
                                        </h4>
                                        <p class="text-sm text-slate-500 mt-[5px]">Total Bayar: <span class="font-medium">Rp {{ number_format($transaction->rental->total_price, 0, ',', '.') }}</span></p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-3 pt-4 lg:pt-0 border-t lg:border-none border-slate-50">
                                <a href="{{ route('payment.detail', $transaction->id) }}"
                                   class="flex-1 lg:flex-none text-center px-6 py-3 bg-slate-900 text-white rounded-2xl text-xs font-bold uppercase tracking-widest hover:bg-teal-600 transition-all shadow-lg shadow-slate-200">
                                    Lihat Detail
                                </a>

                                @if($transaction->status == 'pending')
                                    <button onclick="pay('{{ $transaction->snap_token }}')"
                                            class="flex-1 lg:flex-none text-center px-6 py-3 bg-teal-50 text-teal-600 border border-teal-100 rounded-2xl text-xs font-bold uppercase tracking-widest hover:bg-teal-600 hover:text-white transition-all">
                                        Bayar
                                    </button>
                                @endif
                            </div>

                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white rounded-3xl border border-dashed border-slate-200">
                        <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="bx bx-receipt text-4xl"></i>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800">Belum ada transaksi</h3>
                        <p class="text-slate-400 text-sm mb-8">Sepertinya Anda belum pernah melakukan penyewaan barang.</p>
                        <a href="/items" class="px-8 py-3 bg-teal-600 text-white rounded-xl text-sm font-bold shadow-lg shadow-teal-500/20">Mulai Sewa Sekarang</a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>

    <script type="text/javascript">
        function pay(snapToken) {
            window.snap.pay(snapToken, {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    window.location.reload();
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    window.location.reload();
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    console.log(result);
                    window.location.reload();
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('You closed the popup without finishing the payment');
                }
            })
        }
    </script>
</x-layout>
