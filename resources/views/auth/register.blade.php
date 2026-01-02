<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register | RelaMudia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-figtree bg-gray-50 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white p-8 rounded-xl shadow-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-primary">RelaMudia</h1>
            <p class="text-sm text-gray-500 mt-2">Create a new account</p>
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
                <label class="block text-sm font-medium mb-1">Full Name</label>
                <input type="text" name="name"
                    class="p-2 w-full rounded-lg border-2 border-primary focus:outline-primary-400 focus:ring-primary-600"
                    placeholder="Your name" value="{{ old('name') }}">
                @error('name')
                    <div class="text-red-500 text-sm m-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email"
                    class="p-2 w-full rounded-lg border-2 border-primary focus:outline-primary-400 focus:ring-primary-600"
                    placeholder="you@example.com" value="{{ old('email') }}">
                @error('email')
                    <div class="text-red-500 text-sm m-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Password</label>
                <input type="password" name="password"
                    class="p-2 w-full rounded-lg border-2 border-primary focus:outline-primary-400 focus:ring-primary-600"
                    placeholder="••••••••">
                @error('password')
                    <div class="text-red-500 text-sm m-2">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block text-sm font-medium mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation"
                    class="p-2 w-full rounded-lg border-2 border-primary focus:outline-primary-400 focus:ring-primary-600"
                    placeholder="••••••••">
                @error('password_confirmation')
                    <div class="text-red-500 text-sm m-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit"
                class="w-full bg-primary text-white py-3 rounded-lg font-medium hover:bg-teal-700 transition">
                Sign Up
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-primary font-medium hover:underline">
                Login
            </a>
        </p>
    </div>

</body>

</html>
