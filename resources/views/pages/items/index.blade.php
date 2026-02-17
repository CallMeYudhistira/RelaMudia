<x-layout>
    <x-slot:title>Katalog Alat | RelaMudia</x-slot:title>

    <div class="bg-white min-h-screen pt-24 pb-20">
        <div class="max-w-7xl mx-auto px-8">

            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-12">
                <div>
                    <h1 class="text-4xl font-bold text-slate-800 tracking-tight">Katalog <span
                            class="text-teal-600">Alat</span></h1>
                    <p class="text-slate-500 mt-2">Temukan perangkat terbaik untuk produksi visual Anda.</p>
                </div>

                <form action="{{ route('items.list') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-4 w-full md:w-auto" id="formFilter">
                    <div class="relative group">
                        <i
                            class="bx bx-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-teal-600 transition-colors text-xl"></i>
                        <input type="text" placeholder="Cari kamera, lensa..." name="search"
                            value="{{ $search ?? '' }}" oninput="submitForm();"
                            class="w-full sm:w-72 pl-12 pr-4 py-3 bg-teal-50/30 border border-teal-100 rounded-2xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all text-slate-700">
                    </div>

                    <div class="relative">
                        <select
                            class="appearance-none w-full sm:w-52 px-5 py-3 bg-teal-50/30 border border-teal-100 rounded-2xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all text-slate-700 font-medium cursor-pointer"
                            name="category_id" onchange="submitForm();">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}</option>
                            @endforeach
                        </select>
                        <i
                            class="bx bx-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xl"></i>
                    </div>
                </form>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse ($items as $item)
                    <div class="group cursor-pointer">
                        <a href="{{ route('items.detail', $item->id) }}">
                            <div
                                class="relative aspect-[4/5] overflow-hidden bg-teal-50/50 rounded-3xl border border-teal-100 mb-5 transition-all duration-500 group-hover:shadow-xl group-hover:shadow-teal-600/5 group-hover:-translate-y-1">
                                <img src="{{ $item->image }}"
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="{{ $item->name }}">

                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-teal-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                </div>
                            </div>

                            <div class="flex justify-between items-start px-2">
                                <div class="max-w-[65%]">
                                    <h3
                                        class="font-medium text-slate-800 text-lg group-hover:text-teal-600 transition-colors leading-tight mb-1">
                                        {{ $item->name }}
                                    </h3>
                                    <div class="flex items-center gap-1.5">
                                        <p class="text-sm text-slate-400 truncate max-w-[150px]">
                                            {{ $item->description }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tighter">Per
                                        Hari
                                    </p>
                                    <span class="text-teal-600 font-medium text-lg leading-none">
                                        Rp{{ number_format($item->price_per_day, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <i class="bx bx-package text-6xl text-teal-100 mb-4"></i>
                        <h3 class="text-xl font-bold text-slate-800">Barang tidak ditemukan</h3>
                        <p class="text-slate-500">Coba gunakan kata kunci lain atau pilih kategori berbeda.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        const formFilter = document.getElementById('formFilter');

        function submitForm() {
            formFilter.submit();
        }
    </script>
</x-layout>
