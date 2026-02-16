<div x-show="openLogout"
    class="fixed inset-0 z-[100] flex items-center justify-center p-4"
    style="display: none;"
    x-cloak>

    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" @click="openLogout = false"></div>

    <div x-show="openLogout"
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        class="relative w-full max-w-sm overflow-hidden rounded-3xl bg-white shadow-2xl text-center">

        <div class="p-10">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-50 text-red-600 mb-4">
                <i class="bx bx-power-off text-3xl"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-900">Akhiri Sesi?</h3>
            <p class="mt-2 text-sm text-gray-500">
                Anda perlu login kembali untuk melakukan transaksi selanjutnya.
            </p>
        </div>

        <div class="flex border-t border-gray-100">
            <button @click="openLogout = false" class="flex-1 px-6 py-4 text-sm font-bold text-gray-500 hover:bg-gray-50 transition-colors border-r border-gray-100">
                Batal
            </button>
            <form action="{{ route('logout') }}" method="POST" class="flex-1">
                @csrf
                <button type="submit" class="w-full h-full px-6 py-4 text-sm font-bold text-red-600 hover:bg-red-50 transition-colors">
                    Ya, Keluar
                </button>
            </form>
        </div>
    </div>
</div>
