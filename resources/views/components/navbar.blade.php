<header
    x-data="{
        scrolled: false,
        openLogout: false,
        isAdminPage: {{ request()->is('admin*') ? 'true' : 'false' }}
    }"
    x-init="window.onscroll = () => { scrolled = window.pageYOffset > 20 }"
    /* Jika halaman admin, paksa bg-white. Jika bukan, gunakan efek transparan-blur */
    :class="isAdminPage ? 'bg-white border-b border-gray-100 shadow-sm' : (scrolled ? 'bg-white/70 backdrop-blur-lg border-b border-teal-50 shadow-sm' : 'bg-transparent')"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto h-20 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('image/icon.png') }}" class="w-12 h-12 object-contain" alt="Logo">
            <h1 class="text-2xl font-bold tracking-tight"
                :class="(scrolled || isAdminPage) ? 'text-teal-600' : 'text-teal-500'">
                RelaMudia
            </h1>
        </div>

        <nav class="hidden md:flex space-x-8 text-sm font-medium">
            @php
                $isAdmin = isset(auth()->user()->role) && auth()->user()->role == 'admin';
            @endphp

            @if ($isAdmin)
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('dashboard.admin') }}" :active="request()->is('admin/dashboard*')">Dashboard</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('data') }}" :active="request()->is('admin/data*')">Data</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('transaction.index') }}" :active="request()->is('admin/transaction*')">Transaction</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('report.index') }}" :active="request()->is('admin/report*')">Report</x-nav-link>
            @else
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('dashboard.user') }}" :active="request()->is('dashboard.user*')">Dashboard</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('items.list') }}" :active="request()->is('items*')">Items</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('payment.index') }}" :active="request()->is('payment*')">Payment</x-nav-link>
                <x-nav-link class="hover:text-teal-600 transition-colors" href="{{ route('profile.index') }}" :active="request()->is('profile*')">Profile</x-nav-link>
            @endif
        </nav>

        <div class="flex items-center">
            @guest
                <a href="{{ route('login') }}"
                   class="bg-teal-600 text-white px-6 py-2.5 rounded-full text-sm font-semibold hover:bg-teal-700 transition shadow-lg shadow-teal-200/50">
                   Get Started
                </a>
            @endguest
            @auth
                <button @click="openLogout = true;"
                        class="bg-red-50 text-red-600 border border-red-100 px-5 py-2 rounded-full text-sm font-medium hover:bg-red-600 hover:text-white transition-all duration-300">
                    Logout
                </button>
                @include('components.logout')
            @endauth
        </div>
    </div>
</header>

<div class="h-20"></div>
