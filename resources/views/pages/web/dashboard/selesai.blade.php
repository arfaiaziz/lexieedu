<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Quiz App</title>
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <style>
            .bg-button{
                background: #30CAEE;
            }
            .bg-button:hover{
                background: #3099fb;
            }
        </style>
    </head>
    <body class="bg-white font-sans min-h-screen flex flex-col">

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
                <a href="{{url('/')}}" class="hover:text-blue-600">Home</a>
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
                    <a href="{{url('/')}}" class="hover:text-blue-600">Home</a>
                </li>
            </ul>
        </nav>

        <main class="flex-grow">
            <section class="bg-white shadow-lg rounded-3xl mx-6 mt-6 p-8 md:p-10 max-w-2xl mx-auto flex flex-col gap-6 items-center border border-blue-100">
                <div class="text-center">
                    <div class="text-blue-800 text-xl md:text-2xl font-bold mb-2">
                        ID Peserta: [{{$id}}]
                    </div>
                    <div class="text-gray-700 text-lg md:text-xl">
                        Skor Kamu: <span class="font-semibold">{{ round($persentase, 2) }}%</span>
                    </div>
                    <div class="text-green-700 text-lg md:text-xl font-medium mt-1">
                        Level: <span class="font-semibold">{{$peserta->level}}</span>
                    </div>
                </div>

                <a href="https://api.whatsapp.com/send/?phone=6285223449396&text&type=phone_number&app_absent=0" target="_blank" class="inline-block bg-button hover:bg-blue-500 transition-colors duration-300 text-white font-semibold py-3 px-8 rounded-full shadow">
                    Silakan Hubungi Admin
                </a>
            </section>

            <div class="fixed bottom-6 right-6">
                <a href="https://wa.me/6281234567890" target="_blank" aria-label="Chat via WhatsApp">
                    <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp" class="hover:scale-110 transition-transform duration-300">
                </a>
            </div>
        </main>


        @include('layouts.footer-web')


    </body>
</html>
