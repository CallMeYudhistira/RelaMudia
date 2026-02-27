<x-layout>
    <x-slot:title>{{ $item->name }} | RelaMudia</x-slot:title>

    <div class="bg-white min-h-screen">
        <div class="flex flex-col lg:flex-row min-h-[calc(100vh-80px)]">

            <div class="lg:w-7/12 bg-[#F6F6F6] flex items-center justify-center p-8 lg:p-20 relative rounded-r-2xl">
                <nav class="absolute top-3 left-8 text-[10px] uppercase tracking-[0.2em] text-slate-400">
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

                <form action="{{ route('carts.store') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <input type="hidden" name="multimedia_item_id" value="{{ $item->id }}">
                        <button type="submit"
                                class="w-full bg-slate-900 text-white py-5 uppercase rounded-2xl font-bold text-sm tracking-[0.2em] hover:bg-teal-600 transition-all duration-300 shadow-xl shadow-slate-200">
                            Masukan Keranjang
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-layout>
