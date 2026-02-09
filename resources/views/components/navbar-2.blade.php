<header class="bg-gray-50 shadow-sm border-t-2 border-t-gray-200">
    <div class="max-w-7xl mx-auto h-20 px-6 py-4 flex justify-between items-center">
        <nav class="hidden md:flex space-x-8 text-sm font-medium">
                <x-nav-link class="hover:text-teal-600" href="{{ route('users.index') }}" :active="request()->is('admin/data/users*')">Users</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('categories.index') }}" :active="request()->is('admin/data/categories*')">Categories</x-nav-link>
                <x-nav-link class="hover:text-teal-600" href="{{ route('items.index') }}" :active="request()->is('admin/data/items*')">Items</x-nav-link>
        </nav>
    </div>
</header>
