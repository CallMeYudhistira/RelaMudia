<div x-show="openLogout" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 backdrop-blur-sm p-4"
    style="display: none;">

    <div @click.away="openLogout = false" x-show="openLogout" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="w-full max-w-md overflow-hidden rounded-2xl bg-white shadow-2xl text-left">

        <div class="p-12">
            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-red-100 text-red-600">
                <i class="bx bx-error text-3xl"></i>
            </div>

            <div class="mt-4 text-center">
                <h3 class="text-lg font-semibold text-gray-900">LOG OUT</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Apakah Anda yakin ingin <strong>logout</strong>?
                </p>
            </div>
        </div>

        <div class="flex flex-col bg-gray-50 px-6 py-4 sm:flex-row justify-between">
            <form action="{{ route('logout') }}" method="POST" class="w-full m-2">
                @csrf
                <button type="submit"
                    class="w-full rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-700 transition-all active:scale-95">
                    Ya
                </button>
            </form>
            <button @click="openLogout = false" type="button"
                class="w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all m-2">
                Batal
            </button>
        </div>
    </div>
</div>
