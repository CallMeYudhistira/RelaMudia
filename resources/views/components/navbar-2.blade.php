<header class="bg-gray-50 shadow-sm border-t-2 border-t-gray-200">
    <div class="max-w-7xl mx-auto px-6">
        <nav class="flex space-x-8 h-16 items-center overflow-x-auto no-scrollbar whitespace-nowrap">
            <x-nav-link href="{{ route('users.index') }}" :active="request()->is('admin/data/users*')">Users</x-nav-link>
            <x-nav-link href="{{ route('categories.index') }}" :active="request()->is('admin/data/categories*')">Categories</x-nav-link>
            <x-nav-link href="{{ route('items.index') }}" :active="request()->is('admin/data/items*')">Items</x-nav-link>
        </nav>
    </div>
</header>
