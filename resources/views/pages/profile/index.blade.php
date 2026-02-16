<x-layout>
    <x-slot:title>Profil Saya | RelaMudia</x-slot:title>

    <div class="bg-slate-50 min-h-screen pt-8 pb-20">
        <div class="max-w-4xl mx-auto px-6">

            <h1 class="text-3xl font-extrabold text-slate-900 mb-2">Pengaturan Akun</h1>
            <p class="text-slate-500 mb-10">Kelola informasi profil dan keamanan akun Anda.</p>

            <div class="space-y-8">

                <section class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center">
                            <i class="bx bx-user text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Informasi Profil</h3>
                            <p class="text-xs text-slate-400">Perbarui nama panggilan dan alamat email Anda.</p>
                        </div>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" class="p-8 space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ auth()->user()->name }}"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Alamat Email</label>
                                <input type="email" name="email" value="{{ auth()->user()->email }}"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-teal-600 text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-teal-700 transition-all shadow-lg shadow-teal-200">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </section>

                <section class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
                    <div class="p-8 border-b border-slate-50 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl bg-red-50 text-red-600 flex items-center justify-center">
                            <i class="bx bx-lock-alt text-2xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-slate-800">Keamanan Akun</h3>
                            <p class="text-xs text-slate-400">Pastikan Anda menggunakan password yang kuat dan unik.</p>
                        </div>
                    </div>

                    <form action="{{ route('profile.password') }}" method="POST" class="p-8 space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Password Saat Ini</label>
                                <input type="password" name="current_password" placeholder="••••••••"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none focus:border-red-500 focus:ring-4 focus:ring-red-500/5 transition-all">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 border-t border-slate-50 pt-6">
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Password Baru</label>
                                    <input type="password" name="new_password" placeholder="••••••••"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all">
                                </div>
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Konfirmasi Password Baru</label>
                                    <input type="password" name="new_password_confirmation" placeholder="••••••••"
                                        class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl outline-none focus:border-teal-500 focus:ring-4 focus:ring-teal-500/5 transition-all">
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end pt-4">
                            <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-bold text-sm hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">
                                Perbarui Password
                            </button>
                        </div>
                    </form>
                </section>

            </div>
        </div>
    </div>
</x-layout>
