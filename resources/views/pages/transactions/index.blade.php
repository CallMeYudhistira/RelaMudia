<x-layout>
    <x-slot:title>Management Transaksi | Admin</x-slot:title>

    <div class="bg-slate-50 min-h-screen pt-8 pb-20">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 tracking-tight">Management Transaksi</h1>
                    <p class="text-slate-500 mt-1">Kelola status penyewaan dan pantau aktivitas transaksi pelanggan.</p>
                </div>

                <form action="{{ route('transaction.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4 w-full md:w-auto" id="formFilter">
                    <div class="relative w-full sm:w-52">
                        <select
                            class="appearance-none w-full px-5 py-3 bg-white border border-teal-100 rounded-xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all text-slate-700 font-medium cursor-pointer"
                            name="status" onchange="submitForm();">
                            <option value="" selected>Semua Kategori</option>
                            <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>Proses</option>
                            <option value="paid" {{ $status == 'paid' ? 'selected' : '' }}>Dibayar</option>
                            <option value="ongoing" {{ $status == 'ongoing' ? 'selected' : '' }}>Digunakan</option>
                            <option value="completed" {{ $status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="cancelled" {{ $status == 'cancelled' ? 'selected' : '' }}>Batal</option>
                        </select>
                        <i
                            class="bx bx-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xl"></i>
                    </div>
                    <div class="w-full sm:w-64">
                        <div class="relative group">
                            <i
                                class="bx bx-calendar absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg group-focus-within:text-teal-600 transition-colors"></i>
                            <input type="text" id="global_date_range"
                                class="w-full pl-12 pr-4 py-3 bg-white border border-slate-100 rounded-xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all text-sm text-slate-700 font-medium"
                                placeholder="Pilih Tanggal">
                            <input type="hidden" name="start_date" id="start_date" value="{{ $start ?? '' }}">
                            <input type="hidden" name="end_date" id="end_date" value="{{ $end ?? '' }}">
                        </div>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-slate-50/50 border-b border-slate-100">
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                    Order ID</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                    Pelanggan</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                    Total Bayar</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                    Status</th>
                                <th class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400">
                                    Tanggal</th>
                                <th
                                    class="px-6 py-5 text-[11px] font-black uppercase tracking-widest text-slate-400 text-center">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach ($transactions as $trx)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-5">
                                        <span
                                            class="font-mono font-bold text-teal-600 text-sm">#RENT-{{ $trx->id }}</span>
                                    </td>
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 font-bold text-xs uppercase">
                                                {{ substr($trx->user->name, 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-bold text-slate-800 leading-none">
                                                    {{ $trx->user->name }}</p>
                                                <p class="text-[11px] text-slate-400 mt-1">{{ $trx->user->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 text-sm font-bold text-slate-700">
                                        Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-6 py-5">
                                        @php
                                            $status = $trx->status;
                                            if ($status === 'pending') {
                                                $status = 'Proses';
                                            } elseif ($status === 'ongoing') {
                                                $status = 'Digunakan';
                                            } elseif ($status === 'paid') {
                                                $status = 'Dibayar';
                                            } elseif ($status === 'completed') {
                                                $status = 'Selesai';
                                            } elseif ($status === 'cancelled') {
                                                $status = 'Batal';
                                            } else {
                                                $status = 'Gagal';
                                            }
                                            $colors = [
                                                'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                                'paid' => 'bg-blue-50 text-blue-600 border-blue-100',
                                                'ongoing' => 'bg-indigo-50 text-indigo-600 border-indigo-100',
                                                'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                                'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
                                            ];
                                            $currentColor = $colors[$trx->status] ?? 'bg-slate-50 text-slate-600';
                                        @endphp
                                        <span
                                            class="text-[10px] font-black uppercase px-3 py-1 rounded-full border {{ $currentColor }}">
                                            {{ $status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-xs text-slate-500 font-medium">
                                        {{ $trx->created_at->translatedFormat('d M Y, H:i') }}
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <button
                                            onclick="openEditModal('{{ $trx->id }}', '{{ $trx->status }}', '{{ $trx->note }}')"
                                            class="p-2 hover:bg-white hover:shadow-sm border border-transparent hover:border-slate-200 rounded-xl text-slate-400 hover:text-teal-600 transition-all">
                                            <i class="bx bx-edit-alt text-xl"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-sm transition-opacity" onclick="closeModal()"></div>

            <div class="bg-white rounded-3xl shadow-2xl z-50 w-full max-w-md overflow-hidden transform transition-all">
                <div class="px-8 py-6 border-b border-slate-50 flex justify-between items-center">
                    <h3 class="font-bold text-slate-800">Update Transaksi</h3>
                    <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600"><i
                            class="bx bx-x text-2xl"></i></button>
                </div>

                <form id="editForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <div class="p-8 space-y-6">
                        <div>
                            <label
                                class="text-[11px] font-black uppercase tracking-widest text-slate-400 block mb-2">Status
                                Transaksi</label>
                            <select name="status" id="modalStatus"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm font-bold text-slate-700 focus:ring-2 focus:ring-teal-500 outline-none transition-all">
                                <option value="paid">Paid</option>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div>
                            <label id="noteLabel"
                                class="text-[11px] font-black uppercase tracking-widest text-slate-400 block mb-2">Catatan
                                Admin / User</label>
                            <textarea name="note" id="modalNote" rows="4"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-sm text-slate-700 focus:ring-2 focus:ring-teal-500 outline-none transition-all"
                                placeholder="Tambahkan alasan atau info tambahan..."></textarea>
                        </div>
                    </div>

                    <div class="px-8 py-6 bg-slate-50 flex gap-3">
                        <button type="button" onclick="closeModal()"
                            class="flex-1 px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl text-xs font-bold uppercase tracking-widest hover:bg-slate-100 transition-all">Batal</button>
                        <button type="submit" id="saveButton"
                            class="flex-1 px-6 py-3 bg-teal-600 text-white rounded-xl text-xs font-bold uppercase tracking-widest shadow-lg shadow-teal-500/20 hover:bg-teal-700 transition-all">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            function formatDateToYMD(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            }

            const startDate = @json($start);
            const endDate = @json($end);

            flatpickr("#global_date_range", {
                mode: "range",
                dateFormat: "d M Y",
                defaultDate: (startDate && endDate) ? [new Date(startDate), new Date(endDate)] : null,
                locale: {
                    rangeSeparator: " - "
                },
                onChange: function(selectedDates) {
                    if (selectedDates.length === 2) {
                        document.getElementById('start_date').value = formatDateToYMD(selectedDates[0]);
                        document.getElementById('end_date').value = formatDateToYMD(selectedDates[1]);
                        submitForm();
                    }
                }
            });

            // Add listener for status change
            const statusSelect = document.getElementById('modalStatus');
            const noteTextarea = document.getElementById('modalNote');
            const noteLabel = document.getElementById('noteLabel');

            statusSelect.addEventListener('change', function() {
                if (this.value === 'cancelled') {
                    noteTextarea.required = true;
                    noteLabel.innerHTML = 'Catatan Admin / User <span class="text-rose-500">* Wajib</span>';
                    noteTextarea.placeholder = 'Alasan pembatalan (wajib)...';
                } else {
                    noteTextarea.required = false;
                    noteLabel.innerHTML = 'Catatan Admin / User';
                    noteTextarea.placeholder = 'Tambahkan alasan atau info tambahan...';
                }
            });
        });

        function submitForm() {
            document.getElementById('formFilter').submit();
        }

        function openEditModal(id, status, note) {
            const modal = document.getElementById('editModal');
            const form = document.getElementById('editForm');
            const statusSelect = document.getElementById('modalStatus');
            const noteTextarea = document.getElementById('modalNote');
            const saveButton = document.getElementById('saveButton');
            const noteLabel = document.getElementById('noteLabel');

            // Set Action URL (Sesuaikan dengan route Laravel Anda)
            form.action = `/admin/transaction/${id}`;

            // Set Current Values
            statusSelect.value = status;
            noteTextarea.value = note;

            // Handle disabled state if completed or cancelled
            if (status === 'completed' || status === 'cancelled') {
                statusSelect.disabled = true;
                saveButton.disabled = true;
                saveButton.classList.add('opacity-50', 'cursor-not-allowed');
                noteTextarea.disabled = true;
            } else {
                statusSelect.disabled = false;
                saveButton.disabled = false;
                saveButton.classList.remove('opacity-50', 'cursor-not-allowed');
                noteTextarea.disabled = false;
            }

            // Initial check for required note if status is already cancelled (though it should be disabled)
            if (status === 'cancelled') {
                noteTextarea.required = true;
                noteLabel.innerHTML = 'Catatan Admin / User <span class="text-rose-500">* Wajib</span>';
            } else {
                noteTextarea.required = false;
                noteLabel.innerHTML = 'Catatan Admin / User';
            }

            // Show Modal
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            const modal = document.getElementById('editModal');
            const statusSelect = document.getElementById('modalStatus');
            const noteTextarea = document.getElementById('modalNote');
            const saveButton = document.getElementById('saveButton');

            // Reset disabilities
            statusSelect.disabled = false;
            saveButton.disabled = false;
            saveButton.classList.remove('opacity-50', 'cursor-not-allowed');
            noteTextarea.disabled = false;

            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }
    </script>
</x-layout>
