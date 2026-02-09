<x-layout>
    <x-slot name="title">RelaMudia | Multimedia Rental Platform</x-slot>
    <div class="bg-white min-h-screen">

        <div class="relative h-[70vh] w-full overflow-hidden bg-teal-50/30">
            <div class="absolute inset-0 h-full w-full overflow-hidden">
                <img src="{{ asset('image/tile.png') }}" class="absolute inset-0 h-full w-full object-cover opacity-10"
                    alt="Multimedia Gear">

                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-white/50 to-white"></div>

                <div class="absolute inset-0 bg-gradient-to-r from-white via-white/20 to-transparent"></div>
            </div>

            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/40 to-transparent"></div>

            <div class="relative flex h-full items-center px-8 md:px-16 max-w-7xl mx-auto">
                <div class="max-w-xl">
                    <span
                        class="inline-block px-4 py-1.5 mb-6 text-xs font-bold tracking-widest uppercase bg-teal-100 text-teal-700 rounded-full">
                        New Arrival
                    </span>
                    <h1 class="text-5xl md:text-7xl font-light tracking-tighter mb-6 text-slate-800">
                        Capture the <br><span class="font-bold text-teal-600">Perfect Moment.</span>
                    </h1>
                    <p class="text-lg text-slate-500 mb-8 font-light leading-relaxed">
                        Sewa perangkat kamera dan lighting profesional untuk kebutuhan produksi konten Anda dengan harga
                        terbaik.
                    </p>
                    <div class="flex gap-4">
                        <a href="#explore"
                            class="bg-teal-600 hover:bg-teal-700 text-white px-8 py-4 rounded-full transition-all duration-300 font-semibold shadow-lg shadow-teal-200">
                            Explore Gear
                        </a>
                        <a href="#"
                            class="bg-white border border-teal-200 text-teal-600 px-8 py-4 rounded-full hover:bg-teal-50 transition-all duration-300 font-semibold">
                            Our Service
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div id="explore" class="max-w-7xl mx-auto px-8 py-20">
            <div class="flex items-end justify-between mb-12 border-b border-teal-50 pb-6">
                <div>
                    <h2 class="text-3xl font-bold text-slate-800 tracking-tight">Koleksi Terpopuler</h2>
                    <p class="text-slate-400 mt-2">Peralatan multimedia terbaik untuk hasil maksimal.</p>
                </div>
                <div class="flex gap-6 text-sm font-semibold uppercase tracking-widest">
                    <a href="#" class="text-teal-600 border-b-2 border-teal-600 pb-1">Semua</a>
                    @foreach ($categories as $category)
                        <a href="{{ $category->id }}"
                            class="text-slate-400 hover:text-teal-500 transition-all">{{ $category->name }}</a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach ($items as $item)
                    <div class="group cursor-pointer">
                        <div
                            class="relative aspect-[4/5] overflow-hidden bg-teal-50/50 rounded-3xl border border-teal-100 mb-5 transition-all duration-500 group-hover:shadow-xl group-hover:shadow-teal-600/5 group-hover:-translate-y-1">
                            <img src="{{ $item->image }}"
                                class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-105"
                                alt="{{ $item->name }}">

                            <button
                                class="absolute bottom-6 left-1/2 -translate-x-1/2 translate-y-12 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 bg-teal-600 text-white font-bold px-8 py-3 rounded-full shadow-xl">
                                Sewa Sekarang
                            </button>
                        </div>

                        <div class="flex justify-between items-start px-2">
                            <div>
                                <h3
                                    class="font-bold text-slate-800 text-lg group-hover:text-teal-600 transition-colors">
                                    {{ $item->name }}
                                </h3>
                                <p class="text-sm text-slate-400 truncate max-w-[180px]">{{ $item->description }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-slate-400 font-medium">Mulai dari</p>
                                <span class="text-teal-600 font-extrabold text-lg leading-none">
                                    Rp{{ number_format($item->price_per_day, 0, ',', '.') }}
                                    <span class="text-[10px] font-normal text-slate-400">/hari</span>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div
                class="mt-24 p-12 bg-teal-50/50 rounded-[40px] flex flex-col md:flex-row items-center justify-between border border-teal-100 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-40 h-40 bg-teal-100/50 rounded-full blur-3xl"></div>

                <div class="mb-6 md:mb-0 relative z-10">
                    <h4 class="text-2xl font-bold text-slate-800">Butuh bantuan memilih alat?</h4>
                    <p class="text-slate-500 mt-1">Tim ahli kami siap membantu mencarikan gear yang sesuai kebutuhan
                        Anda.</p>
                </div>
                <a href="#"
                    class="relative z-10 inline-flex items-center gap-2 bg-white border-2 border-teal-600 text-teal-600 px-10 py-4 rounded-full font-bold hover:bg-teal-600 hover:text-white transition-all duration-300 group shadow-lg shadow-teal-100">
                    Hubungi CS
                    <i class="bx bx-right-arrow-alt text-xl group-hover:translate-x-2 transition-transform"></i>
                </a>
            </div>
        </div>
    </div>
</x-layout>
