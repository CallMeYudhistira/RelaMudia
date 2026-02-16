<header x-data="{
    scrolled: false,
    isAdminPage: {{ request()->is('admin*') ? 'true' : 'false' }}
}" x-init="window.onscroll = () => { scrolled = window.pageYOffset > 20 }"
    :class="isAdminPage ? 'bg-white border-b border-gray-100 shadow-sm' : (scrolled ?
        'bg-white/70 backdrop-blur-lg border-b border-teal-50 shadow-sm' : 'bg-transparent')"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto h-20 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('image/icon.png') }}" class="w-12 h-12 object-contain" alt="Logo">
            <h1 class="text-2xl font-bold tracking-tight"
                :class="(scrolled || isAdminPage) ? 'text-teal-600' : 'text-teal-500'">
                RelaMudia
            </h1>
        </div>

        <nav class="hidden md:flex space-x-8 text-sm font-medium">
            @php $isAdmin = isset(auth()->user()->role) && auth()->user()->role == 'admin'; @endphp
            @if ($isAdmin)
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('dashboard.admin') }}"
                    :active="request()->is('admin/dashboard*')">Dashboard</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('data') }}"
                    :active="request()->is('admin/data*')">Data</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('transaction.index') }}"
                    :active="request()->is('admin/transaction*')">Transaction</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('report.index') }}"
                    :active="request()->is('admin/report*')">Report</x-nav-link>
            @else
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('dashboard.user') }}"
                    :active="request()->is('dashboard*')">Dashboard</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('items.list') }}"
                    :active="request()->is('items*')">Items</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('payment.index') }}"
                    :active="request()->is('payment*')">Payment</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('help.index') }}"
                    :active="request()->is('help*')">Help</x-nav-link>
            @endif
        </nav>

        <div class="flex items-center space-x-4">
            @auth
                <div class="relative" x-data="{ openMenu: false }" @click.away="openMenu = false">
                    <button @click="openMenu = !openMenu"
                        class="flex items-center space-x-2 p-1 pr-3 rounded-full border transition-all border-gray-200 hover:border-teal-200 bg-gray-50">
                        <div class="w-8 h-8 rounded-full bg-teal-600 flex items-center justify-center text-white font-bold text-xs"
                            style="text-transform: capitalize;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <i class="bx bx-chevron-down transition-transform duration-300"
                            :class="openMenu ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="openMenu" x-transition
                        class="absolute right-0 mt-3 w-56 bg-white rounded-2xl shadow-xl border border-teal-50 overflow-hidden py-2"
                        style="display: none;">
                        <div class="px-4 py-3 border-b border-gray-50 mb-1">
                            <p class="text-[10px] uppercase tracking-widest text-slate-400 font-semibold">User Info</p>
                            <p class="text-sm font-bold text-slate-800 truncate" style="text-transform: capitalize;">
                                {{ auth()->user()->name }}</p>
                        </div>
                        <a href="{{ route('profile.index') }}"
                            class="flex items-center space-x-3 px-4 py-3 text-sm text-slate-600 hover:bg-teal-50 hover:text-teal-600 transition-colors {{ request()->is('profile*') ? 'bg-teal-100' : '' }}">
                            <i class="bx bx-user text-lg"></i>
                            <span>Profil Saya</span>
                        </a>
                        <a href="{{ route('carts.index') }}"
                            class="flex items-center space-x-3 px-4 py-3 text-sm text-slate-600 hover:bg-teal-50 hover:text-teal-600 transition-colors {{ request()->is('carts*') ? 'bg-teal-100' : '' }}">
                            <i class="bx bx-shopping-bag text-lg"></i>
                            <span>Pesanan Saya</span>

                            {{-- Logika Badge --}}
                            @php
                                // Ganti 'carts' sesuai dengan nama relasi di Model User kamu
                                $cartCount = auth()->user()->carts()->count();
                            @endphp

                            @if ($cartCount > 0)
                                <span
                                    style="background-color: #ee3232; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 10px;"
                                    class="ms-auto font-bold">
                                    {{ $cartCount > 9 ? '9+' : $cartCount }}
                                </span>
                            @endif
                        </a>
                        <hr class="my-1 border-gray-50">
                        <button @click="openLogout = true; openMenu = false;"
                            class="w-full flex items-center space-x-3 px-4 py-3 text-sm text-red-500 hover:bg-red-50 transition-colors">
                            <i class="bx bx-log-out text-lg"></i>
                            <span>Keluar</span>
                        </button>
                    </div>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}"
                    class="bg-teal-600 text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-teal-700 transition">Get
                    Started</a>
            @endguest
        </div>
    </div>
</header>

<div class="h-20"></div>
