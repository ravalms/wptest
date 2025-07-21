{{--
  Template Name: Custom Page
--}}

@extends('layouts.app')

@section('content')
  <section class="container w-full mx-auto">
    <!-- Header -->
    <header class="w-full px-6 py-4 flex items-center justify-between shadow-sm">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <img src="/logo.svg" alt="tms buddies" class="h-8 w-auto">
        </div>

        <!-- Navigation -->
        <nav class="hidden md:flex space-x-6 text-sm text-gray-900 font-medium">
            <div class="relative group">
                <button class="flex items-center space-x-1">
                    <span>Angebot</span>
                    <svg class="w-4 h-4 transform group-hover:rotate-180 transition" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <!-- Dropdown -->
                <div class="absolute hidden group-hover:block bg-white border mt-2 p-2 rounded shadow-lg">
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Option 1</a>
                    <a href="#" class="block px-4 py-2 text-sm hover:bg-gray-100">Option 2</a>
                </div>
            </div>
            <a href="#" class="hover:text-orange-500">Der TMS</a>
            <a href="#" class="hover:text-orange-500">Team</a>
            <a href="#" class="hover:text-orange-500">Webinare</a>
            <a href="#" class="hover:text-orange-500">Blog</a>
            <a href="#" class="hover:text-orange-500">FAQ</a>
            <a href="#" class="hover:text-orange-500">Kontakt</a>
        </nav>

        <!-- Right Side Buttons -->
        <div class="flex items-center space-x-4">
            <a href="#" class="px-4 py-2 border border-gray-900 text-sm font-semibold rounded-full hover:bg-gray-100">
                Anmelden
            </a>
            <button>
                <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M3 3h2l.4 2M7 13h14l-1.35 6.45a1 1 0 01-.98.8H7.4a1 1 0 01-.98-.8L5 6H3" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
        </div>
    </header>
</section>

@endsection
