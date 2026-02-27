<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="{{ config('midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>

<body class="bg-gray-50 text-gray-800" x-data="{ openLogout: false }">
    <x-navbar />

    @include('components.logout')

    @if (request()->is('admin/data*'))
        <x-navbar-2 />
    @endif
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-transition class="fixed top-4 right-4 z-50">
            <div class="flex items-center gap-3 rounded-lg bg-green-600 px-4 py-3 text-white shadow-lg">
                <i class="bx bx-check-circle text-xl"></i>
                <span class="text-sm font-medium">{{ session('success') }}</span>
                <button @click="show = false" class="hover:bg-green-700 rounded-full transition mt-1">
                    <i class="bx bx-x text-xl"></i>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-transition class="fixed top-4 right-4 z-50">
            <div class="rounded-lg bg-red-600 px-4 py-3 text-white shadow-lg max-w-md">
                <div class="flex items-start gap-3">
                    <i class="bx bx-error-circle text-xl mt-0.5"></i>
                    <div class="text-sm flex-1">
                        {{ session('error') }}
                    </div>
                    <button @click="show = false" class="hover:bg-red-700 rounded-full transition mt-1">
                        <i class="bx bx-x text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div x-data="{ show: true }" x-show="show" x-transition class="fixed top-4 right-4 z-50">
            <div class="rounded-lg bg-red-600 px-4 py-3 text-white shadow-lg max-w-md">
                <div class="flex items-start gap-3">
                    <i class="bx bx-error-circle text-xl mt-0.5"></i>
                    <div class="text-sm flex-1">
                        <ul class="list-disc pl-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button @click="show = false" class="hover:bg-red-700 rounded-full transition mt-1">
                        <i class="bx bx-x text-xl"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{ $slot }}

    @if (!request()->is('admin*'))
        <x-footer />
    @endif
</body>

</html>
