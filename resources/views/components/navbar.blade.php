<header x-data="{
    scrolled: false,
    isAdminPage: {{ request()->is('admin*') ? 'true' : 'false' }},
    mobileMenuOpen: false
}" x-init="window.onscroll = () => { scrolled = window.pageYOffset > 20 }"
    :class="isAdminPage ? 'bg-white border-b border-gray-100 shadow-sm' : (scrolled ?
        'bg-white/70 backdrop-blur-lg border-b border-teal-50 shadow-sm' : 'bg-transparent')"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto h-20 px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <img src="{{ asset('image/icon.png') }}" class="w-12 h-12 object-contain" alt="Logo">
            <h1 class="text-2xl font-bold tracking-tight"
                :class="(scrolled || isAdminPage) ? 'text-teal-600' : 'text-teal-500'">
                RelaMudia
            </h1>
        </div>

        <!-- Desktop Navigation -->
        <nav class="hidden md:flex space-x-8 text-sm font-medium">
            @php $isAdmin = isset(auth()->user()->role) && auth()->user()->role == 'admin'; @endphp
            @if ($isAdmin)
                <x-nav-link href="{{ route('dashboard.admin') }}" :active="request()->is('admin/dashboard*')">Dashboard</x-nav-link>
                <x-nav-link href="{{ route('data') }}" :active="request()->is('admin/data*')">Data</x-nav-link>
                <x-nav-link href="{{ route('transaction.index') }}" :active="request()->is('admin/transaction*')">Transaction</x-nav-link>
                <x-nav-link href="{{ route('report.index') }}" :active="request()->is('admin/report*')">Report</x-nav-link>
            @else
                <x-nav-link href="{{ route('dashboard.user') }}" :active="request()->is('dashboard*')">Dashboard</x-nav-link>
                <x-nav-link href="{{ route('items.list') }}" :active="request()->is('items*')">Items</x-nav-link>
                <x-nav-link href="{{ route('payment.index') }}" :active="request()->is('payment*')">Payment</x-nav-link>
                <x-nav-link href="{{ route('help.index') }}" :active="request()->is('help*')">Help</x-nav-link>
            @endif
        </nav>

        <!-- Right Side: User Menu & Mobile Toggle -->
        <div class="flex items-center space-x-4">
            @auth
                <div class="relative hidden sm:block" x-data="{ openMenu: false }" @click.away="openMenu = false">
                    <button @click="openMenu = !openMenu"
                        class="flex items-center space-x-2 p-1 pr-3 rounded-full border transition-all border-gray-200 hover:border-teal-200 bg-gray-50">
                        <div class="w-8 h-8 rounded-full bg-teal-600 flex items-center justify-center text-white font-bold text-xs"
                            style="text-transform: capitalize;">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <i class="bx bx-chevron-down transition-transform duration-300"
                            :class="openMenu ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="openMenu" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
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

                            @php
                                $cartCount = auth()->user()->carts()->count();
                            @endphp

                            @if ($cartCount > 0)
                                <span
                                    class="ms-auto bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-[10px] font-bold">
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
                    class="hidden sm:block bg-teal-600 text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-teal-700 transition">Get
                    Started</a>
            @endguest

            <!-- Mobile Menu Toggle Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-2xl text-slate-600 p-2 rounded-lg hover:bg-gray-100 transition-colors">
                <i class="bx" :class="mobileMenuOpen ? 'bx-x' : 'bx-menu'"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation Drawer -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 -translate-y-4" 
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="md:hidden bg-white border-t border-gray-100 shadow-xl max-h-[80vh] overflow-y-auto" 
         style="display: none;">
        <div class="px-6 py-4 space-y-2">
            @if ($isAdmin)
                <x-nav-link :mobile="true" href="{{ route('dashboard.admin') }}" :active="request()->is('admin/dashboard*')">Dashboard</x-nav-link>
                <x-nav-link :mobile="true" href="{{ route('data') }}" :active="request()->is('admin/data*')">Data</x-nav-link>
                <x-nav-link :mobile="true" href="{{ route('transaction.index') }}" :active="request()->is('admin/transaction*')">Transaction</x-nav-link>
                <x-nav-link :mobile="true" href="{{ route('report.index') }}" :active="request()->is('admin/report*')">Report</x-nav-link>
            @else
                <x-nav-link :mobile="true" href="{{ route('dashboard.user') }}" :active="request()->is('dashboard*')">Dashboard</x-nav-link>
                <x-nav-link :mobile="true" href="{{ route('items.list') }}" :active="request()->is('items*')">Items</x-nav-link>
                <x-nav-link :mobile="true" href="{{ route('payment.index') }}" :active="request()->is('payment*')">Payment</x-nav-link>
                <x-nav-link :mobile="true" href="{{ route('help.index') }}" :active="request()->is('help*')">Help</x-nav-link>
            @endif

            <hr class="my-4 border-gray-50">

            @auth
                <div class="flex items-center space-x-3 px-4 py-3 mb-2 bg-gray-50 rounded-xl">
                    <div class="w-10 h-10 rounded-full bg-teal-600 flex items-center justify-center text-white font-bold" style="text-transform: capitalize;">
                        {{ substr(auth()->user()->name, 0, 1) }}
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-800" style="text-transform: capitalize;">{{ auth()->user()->name }}</p>
                        <p class="text-xs text-slate-500">{{ auth()->user()->email }}</p>
                    </div>
                </div>
                <a href="{{ route('profile.index') }}" class="block px-4 py-3 text-base text-slate-600 hover:text-teal-600 transition-colors">
                    <i class="bx bx-user me-2"></i> Profil Saya
                </a>
                <a href="{{ route('carts.index') }}" class="flex items-center px-4 py-3 text-base text-slate-600 hover:text-teal-600 transition-colors">
                    <i class="bx bx-shopping-bag me-2"></i> Pesanan Saya
                    @if ($cartCount > 0)
                        <span class="ms-auto bg-red-500 text-white rounded-full px-2 py-0.5 text-[10px] font-bold">
                            {{ $cartCount > 9 ? '9+' : $cartCount }}
                        </span>
                    @endif
                </a>
                <button @click="openLogout = true; mobileMenuOpen = false;" class="w-full text-left px-4 py-3 text-base text-red-500 hover:bg-red-50 transition-colors rounded-xl mt-2">
                    <i class="bx bx-log-out me-2"></i> Keluar
                </button>
            @else
                <a href="{{ route('login') }}" class="block w-full text-center bg-teal-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-teal-700 transition">Get Started</a>
            @endauth
        </div>
    </div>
</header>

<div class="h-20"></div>
