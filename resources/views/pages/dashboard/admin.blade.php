<x-layout>
    <x-slot:title>Dashboard Admin | Relamudia</x-slot:title>

    <div class="bg-slate-50 min-h-screen pt-8 pb-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Welcome Section -->
            <div class="mb-10">
                <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Dashboard Admin</h1>
                <p class="text-slate-500 mt-1">Selamat datang kembali! Pantau performa rental hari ini.</p>
            </div>

            <!-- Overview Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <!-- Total Revenue -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div
                        class="absolute -right-4 -top-4 w-20 h-20 bg-teal-50 rounded-full group-hover:scale-110 transition-transform">
                    </div>
                    <div class="relative z-10">
                        <i class="bx bx-wallet text-3xl text-teal-600 mb-4 block"></i>
                        <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-1">Total Omzet
                        </p>
                        <h3 class="text-2xl font-black text-slate-900">Rp
                            {{ number_format($total_revenue, 0, ',', '.') }}</h3>
                    </div>
                </div>

                <!-- Active Rentals -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div
                        class="absolute -right-4 -top-4 w-20 h-20 bg-blue-50 rounded-full group-hover:scale-110 transition-transform">
                    </div>
                    <div class="relative z-10">
                        <i class="bx bx-time-five text-3xl text-blue-600 mb-4 block"></i>
                        <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-1">Rental Berjalan
                        </p>
                        <h3 class="text-2xl font-black text-slate-900">{{ $active_rentals }} Transaksi</h3>
                    </div>
                </div>

                <!-- Total Items -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div
                        class="absolute -right-4 -top-4 w-20 h-20 bg-amber-50 rounded-full group-hover:scale-110 transition-transform">
                    </div>
                    <div class="relative z-10">
                        <i class="bx bx-package text-3xl text-amber-600 mb-4 block"></i>
                        <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-1">Total Inventaris
                        </p>
                        <h3 class="text-2xl font-black text-slate-900">{{ $total_items }} Unit Item</h3>
                    </div>
                </div>

                <!-- Total Users -->
                <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm relative overflow-hidden group">
                    <div
                        class="absolute -right-4 -top-4 w-20 h-20 bg-indigo-50 rounded-full group-hover:scale-110 transition-transform">
                    </div>
                    <div class="relative z-10">
                        <i class="bx bx-group text-3xl text-indigo-600 mb-4 block"></i>
                        <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-1">Total Pelanggan
                        </p>
                        <h3 class="text-2xl font-black text-slate-900">{{ $total_users }} Pelanggan</h3>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-10">
                <!-- Revenue Chart -->
                <div class="lg:col-span-2 bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h4 class="text-lg font-bold text-slate-800">Tren Pendapatan</h4>
                            <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">Statistik 6 Bulan
                                Terakhir</p>
                        </div>
                    </div>
                    <div class="h-64">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Status Distribution Chart -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                    <h4 class="text-lg font-bold text-slate-800 mb-2">Status Transaksi</h4>
                    <p class="text-[11px] font-black uppercase tracking-widest text-slate-400 mb-8">Distribusi Total
                        Transaksi</p>
                    <div class="h-56">
                        <canvas id="statusChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Detailed Stats & Recent Activity Row -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Top Rented Items -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h4 class="text-lg font-bold text-slate-800">Top 5 Item Terlaris</h4>
                            <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">Item paling
                                sering disewa</p>
                        </div>
                    </div>
                    <div class="space-y-6">
                        @forelse($top_items as $item)
                            <div class="flex items-center gap-4 group">
                                <div
                                    class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center border border-slate-100 overflow-hidden">
                                    <img src="{{ $item->multimediaItem->image }}" class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h5
                                        class="text-sm font-bold text-slate-800 group-hover:text-teal-600 transition-colors line-clamp-1">
                                        {{ $item->multimediaItem->name }}
                                    </h5>
                                    <p class="text-[11px] text-slate-400 font-medium">Disewa {{ $item->total_rented }}
                                        kali</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-black text-slate-700">Rp
                                        {{ number_format($item->multimediaItem->price_per_day, 0, ',', '.') }}</p>
                                    <p class="text-[10px] text-slate-400 uppercase font-black">/ Hari</p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-slate-400">Belum ada data item</div>
                        @endforelse
                    </div>
                </div>

                <!-- Recent Transactions -->
                <div class="bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h4 class="text-lg font-bold text-slate-800">Transaksi Terbaru</h4>
                            <p class="text-[11px] font-black uppercase tracking-widest text-slate-400">Aktifitas terbaru
                                pelanggan</p>
                        </div>
                        <a href="{{ route('transaction.index') }}"
                            class="text-[11px] font-black uppercase tracking-widest text-teal-600 hover:text-teal-700 transition-colors">Lihat
                            Semua</a>
                    </div>
                    <div class="space-y-6">
                        @forelse($recent_transactions as $trx)
                            <div class="flex items-center gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-xs uppercase">
                                    {{ substr($trx->user->name, 0, 2) }}
                                </div>
                                <div class="flex-1">
                                    <h5 class="text-sm font-bold text-slate-800 leading-none mb-1 capitalize">
                                        {{ $trx->user->name }}</h5>
                                    <p class="text-[11px] text-slate-400">ID: #RENT-{{ $trx->id }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-slate-700">Rp
                                        {{ number_format($trx->total_price, 0, ',', '.') }}</p>
                                    @php
                                        $colors = [
                                            'pending' => 'text-amber-500',
                                            'paid' => 'text-blue-500',
                                            'ongoing' => 'text-indigo-500',
                                            'completed' => 'text-emerald-500',
                                            'cancelled' => 'text-rose-500',
                                        ];
                                    @endphp
                                    <p
                                        class="text-[9px] font-black uppercase tracking-tighter {{ $colors[$trx->status] ?? 'text-slate-400' }}">
                                        {{ $trx->status }}
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-10 text-slate-400">Belum ada transaksi</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set global font family for all charts
            Chart.defaults.font.family = "'Google Sans', sans-serif";

            // Data for Revenue Chart
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            new Chart(revenueCtx, {
                type: 'line',
                data: {
                    labels: @json($months),
                    datasets: [{
                        label: 'Pendapatan',
                        data: @json($revenues),
                        borderColor: '#0d9488',
                        backgroundColor: 'rgba(13, 148, 136, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#0d9488',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                },
                                font: {
                                    size: 10,
                                    weight: 'bold'
                                }
                            },
                            grid: {
                                borderDash: [5, 5]
                            }
                        },
                        x: {
                            ticks: {
                                font: {
                                    size: 10,
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });

            // Data for Status Chart
            const statusCtx = document.getElementById('statusChart').getContext('2d');
            const statusData = @json($status_counts);
            // Capitalize status labels directly
            const labels = Object.keys(statusData).map(label => label.charAt(0).toUpperCase() + label.slice(1));
            const values = Object.values(statusData);

            new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: [
                            '#f59e0b', // pending
                            '#3b82f6', // paid
                            '#6366f1', // ongoing
                            '#10b981', // completed
                            '#f43f5e' // cancelled
                        ],
                        borderWidth: 0,
                        cutout: '75%'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                usePointStyle: true,
                                padding: 20,
                                font: {
                                    size: 10,
                                    weight: 'bold'
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-layout>
