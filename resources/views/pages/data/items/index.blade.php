<x-layout>
    <x-slot:title>Data | Items</x-slot:title>

    <div class="py-6">
        <div class="mx-auto max-w-7xl">

            <div class="rounded-xl bg-white shadow-sm border border-gray-200">

                <div
                    class="flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between border-b border-gray-200">

                    <form action="{{ route('items.index') }}" method="GET" class="flex items-center gap-2">
                        <div class="relative">
                            <i class="bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input type="text" name="search" placeholder="Cari item..." value="{{ $search ?? '' }}"
                                autocomplete="off"
                                class="w-64 rounded-lg border border-gray-300 py-2 pl-10 pr-3 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
                        </div>
                        <button type="submit"
                            class="rounded-lg bg-teal-600 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-700">
                            Cari
                        </button>
                    </form>

                    <a href="{{ route('items.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-teal-600 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-700">
                        <i class="bx bx-plus"></i>
                        Tambah Item
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm whitespace-nowrap">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold">#</th>
                                <th class="px-4 py-3 text-left font-semibold">Foto</th>
                                <th class="px-4 py-3 text-left font-semibold">Nama Item</th>
                                <th class="px-4 py-3 text-left font-semibold">Kategori</th>
                                <th class="px-4 py-3 text-left font-semibold">Deskripsi</th>
                                <th class="px-4 py-3 text-left font-semibold">Harga Per Hari</th>
                                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($items as $i => $item)
                                {{-- Kita definisikan x-data di level TR agar mencakup tombol aksi dan modal --}}
                                <tr class="hover:bg-gray-50" x-data="{ openDelete: false, openMenu: false }">
                                    <td class="px-4 py-3 text-center w-5">{{ $i + 1 }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-800">
                                        <img src="{{ asset($item->image) }}" alt="Foto Item"
                                            class="img-fluid w-12 object-contain">
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-800">{{ $item->name }}</td>
                                    <td class="px-4 py-3">
                                        <span
                                            class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                            {{ $item->category->name }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-600 truncate max-w-[150px]"
                                        title="{{ $item->description }}">
                                        {{ $item->description }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ 'Rp. ' . number_format($item->price_per_day, '0', ',', '.') }}</td>
                                    <td class="px-4 py-3 text-center relative w-10">
                                        <button @click="openMenu = !openMenu"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                                            Aksi
                                            <i class='bx bx-chevron-down text-lg'></i>
                                        </button>

                                        <div x-show="openMenu" @click.outside="openMenu = false" x-transition
                                            class="absolute right-0 z-40 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg text-left">
                                            <a href="{{ route('items.edit', $item->id) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Ubah
                                            </a>

                                            <button @click="openDelete = true; openMenu = false"
                                                class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                Hapus
                                            </button>
                                        </div>

                                        {{-- MODAL DIPANGGIL DI SINI: Harus di dalam TD agar tidak merusak struktur TR --}}
                                        @include('pages.data.items.delete')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>
