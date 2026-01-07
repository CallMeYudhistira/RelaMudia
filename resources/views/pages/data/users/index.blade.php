<x-layout>
    <x-slot:title>Data | Users</x-slot:title>

    @if (session('success'))
        <div class="fixed top-4 right-4 z-50">
            <div class="flex items-center gap-3 rounded-lg bg-green-600 px-4 py-3 text-white shadow-lg">
                <i class="bx bx-check-circle text-xl"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 z-50">
            <div class="rounded-lg bg-red-600 px-4 py-3 text-white shadow-lg max-w-md">
                <div class="flex items-start gap-3">
                    <i class="bx bx-error-circle text-xl mt-0.5"></i>
                    <div class="text-sm">
                        {{ session('error') }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-6">
        <div class="mx-auto max-w-7xl">

            <div class="rounded-xl bg-white shadow-sm border border-gray-200">

                <div
                    class="flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between border-b border-gray-200">

                    <form action="{{ route('users.index') }}" method="GET" class="flex items-center gap-2">
                        <div class="relative">
                            <i class="bx bx-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-lg"></i>
                            <input type="text" name="search" placeholder="Cari pengguna..."
                                value="{{ $search ?? '' }}" autocomplete="off"
                                class="w-64 rounded-lg border border-gray-300 py-2 pl-10 pr-3 text-sm focus:border-teal-500 focus:outline-none focus:ring-1 focus:ring-teal-500">
                        </div>
                        <button type="submit"
                            class="rounded-lg bg-teal-600 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-700">
                            Cari
                        </button>
                    </form>

                    <a href="{{ route('users.create') }}"
                        class="inline-flex items-center gap-2 rounded-lg bg-teal-600 px-4 py-2 text-sm font-semibold text-white hover:bg-teal-700">
                        <i class="bx bx-plus"></i>
                        Tambah Pengguna
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="px-4 py-3 text-center font-semibold">#</th>
                                <th class="px-4 py-3 text-left font-semibold">Nama Lengkap</th>
                                <th class="px-4 py-3 text-left font-semibold">Email</th>
                                <th class="px-4 py-3 text-center font-semibold">Role</th>
                                <th class="px-4 py-3 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach ($users as $i => $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-center">
                                        {{ $i + 1 }}
                                    </td>
                                    <td class="px-4 py-3 font-medium text-gray-800">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <span
                                            class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="text-center" x-data="{ open: false }">
                                        <button @click="open = !open"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                                            Aksi
                                            <i class='bx bx-chevron-down text-lg'></i>
                                        </button>

                                        <div x-show="open" @click.outside="open = false" x-transition
                                            class="absolute z-50 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg text-left">

                                            <a href="{{ route('users.edit', $user->id) }}"
                                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                Ubah
                                            </a>

                                            @if (auth()->user()->id !== $user->id)
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
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
