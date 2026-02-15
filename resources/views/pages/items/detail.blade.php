<x-layout>
    <x-slot:title>{{ $item->name }} | RelaMudia</x-slot:title>

    <div class="bg-white min-h-screen">
        <div class="flex flex-col lg:flex-row min-h-[calc(100vh-80px)]">

            <div class="lg:w-7/12 bg-[#F6F6F6] flex items-center justify-center p-8 lg:p-20 relative rounded-r-2xl">
                <nav class="absolute top-8 left-8 text-[10px] uppercase tracking-[0.2em] text-slate-400">
                    <a href="/" class="hover:text-teal-600">Home</a> /
                    <a href="/items" class="hover:text-teal-600">{{ $item->category->name }}</a> /
                    <span class="text-slate-800">{{ $item->name }}</span>
                </nav>

                <img src="{{ $item->image }}"
                     alt="{{ $item->name }}"
                     class="max-w-full max-h-[70vh] object-contain transition-transform duration-700 hover:scale-105 rounded-2xl">
            </div>

            <div class="lg:w-5/12 p-8 lg:p-16 flex flex-col justify-center">

                <div class="mb-10">
                    <div class="flex justify-between items-start mb-2">
                        <h1 class="text-4xl font-bold text-slate-900 tracking-tighter leading-none">{{ $item->name }}</h1>
                        <span class="text-2xl font-light text-teal-600">Rp{{ number_format($item->price_per_day, 0, ',', '.') }}<span class="text-xs text-slate-400 font-medium">/hari</span></span>
                    </div>
                    <p class="text-[11px] uppercase tracking-[0.3em] text-teal-600 font-bold">{{ $item->category->name }}</p>
                </div>

                <div class="mb-10 prose prose-slate prose-sm text-slate-500 leading-relaxed">
                    <p>{{ $item->description }}</p>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-12 border-y border-gray-100 py-8">
                    <div>
                        <p class="text-[10px] uppercase text-slate-400 tracking-widest mb-1">Status</p>
                        <div class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full {{ $item->status == 'available' ? 'bg-teal-500' : 'bg-red-500' }}"></span>
                            <p class="text-sm font-bold text-slate-800 capitalize">{{ $item->status }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-[10px] uppercase text-slate-400 tracking-widest mb-1">Stok Alat</p>
                        <p class="text-sm font-bold text-slate-800">{{ $item->stock }} Unit</p>
                    </div>
                </div>

                <form action="#" method="POST" x-data="{ totalDays: 1 }">
                    @csrf
                    <div class="space-y-6">
                        <div class="relative">
                            <label class="text-[10px] uppercase text-slate-400 tracking-widest mb-2 block">Pilih Tanggal Sewa (Range)</label>
                            <div class="relative group">
                                <i class="bx bx-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-xl group-focus-within:text-teal-600 transition-colors"></i>
                                <input type="text" id="date_range" name="rental_range"
                                    class="w-full pl-12 pr-4 py-4 bg-teal-50/30 border border-teal-100 rounded-2xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all text-slate-700 font-medium"
                                    placeholder="Pilih rentang tanggal...">
                            </div>
                        </div>

                        <button type="submit"
                                class="w-full bg-slate-900 text-white py-5 rounded-2xl font-bold text-sm uppercase tracking-[0.2em] hover:bg-teal-600 transition-all duration-300 shadow-xl shadow-slate-200">
                            Konfirmasi Sewa Sekarang
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#date_range", {
                mode: "range",
                minDate: "today",
                dateFormat: "d M Y",
                disableMobile: "true",
                locale: {
                    rangeSeparator: " s/d "
                },
                onClose: function(selectedDates, dateStr, instance) {
                    // Logika untuk menghitung hari bisa ditambahkan di sini
                }
            });
        });
    </script>
</x-layout>
