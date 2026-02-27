<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar | RelaMudia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> --}}
</head>

<body class="font-figtree bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
        <div class="text-center mb-8">
            <img src="{{ asset('favicon.svg') }}" class="w-100 h-35 object-contain" style="margin: -1rem 0;">
            <h1 class="text-3xl font-bold text-primary">RelaMudia</h1>
            <p class="text-sm text-gray-500 mt-2">Buat akun baru</p>
        </div>

        @error('error')
            <div class="items-center bg-red-400 px-6 py-2.5 sm:px-3.5 rounded-2xl mb-8">
                <p class="text-sm text-white font-medium text-center">
                    ⚠️ {{ $message }}
                </p>
            </div>
        @enderror

        <form method="POST" action="{{ route('registerProcess') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" name="name"
                    class="p-2 m-1 w-full rounded-lg border border-primary focus:outline-primary-400 focus:ring-primary-600"
                    placeholder="Nama Anda" value="{{ old('name') }}">
                @error('name')
                    <div class="text-red-500 text-sm m-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email"
                    class="p-2 m-1 w-full rounded-lg border border-primary focus:outline-primary-400 focus:ring-primary-600"
                    placeholder="anda@contoh.com" value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-500 text-sm m-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Kata Sandi</label>
                <input type="password" name="password"
                    class="p-2 m-1 w-full rounded-lg border border-primary focus:outline-primary-400 focus:ring-primary-600"
                    placeholder="••••••••" autocomplete="off">
                @error('password')
                    <div class="text-red-500 text-sm m-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation"
                    class="p-2 m-1 w-full rounded-lg border border-primary focus:outline-primary-400 focus:ring-primary-600"
                    placeholder="••••••••" autocomplete="off">
                @error('password_confirmation')
                    <div class="text-red-500 text-sm m-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-teal-700 transition">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">
                Masuk
            </a>
        </p>
    </div>

</body>

</html>
