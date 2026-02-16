<x-layout>
    <x-slot:title>Keranjang Belanja | RelaMudia</x-slot:title>

    <div class="bg-slate-50 min-h-screen pt-8 pb-20">
        <div class="max-w-7xl mx-auto px-6">

            <nav class="flex items-center gap-2 text-sm text-slate-400 mb-8">
                <a href="/" class="hover:text-teal-600">Home</a>
                <i class="bx bx-chevron-right"></i>
                <span class="text-slate-800 font-medium">Keranjang Belanja</span>
            </nav>

            <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Keranjang Belanja</h1>
            <p class="text-slate-500 mb-10">Anda memiliki <span class="text-teal-600 font-bold">3 produk</span> di dalam keranjang.</p>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    <div class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm relative group">
                        <i class="bx bx-search absolute left-8 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <input type="text" placeholder="Cari di keranjang belanja..."
                               class="w-full pl-12 pr-4 py-3 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-teal-500/20 outline-none text-sm transition-all">
                    </div>

                    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-slate-50/50 border-b border-slate-50">
                                    <tr class="text-left text-[11px] uppercase tracking-widest text-slate-400 font-bold">
                                        <th class="px-8 py-5">Produk</th>
                                        <th class="px-4 py-5 text-center">Harga/Hari</th>
                                        <th class="px-4 py-5 text-center">Jumlah</th>
                                        <th class="px-4 py-5 text-center">Subtotal</th>
                                        <th class="px-8 py-5"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    <tr class="group hover:bg-slate-50/30 transition-colors">
                                        <td class="px-8 py-6">
                                            <div class="flex items-center gap-4">
                                                <div class="w-20 h-20 rounded-2xl bg-slate-100 overflow-hidden border border-slate-100 p-2">
                                                    <img src="{{ asset('image/items/09-02-2026_9EPzjKYQQ0zyyuUGf9Fwqx20XA23LkK36Z06xiRP.jpg') }}" class="w-full h-full object-contain">
                                                </div>
                                                <div>
                                                    <h4 class="font-bold text-slate-800">Sony Alpha a7 IV</h4>
                                                    <p class="text-xs text-slate-400">Kamera Mirrorless</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-6 text-center font-bold text-slate-700">Rp500.000</td>
                                        <td class="px-4 py-6">
                                            <div class="flex items-center justify-center gap-3">
                                                <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:border-teal-500 hover:text-teal-600 transition-all">-</button>
                                                <span class="font-bold text-slate-800 text-sm">1</span>
                                                <button class="w-8 h-8 rounded-lg bg-teal-500 flex items-center justify-center text-white hover:bg-teal-600 transition-all shadow-lg shadow-teal-500/20">+</button>
                                            </div>
                                        </td>
                                        <td class="px-4 py-6 text-center font-bold text-teal-600">Rp500.000</td>
                                        <td class="px-8 py-6 text-right">
                                            <button class="p-2 text-slate-300 hover:text-red-500 transition-colors">
                                                <i class="bx bx-trash text-xl"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                                <i class="bx bx-credit-card-front text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Metode Pembayaran</h3>
                        </div>

                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <label class="relative group cursor-pointer">
                                <input type="radio" name="payment_method" class="peer hidden" checked>
                                <div class="p-4 rounded-2xl border-2 border-slate-50 peer-checked:border-teal-500 peer-checked:bg-teal-50/30 hover:border-teal-200 transition-all text-center">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg" class="h-6 mx-auto mb-2 grayscale group-hover:grayscale-0 peer-checked:grayscale-0 transition-all">
                                    <p class="text-[10px] font-bold text-slate-500 uppercase">Transfer BCA</p>
                                </div>
                            </label>

                            <label class="relative group cursor-pointer">
                                <input type="radio" name="payment_method" class="peer hidden">
                                <div class="p-4 rounded-2xl border-2 border-slate-50 peer-checked:border-teal-500 peer-checked:bg-teal-50/30 hover:border-teal-200 transition-all text-center text-slate-400">
                                    <i class="bx bx-wallet text-2xl mb-1"></i>
                                    <p class="text-[10px] font-bold uppercase">E-Wallet / QRIS</p>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 sticky top-28">
                        <div class="flex items-center gap-3 mb-8">
                            <i class="bx bx-receipt text-2xl text-teal-600"></i>
                            <h3 class="text-lg font-bold text-slate-800">Ringkasan Pesanan</h3>
                        </div>

                        <div class="mb-6">
                            <label class="text-[10px] uppercase text-slate-400 tracking-widest mb-2 block font-bold">Durasi Rental</label>
                            <div class="relative group">
                                <i class="bx bx-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-teal-600 transition-colors"></i>
                                <input type="text" id="global_date_range"
                                    class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all text-sm text-slate-700 font-medium"
                                    placeholder="Pilih Tanggal Mulai - Selesai">
                            </div>
                        </div>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-sm text-slate-500">
                                <span>Subtotal Produk</span>
                                <span class="font-bold text-slate-800">Rp1.500.000</span>
                            </div>
                            <div class="flex justify-between text-sm text-slate-500">
                                <span>Total Hari</span>
                                <span class="font-bold text-slate-800" id="display_days">0 Hari</span>
                            </div>
                            <div class="border-t border-dashed border-slate-200 pt-4 flex justify-between items-end">
                                <span class="text-sm font-bold text-slate-800">Total Tagihan</span>
                                <span class="text-2xl font-black text-teal-600 leading-none">Rp0</span>
                            </div>
                        </div>

                        <button class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-sm uppercase tracking-[0.2em] hover:bg-teal-600 transition-all duration-300 shadow-lg shadow-slate-200 flex items-center justify-center gap-2">
                            Bayar Sekarang
                            <i class="bx bx-right-arrow-alt text-xl"></i>
                        </button>

                        <p class="text-center text-[10px] text-slate-400 mt-4 leading-relaxed">
                            Dengan membayar, Anda menyetujui <span class="underline cursor-pointer">S&K Layanan</span> RelaMudia.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#global_date_range", {
                mode: "range",
                minDate: "today",
                dateFormat: "d M Y",
                onChange: function(selectedDates, dateStr, instance) {
                    if (selectedDates.length === 2) {
                        const diffTime = Math.abs(selectedDates[1] - selectedDates[0]);
                        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                        document.getElementById('display_days').innerText = diffDays + " Hari";
                    }
                }
            });
        });
    </script>
</x-layout>
