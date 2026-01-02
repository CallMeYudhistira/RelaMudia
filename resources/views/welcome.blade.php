<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>RelaMudia | Multimedia Rental Platform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-figtree bg-gray-50 text-gray-800">

    <!-- NAVBAR -->
    <header class="bg-white shadow-sm">
        <div class="max-w-7xl mx-auto h-20 px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-teal-600">RelaMudia</h1>
            <nav class="hidden md:flex space-x-8 text-sm font-medium">
                <a href="#features" class="hover:text-teal-600">Features</a>
                <a href="#categories" class="hover:text-teal-600">Categories</a>
                <a href="#contact" class="hover:text-teal-600">Contact</a>
            </nav>
            <a href="{{ route('login') }}" class="bg-teal-600 text-white px-5 py-2 rounded-lg text-sm hover:bg-teal-700 transition">
                Get Started
            </a>
        </div>
    </header>

    <!-- HERO -->
    <section class="bg-white-500">
        <div class="max-w-7xl h-auto m-auto px-6 text-center py-72">
            <h2 class="text-4xl md:text-5xl font-bold mb-6">
                Rent Multimedia Equipment <br class="hidden md:block"> Easily & Efficiently
            </h2>
            <p class="max-w-2xl mx-auto text-gray-600 mb-10">
                RelaMudia is a modern web-based multimedia rental platform
                that helps you manage, rent, and monitor multimedia equipment effortlessly.
            </p>
        </div>
    </section>
</body>

</html>
