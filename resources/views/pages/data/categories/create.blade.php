<x-layout>
    <x-slot:title>Create | Categories</x-slot:title>

    @if ($errors->any())
        <div class="fixed top-4 right-4 z-50">
            <div class="rounded-lg bg-red-600 px-4 py-3 text-white shadow-lg max-w-md">
                <div class="flex items-start gap-3">
                    <i class="bx bx-error-circle text-xl mt-0.5"></i>
                    <div class="text-sm">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-6">
        <div class="mx-auto max-w-7xl">

            <div class="rounded-xl bg-white shadow-sm border border-gray-200">
                <div class="border-b border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-800">Tambah Kategori Baru</h2>
                    <p class="mt-1 text-sm text-gray-500">Silakan isi detail informasi di bawah ini untuk mendaftarkan
                        kategori baru.</p>
                </div>

                <form action="{{ route('categories.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="grid grid-cols-1 gap-6">

                        <div class="space-y-2">
                            <label for="name" class="text-sm font-medium text-gray-700 block">Nama Kategori</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <i class="bx bx-category text-lg"></i>
                                </span>
                                <input type="text" name="name" id="name" required
                                    class="block w-full rounded-lg border border-gray-300 bg-white py-2.5 pl-10 pr-3 text-gray-900 transition-all focus:border-teal-500 focus:ring-2 focus:ring-teal-500/20 outline-none"
                                    placeholder="Masukkan nama kategori" value="{{ old('name') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-3 border-t border-gray-100 pt-6">
                        <button type="button"
                            class="rounded-lg px-4 py-2.5 text-sm font-semibold text-gray-600 transition-colors hover:bg-gray-100">
                            <a href="{{ route('categories.index') }}">Batal</a>
                        </button>
                        <button type="submit"
                            class="rounded-lg bg-teal-600 px-6 py-2.5 text-sm font-semibold text-white shadow-md transition-all hover:bg-teal-700 focus:ring-2 focus:ring-teal-500/40 active:scale-95">
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
