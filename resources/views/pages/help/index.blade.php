<x-layout>
    <x-slot:title>Pusat Bantuan | RelaMudia</x-slot:title>

    <div class="bg-white min-h-screen pt-28 pb-20">
        <div class="max-w-5xl mx-auto px-6">

            <div class="text-center mb-16">
                <h1 class="text-4xl font-extrabold text-slate-900 mb-4">Ada yang bisa kami bantu?</h1>
                <p class="text-slate-500 max-w-2xl mx-auto">Cari jawaban dari pertanyaan umum atau hubungi tim dukungan kami jika Anda mengalami kendala saat melakukan rental.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

                <div class="lg:col-span-2 space-y-6" x-data="{ activeFaq: null }">
                    <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                        <i class="bx bx-help-circle text-teal-600 text-2xl"></i>
                        Pertanyaan Populer
                    </h3>

                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <button @click="activeFaq = (activeFaq === 1 ? null : 1)"
                                class="w-full px-6 py-5 text-left flex justify-between items-center transition-colors"
                                :class="activeFaq === 1 ? 'bg-teal-50/50' : 'hover:bg-slate-50'">
                            <span class="font-bold text-slate-700">Bagaimana cara memulai rental kamera?</span>
                            <i class="bx bx-chevron-down text-xl transition-transform duration-300" :class="activeFaq === 1 ? 'rotate-180 text-teal-600' : 'text-slate-400'"></i>
                        </button>
                        <div x-show="activeFaq === 1" x-collapse>
                            <div class="px-6 py-5 text-sm text-slate-500 leading-relaxed border-t border-slate-50">
                                Anda cukup memilih item di halaman produk, memasukkannya ke keranjang, dan menentukan durasi rental di halaman checkout. Pastikan akun Anda sudah terverifikasi untuk mempermudah proses pengambilan barang.
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <button @click="activeFaq = (activeFaq === 2 ? null : 2)"
                                class="w-full px-6 py-5 text-left flex justify-between items-center transition-colors"
                                :class="activeFaq === 2 ? 'bg-teal-50/50' : 'hover:bg-slate-50'">
                            <span class="font-bold text-slate-700">Apa saja syarat dokumen untuk menyewa?</span>
                            <i class="bx bx-chevron-down text-xl transition-transform duration-300" :class="activeFaq === 2 ? 'rotate-180 text-teal-600' : 'text-slate-400'"></i>
                        </button>
                        <div x-show="activeFaq === 2" x-collapse>
                            <div class="px-6 py-5 text-sm text-slate-500 leading-relaxed border-t border-slate-50">
                                Penyewa wajib menjaminkan minimal 2 identitas asli (KTP/SIM/Paspor) yang masih berlaku. Informasi lebih detail akan dikirimkan melalui email setelah pembayaran Anda dikonfirmasi.
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <button @click="activeFaq = (activeFaq === 3 ? null : 3)"
                                class="w-full px-6 py-5 text-left flex justify-between items-center transition-colors"
                                :class="activeFaq === 3 ? 'bg-teal-50/50' : 'hover:bg-slate-50'">
                            <span class="font-bold text-slate-700">Apakah bisa membatalkan pesanan?</span>
                            <i class="bx bx-chevron-down text-xl transition-transform duration-300" :class="activeFaq === 3 ? 'rotate-180 text-teal-600' : 'text-slate-400'"></i>
                        </button>
                        <div x-show="activeFaq === 3" x-collapse>
                            <div class="px-6 py-5 text-sm text-slate-500 leading-relaxed border-t border-slate-50">
                                Pembatalan dapat dilakukan maksimal 24 jam sebelum jadwal pengambilan. Dana akan dikembalikan sesuai dengan kebijakan pengembalian dana yang berlaku (dipotong biaya administrasi).
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                        <i class="bx bx-support text-teal-600 text-2xl"></i>
                        Hubungi Kami
                    </h3>

                    <a href="https://wa.me/6281316560366" target="_blank"
                       class="block bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-lg hover:shadow-teal-500/10 hover:-translate-y-1 transition-all group">
                        <div class="w-12 h-12 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center mb-4 group-hover:bg-green-600 group-hover:text-white transition-colors">
                            <i class="bx bxl-whatsapp text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-1">WhatsApp Chat</h4>
                        <p class="text-xs text-slate-400 mb-4">Respon cepat setiap hari (09:00 - 21:00)</p>
                        <span class="text-sm font-bold text-green-600 flex items-center gap-2">
                            Mulai Chat <i class="bx bx-right-arrow-alt text-lg"></i>
                        </span>
                    </a>

                    <a href="mailto:tiray9272@gmail.com"
                       class="block bg-white p-6 rounded-3xl border border-slate-100 shadow-sm hover:shadow-lg hover:shadow-teal-500/10 hover:-translate-y-1 transition-all group">
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center mb-4 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                            <i class="bx bx-envelope text-2xl"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 mb-1">Bantuan Email</h4>
                        <p class="text-xs text-slate-400 mb-4">Untuk pertanyaan teknis atau laporan kendala.</p>
                        <span class="text-sm font-bold text-teal-600 flex items-center gap-2">
                            Kirim Email <i class="bx bx-right-arrow-alt text-lg"></i>
                        </span>
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-layout>
