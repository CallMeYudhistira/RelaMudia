<x-layout>
    <x-slot:title>Laporan Transaksi | Admin</x-slot:title>

    <div class="bg-slate-50 min-h-screen pt-8 pb-20 print:bg-white print:pt-0">
        <div class="max-w-7xl mx-auto px-6 print:px-0">

            <!-- Header Section (Hidden on Print) -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 print:hidden">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Laporan & Analisis</h1>
                    <p class="text-slate-500 mt-1">Pantau performa bisnis, turnover, dan aktivitas penyewaan.</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('report.print', request()->query()) }}"
                        class="px-6 py-3 bg-white border border-slate-200 text-slate-700 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm flex items-center gap-2">
                        <i class="bx bx-printer text-lg"></i> Cetak PDF
                    </a>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                <!-- Turnover Card -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                        <i class="bx bx-wallet text-6xl text-teal-600"></i>
                    </div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2">Total Turnover</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none">
                        Rp {{ number_format($turnover, 0, ',', '.') }}
                    </h3>
                    <p class="text-[10px] text-teal-600 font-bold mt-3 uppercase tracking-[0.2em]">Total Pendapatan
                        Bersih</p>
                </div>

                <!-- Top Customer Card -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                        <i class="bx bx-user-circle text-6xl text-blue-600"></i>
                    </div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2">Pelanggan Tertinggi
                    </p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none truncate pr-10 capitalize">
                        {{ $top_customer ? $top_customer->user->name : '-' }}
                    </h3>
                    <p class="text-[10px] text-blue-600 font-bold mt-3 uppercase tracking-[0.2em]">
                        Total Belanja: Rp
                        {{ $top_customer ? number_format($top_customer->total_spent, 0, ',', '.') : '0' }}
                    </p>
                </div>

                <!-- Top Item Card -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div class="absolute top-0 right-0 p-4 opacity-10 group-hover:scale-110 transition-transform">
                        <i class="bx bx-package text-6xl text-amber-600"></i>
                    </div>
                    <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-2">Item Terlaris</p>
                    <h3 class="text-2xl font-black text-slate-900 leading-none truncate pr-10">
                        {{ $top_item ? $top_item->multimediaItem->name : '-' }}
                    </h3>
                    <p class="text-[10px] text-amber-600 font-bold mt-3 uppercase tracking-[0.2em]">
                        Disewa Sebanyak {{ $top_item ? $top_item->total_rented : '0' }} x
                    </p>
                </div>
            </div>

            <!-- Filters & Tabs (Hidden on Print) -->
            <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm mb-8 print:hidden">
                <form action="{{ route('report.index') }}" method="GET" id="reportForm">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 items-end">
                        <div>
                            <label
                                class="text-[11px] font-black uppercase tracking-widest text-slate-400 block mb-2">Tipe
                                Laporan</label>
                            <select name="type" onchange="this.form.submit()"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                                <option value="sales" {{ $type == 'sales' ? 'selected' : '' }}>Laporan Penjualan
                                </option>
                                <option value="customer" {{ $type == 'customer' ? 'selected' : '' }}>Laporan Pelanggan
                                </option>
                                <option value="item" {{ $type == 'item' ? 'selected' : '' }}>Laporan Item/Produk
                                </option>
                            </select>
                        </div>

                        <div>
                            <label
                                class="text-[11px] font-black uppercase tracking-widest text-slate-400 block mb-2">Periode</label>
                            <select name="period" id="periodSelect"
                                onchange="toggleDateInputs(this.value); if(this.value !== 'custom') this.form.submit();"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                                <option value="daily" {{ $period == 'daily' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="weekly" {{ $period == 'weekly' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="monthly" {{ $period == 'monthly' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="yearly" {{ $period == 'yearly' ? 'selected' : '' }}>Tahun Ini</option>
                                <option value="custom" {{ $period == 'custom' ? 'selected' : '' }}>Kustom Tanggal
                                </option>
                            </select>
                        </div>

                        <div id="customDateRange"
                            class="{{ $period == 'custom' ? '' : 'hidden' }} flex gap-2 col-span-2">
                            <div class="flex-1">
                                <label
                                    class="text-[11px] font-black uppercase tracking-widest text-slate-400 block mb-2">Dari</label>
                                <input type="date" name="start_date" value="{{ $startDate }}"
                                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                            </div>
                            <div class="flex-1">
                                <label
                                    class="text-[11px] font-black uppercase tracking-widest text-slate-400 block mb-2">Sampai</label>
                                <div class="flex gap-2">
                                    <input type="date" name="end_date" value="{{ $endDate }}"
                                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                                    <button type="submit"
                                        class="bg-teal-600 text-white p-3 rounded-xl hover:bg-teal-700 transition-all shadow-lg shadow-teal-500/20">
                                        <i class="bx bx-search-alt text-xl"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Data Table -->
            <div
                class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden print:border-none print:shadow-none">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                @if ($type == 'sales')
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                        Order ID</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                        Pelanggan</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                        Tanggal</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                        Status</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400 text-right">
                                        Total</th>
                                @elseif($type == 'customer')
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                        Pelanggan</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                        Email</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400 text-center">
                                        Frekuensi Sewa</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400 text-right">
                                        Total Spending</th>
                                @elseif($type == 'item')
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                        Nama Item</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                        Kategori</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400 text-center">
                                        Total Unit Sewa</th>
                                    <th
                                        class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400 text-right">
                                        Total Revenue</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @forelse($data as $row)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    @if ($type == 'sales')
                                        <td class="px-6 py-5 font-mono font-bold text-teal-600 text-sm">
                                            #RENT-{{ $row->id }}</td>
                                        <td class="px-6 py-5">
                                            <p class="text-sm font-bold text-slate-800 leading-none capitalize">
                                                {{ $row->user->name }}</p>
                                            <p class="text-[11px] text-slate-400 mt-1">{{ $row->user->email }}</p>
                                        </td>
                                        <td class="px-6 py-5 text-xs text-slate-500 font-medium">
                                            {{ $row->created_at->translatedFormat('d M Y, H:i') }}</td>
                                        <td class="px-6 py-5">
                                            <span
                                                class="text-[9px] font-black uppercase px-2 py-1 rounded-full bg-teal-50 text-teal-600 border border-teal-100">
                                                {{ $row->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-5 text-sm font-black text-slate-900 text-right">Rp
                                            {{ number_format($row->total_price, 0, ',', '.') }}</td>
                                    @elseif($type == 'customer')
                                        <td class="px-6 py-5">
                                            <p class="text-sm font-bold text-slate-800 capitalize">{{ $row->user->name }}</p>
                                        </td>
                                        <td class="px-6 py-5 text-sm text-slate-500">{{ $row->user->email }}</td>
                                        <td class="px-6 py-5 text-sm font-bold text-slate-700 text-center">
                                            {{ $row->total_rentals }}x</td>
                                        <td class="px-6 py-5 text-sm font-black text-teal-600 text-right">Rp
                                            {{ number_format($row->total_spent, 0, ',', '.') }}</td>
                                    @elseif($type == 'item')
                                        <td class="px-6 py-5">
                                            <p class="text-sm font-bold text-slate-800">
                                                {{ $row->multimediaItem->name }}</p>
                                        </td>
                                        <td class="px-6 py-5 text-xs text-slate-500">
                                            {{ $row->multimediaItem->category->name ?? '-' }}</td>
                                        <td class="px-6 py-5 text-sm font-bold text-slate-700 text-center">
                                            {{ $row->total_rented }} Unit</td>
                                        <td class="px-6 py-5 text-sm font-black text-teal-600 text-right">Rp
                                            {{ number_format($row->total_revenue, 0, ',', '.') }}</td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                        <i class="bx bx-data text-4xl mb-2"></i>
                                        <p class="text-xs font-bold uppercase tracking-widest">Tidak ada data untuk
                                            periode ini</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDateInputs(value) {
            const rangeInput = document.getElementById('customDateRange');
            if (value === 'custom') {
                rangeInput.classList.remove('hidden');
            } else {
                rangeInput.classList.add('hidden');
            }
        }
    </script>
</x-layout>
