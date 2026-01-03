<x-layout>
    <x-slot name="title">RelaMudia | Multimedia Rental Platform</x-slot>
    @guest
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
    @endguest
    @auth
        @if (auth()->user()->role == 'admin')
            <h1 class="text-center mt-20">Ini Dashboard Admin</h1>
        @else
            <h1 class="text-center mt-20">Ini Dashboard User</h1>
        @endif
    @endauth
</x-layout>
