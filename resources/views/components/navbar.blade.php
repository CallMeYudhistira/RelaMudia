<header class="bg-white shadow-sm" x-data="{ openLogout: false }">
    <div class="max-w-7xl mx-auto h-20 px-6 py-4 flex justify-between items-center">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('favicon.svg') }}" class="w-12 h-12 object-contain" alt="Logo">
            <h1 class="text-2xl font-bold text-teal-600">RelaMudia</h1>
        </div>

        <nav class="hidden md:flex space-x-8 text-sm font-medium">
            @if (isset(auth()->user()->role) && auth()->user()->role == 'admin')
                <x-nav-link class="hover:text-teal-600" href="{{ route('dashboard') }}" :active="request()->is('dashboard*')">Dashboard</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('data') }}" :active="request()->is('data*')">Data</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('transaction.index') }}" :active="request()->is('transaction*')">Transaction</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('report.index') }}" :active="request()->is('report*')">Report</x-nav-link>
            @else
                <x-nav-link class="hover:text-teal-600" href="{{ route('dashboard') }}" :active="request()->is('dashboard*')">Dashboard</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('items.list') }}" :active="request()->is('items*')">Items</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('payment.index') }}" :active="request()->is('payment*')">Payment</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('profile.index') }}" :active="request()->is('profile*')">Profile</x-nav-link>
            @endif
        </nav>

        <div class="flex items-center">
            @guest
                <a href="{{ route('login') }}" class="bg-teal-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-teal-700 transition">Get Started</a>
            @endguest
            @auth
                <button @click="openLogout = true;" class="bg-red-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-red-700 transition">Logout</button>
                @include('components.logout')
            @endauth
        </div>
    </div>
</header>
