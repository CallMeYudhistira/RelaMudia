<header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto h-20 px-6 py-4 flex justify-between items-center">
        <h1 class="text-2xl font-bold text-teal-600">RelaMudia</h1>
        <nav class="hidden md:flex space-x-8 text-sm font-medium">
            @if (isset(auth()->user()->role) && auth()->user()->role == 'admin')
                <x-nav-link class="hover:text-teal-600" href="{{ route('dashboard') }}" :active="request()->is('dashboard*')">Dashboard</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('data') }}" :active="request()->is('data*')">Data</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('transaction') }}" :active="request()->is('transaction*')">Transaction</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('report') }}" :active="request()->is('report*')">Report</x-nav-link>
            @else
                <x-nav-link class="hover:text-teal-600" href="{{ route('dashboard') }}" :active="request()->is('dashboard*')">Dashboard</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('items') }}" :active="request()->is('items*')">Items</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('payment') }}" :active="request()->is('payment*')">Payment</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('profile') }}" :active="request()->is('profile*')">Profile</x-nav-link>
            @endif
        </nav>
        @guest
            <a href="{{ route('login') }}"
                class="bg-teal-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-teal-700 transition">
                Get Started
            </a>
        @endguest
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="bg-red-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-red-700 transition"
                    onclick="return confirm('Yakin Ingin Logout?')">Logout</button>
            </form>
        @endauth
    </div>
</header>
