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
            <p class="text-slate-500 mb-10">Anda memiliki <span
                    class="text-teal-600 font-bold">{{ auth()->user()->carts()->count() }} produk</span> di dalam
                keranjang.</p>

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
                                    <tr
                                        class="text-left text-[11px] uppercase tracking-widest text-slate-400 font-bold">
                                        <th class="px-8 py-5">Produk</th>
                                        <th class="px-4 py-5 text-center">Harga/Hari</th>
                                        <th class="px-4 py-5 text-center">Jumlah</th>
                                        <th class="px-4 py-5 text-center">Subtotal</th>
                                        <th class="px-8 py-5"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach ($carts as $cart)
                                        <tr class="group hover:bg-slate-50/30 transition-colors"
                                            data-id="{{ $cart->id }}" data-price="{{ $cart->price_per_day }}">
                                            <td class="px-8 py-6">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="w-20 h-20 rounded-2xl bg-slate-100 overflow-hidden border border-slate-100 p-2">
                                                        <img src="{{ $cart->multimediaItem->image }}"
                                                            class="w-full h-full object-cover rounded-2xl">
                                                    </div>
                                                    <div>
                                                        <h4 class="font-bold text-slate-800">
                                                            {{ $cart->multimediaItem->name }}</h4>
                                                        <p class="text-xs text-slate-400">
                                                            {{ $cart->multimediaItem->category->name }}</p>

                                                        <form action="{{ route('carts.update', $cart->id) }}"
                                                            id="formUpdate{{ $cart->id }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="quantity"
                                                                id="qtyField{{ $cart->id }}">
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-4 py-6 text-center font-bold text-slate-700">Rp
                                                {{ number_format($cart->price_per_day, 0, ',', '.') }}</td>
                                            <td class="px-4 py-6">
                                                <div class="flex items-center justify-center gap-3">
                                                    <button onclick="updateQty(this, -1)"
                                                        class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 hover:border-teal-500 hover:text-teal-600 transition-all">-</button>

                                                    <span
                                                        class="font-bold text-slate-800 text-sm quantity-label">{{ $cart->quantity }}</span>

                                                    <button onclick="updateQty(this, 1)"
                                                        class="w-8 h-8 rounded-lg bg-teal-500 flex items-center justify-center text-white hover:bg-teal-600 transition-all shadow-lg shadow-teal-500/20">+</button>
                                                </div>
                                            </td>
                                            <td class="px-4 py-6 text-center font-bold text-teal-600 item-subtotal">
                                                Rp {{ number_format($cart->subtotal, 0, ',', '.') }}
                                            </td>
                                            <td class="text-right px-4" style="width: 5%;">
                                                <form action="{{ route('carts.destroy', $cart->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button
                                                        class="p-2 text-slate-300 hover:text-red-500 transition-colors"
                                                        type="submit">
                                                        <i class="bx bx-trash text-xl"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                                <i class="bx bx-edit-alt text-2xl"></i>
                            </div>
                            <div class="flex flex-col">
                                <h3 class="text-lg font-bold text-slate-800 leading-tight">Catatan Sewa</h3>
                                <p class="text-[11px] text-slate-400">Tambahkan pesan untuk tim operasional kami
                                    (opsional)</p>
                            </div>
                        </div>

                        <form action="{{ route('transaction.store') }}" method="POST" class="relative group" id="formTransaction">
                            @csrf
                            <input type="hidden" name="start_date" id="start_date">
                            <input type="hidden" name="end_date" id="end_date">
                            <textarea name="note" rows="3"
                                placeholder="Contoh: Saya butuh kabel charger cadangan atau instruksi khusus pengambilan barang..."
                                class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all text-sm text-slate-700 placeholder:text-slate-300 resize-none"></textarea>

                            <div
                                class="absolute bottom-4 right-4 flex items-center gap-2 pointer-events-none opacity-40">
                                <i class="bx bx-info-circle text-xs text-slate-400"></i>
                                <span class="text-[10px] text-slate-400 font-medium">Pastikan catatan jelas</span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="space-y-6">
                    <div
                        class="bg-white p-8 rounded-3xl border border-slate-100 shadow-xl shadow-slate-200/50 sticky top-28">
                        <div class="flex items-center gap-3 mb-8">
                            <i class="bx bx-receipt text-2xl text-teal-600"></i>
                            <h3 class="text-lg font-bold text-slate-800">Ringkasan Pesanan</h3>
                        </div>

                        <div class="mb-6">
                            <label
                                class="text-[10px] uppercase text-slate-400 tracking-widest mb-2 block font-bold">Durasi
                                Rental</label>
                            <div class="relative group">
                                <i
                                    class="bx bx-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-teal-600 transition-colors"></i>
                                <input type="text" id="global_date_range"
                                    class="w-full pl-12 pr-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all text-sm text-slate-700 font-medium"
                                    placeholder="Pilih Tanggal Mulai - Selesai">
                            </div>
                        </div>

                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between text-sm text-slate-500">
                                <span>Subtotal Produk</span>
                                <span class="font-bold text-slate-800">Rp
                                    {{ number_format($carts->sum('subtotal') ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-slate-500">
                                <span>Total Hari</span>
                                <span class="font-bold text-slate-800" id="display_days">0 Hari</span>
                            </div>
                            <div class="border-t border-dashed border-slate-200 pt-4 flex justify-between items-end">
                                <span class="text-sm font-bold text-slate-800">Total Tagihan</span>
                                <span class="text-2xl font-black text-teal-600 leading-none" id="total">Rp
                                    0</span>
                            </div>
                        </div>

                        <button onclick="submitTrans();"
                            class="w-full bg-slate-900 text-white py-4 rounded-2xl font-bold text-sm uppercase tracking-[0.2em] hover:bg-teal-600 transition-all duration-300 shadow-lg shadow-slate-200 flex items-center justify-center gap-2">
                            Bayar Sekarang
                            <i class="bx bx-right-arrow-alt text-xl"></i>
                        </button>

                        <p class="text-center text-[10px] text-slate-400 mt-4 leading-relaxed">
                            Dengan membayar, Anda menyetujui <span class="underline cursor-pointer">S&K Layanan</span>
                            RelaMudia.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        let debounceTimer;
        let rentalDays = 1; // Default 1 hari

        document.addEventListener('DOMContentLoaded', function() {

            function formatDateToYMD(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            flatpickr("#global_date_range", {
                mode: "range",
                minDate: "today",
                dateFormat: "d M Y",
                locale: {
                    rangeSeparator: " - "
                },
                onChange: function(selectedDates) {
                    if (selectedDates.length === 2) {

                        const diffTime = Math.abs(selectedDates[1] - selectedDates[0]);
                        rentalDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
                        document.getElementById('display_days').innerText = rentalDays + " Hari";

                        document.getElementById('start_date').value = formatDateToYMD(selectedDates[0]);
                        document.getElementById('end_date').value = formatDateToYMD(selectedDates[1]);

                        calculateGrandTotal();
                    }
                }
            });
        });

        // 2. Fungsi Update Quantity (UI & Data)
        function updateQty(btn, change) {
            const row = btn.closest('tr');
            const qtyLabel = row.querySelector('.quantity-label');
            const subtotalLabel = row.querySelector('.item-subtotal');
            const pricePerDay = parseInt(row.getAttribute('data-price'));
            const cartId = row.getAttribute('data-id');

            let currentQty = parseInt(qtyLabel.innerText);
            let newQty = currentQty + change;

            if (newQty < 1) return; // Minimal 1 barang

            // Update UI secara instan
            qtyLabel.innerText = newQty;
            document.getElementById('qtyField' + cartId).value = newQty;
            const newSubtotal = newQty * pricePerDay;
            subtotalLabel.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(newSubtotal);

            calculateGrandTotal();

            // 3. Debounce: Kirim ke database setelah berhenti klik
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                document.getElementById('formUpdate' + cartId).submit();
            }, 1000); // Tunggu 1 detik
        }

        // 4. Hitung Total Akhir (Produk x Hari)
        function calculateGrandTotal() {
            let productTotal = 0;
            document.querySelectorAll('tr[data-price]').forEach(row => {
                const price = parseInt(row.getAttribute('data-price'));
                const qty = parseInt(row.querySelector('.quantity-label').innerText);
                productTotal += (price * qty);
            });

            const grandTotal = productTotal * rentalDays;

            // Update Ringkasan Pesanan
            document.querySelector('.font-bold.text-slate-800').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(
                productTotal);
            document.getElementById('total').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(grandTotal);
        }

        function submitTrans(){
            document.getElementById('formTransaction').submit();
        }
    </script>
</x-layout>
