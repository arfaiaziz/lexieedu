<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lexie Edu</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            .bg-button{
                background: #30CAEE;
            }
            .bg-button:hover{
                background: #3099fb;
            }
        </style>
    </head>
    <body class="bg-white">

        <header class="p-6 flex justify-between items-center bg-white shadow">
            <!-- Logo -->
            <div class="flex items-center space-x-4">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Lexie Edu Logo" class="h-16">
            </div>

            <!-- Navigation Menu -->
            <nav class="hidden md:flex space-x-8 text-gray-700 font-semibold text-lg">
                <!-- <a href="{{url('/')}}" class="hover:text-blue-600">Beranda</a>
                <a href="{{url('mulai-tes')}}" class="hover:text-blue-600">Mulai Tes</a>
                <a href="#testimoni" class="hover:text-blue-600">Kontak</a> -->
                <a href="{{url('login')}}" class="hover:text-blue-600">Login</a>
            </nav>

            <!-- Mobile Menu Button (opsional) -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-700 focus:outline-none">
                    <!-- Icon Hamburger -->
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </header>
        <!-- Mobile Menu (Hidden by default) -->
        <nav id="mobile-menu" class="md:hidden hidden flex-col space-y-4 bg-white p-4 shadow text-gray-700 font-semibold text-lg">
            <ul class="flex flex-col gap-3">
                <!-- <li>
                    <a href="{{url('/')}}" class="hover:text-blue-600">Beranda</a>
                </li>
                <li>
                    <a href="#kursus" class="hover:text-blue-600">Mulai Tes</a>
                </li>
                <li>
                    <a href="#testimoni" class="hover:text-blue-600">Kontak</a>
                </li> -->
                <li>
                    <a href="{{url('login')}}" class="hover:text-blue-600">Login</a>
                </li>
            </ul>
        </nav>

        @yield('content')

        <script>
            const menuBtn = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');

            menuBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        </script>

        @include('layouts.footer-web')

    </body>
</html>
