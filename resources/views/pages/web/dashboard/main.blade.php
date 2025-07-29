@extends('layouts.main-web')
@section('content')
    <section class="bg-blue-50 rounded-3xl mx-6 p-10 flex flex-col md:flex-row justify-between items-center">
        <div class="max-w-xl space-y-4">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                Tingkatkan Kemampuan Bahasa Inggrismu dengan Lexie Edu!
            </h1>
            <p class="text-gray-600 text-lg">
                Pelajari bahasa Inggris dengan cara yang menyenangkan dan interaktif melalui kursus online terbaik kami. Tersedia berbagai materi untuk pemula hingga tingkat mahir!
            </p>
            <p>
                <!-- <a href="{{url('mulai-tes')}}" class="p-2 px-4 bg-button mt-2 rounded-md text-white">Mulai Test</a> -->
            </p>
        </div>
        <div class="relative mt-10 md:mt-0">
            <img src="{{asset('assets/img/Woman-Standing.png')}}" alt="Student Writing" class="relative z-10 " style="width:35rem;">
        </div>
    </section>


    <section class="border-2 border-blue-800 flex flex-col md:flex-row justify-between items-start md:items-center mx-6 p-10 mt-6 gap-6">
        <div class="w-full md:w-2/3 flex flex-col gap-4">
            <div class="flex flex-row gap-2 items-center text-blue-800">
                <i class="fas fa-lightbulb text-yellow-400 text-xl"></i>
                <div class="font-semibold text-lg">
                    Tips Struktur Tes:
                </div>
            </div>
            <ul class="list-disc list-inside space-y-2 text-gray-700 text-sm">
                <li>
                    Jumlah Soal: Terdapat total 60 soal dalam tes ini.
                </li>
                <li>
                    Pembagian Tingkat: Tes ini dibagi menjadi tiga bagian, masing-masing mewakili tingkat kemahiran CEFR yang berbeda:
                    <ul class="list-disc list-inside ml-4 space-y-1">
                        <li>Soal 1-20: Tingkat A1-A2 (Dasar)</li>
                        <li>Soal 21-40: Tingkat B1-B2 (Menengah)</li>
                        <li>Soal 41-60: Tingkat C1-C2 (Mahir)</li>
                    </ul>
                </li>
                <li>
                    Jumlah Soal per Tingkat: Setiap tingkat kemahiran (A1-A2, B1-B2, C1-C2) memiliki 20 soal.
                </li>
                <li>
                    Jenis Soal: Pilihan Tunggal (Single Choice): Peserta memilih satu jawaban yang paling benar dari beberapa pilihan yang diberikan.
                </li>
            </ul>
        </div>
        <div class="flex-shrink-0">
            <a href="{{url('mulai-tes')}}" class="p-2 px-4 bg-button hover:bg-blue-500 mt-2 rounded-md text-white">Mulai Tes</a>
        </div>
    </section>

    <div class="fixed bottom-6 right-6">
        <a href="https://wa.me/6285223449396" target="_blank">
        <img src="https://img.icons8.com/color/48/000000/whatsapp--v1.png" alt="WhatsApp">
        </a>
    </div>
@endsection
