@extends('layouts.mainapp')

@section('content')
<main class="flex-1 p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">

        <!-- Card: Total Pengguna -->
        <div class="bg-white p-5 shadow rounded-xl border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center space-x-2">
                <div class="bg-blue-100 text-blue-600 rounded-full p-3 shadow-inner">
                    <iconify-icon icon="mdi:account-multiple" width="24" height="24"></iconify-icon>
                </div>
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Total Pengguna</h2>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Total Peserta -->
        <div class="bg-white p-5 shadow rounded-xl border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center space-x-2">
                <div class="bg-green-100 text-green-600 rounded-full p-3 shadow-inner">
                    <iconify-icon icon="mdi:account-school" width="24" height="24"></iconify-icon>
                </div>
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Total Peserta</h2>
                    <p class="text-3xl font-bold text-green-600">{{ $totalPeserta }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Total Transaksi -->
        <div class="bg-white p-5 shadow rounded-xl border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center space-x-2">
                <div class="bg-purple-100 text-purple-600 rounded-full p-3 shadow-inner">
                    <iconify-icon icon="mdi:credit-card-outline" width="24" height="24"></iconify-icon>
                </div>
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Total Transaksi</h2>
                    <p class="text-3xl font-bold text-purple-600">{{ $totalTransaksi }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Total Instansi -->
        <div class="bg-white p-5 shadow rounded-xl border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center space-x-2">
                <div class="bg-yellow-100 text-yellow-600 rounded-full p-3 shadow-inner">
                    <iconify-icon icon="mdi:office-building" width="24" height="24"></iconify-icon>
                </div>
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Total Instansi</h2>
                    <p class="text-3xl font-bold text-yellow-600">{{ $totalInstansi }}</p>
                </div>
            </div>
        </div>

        <!-- Card: Total Soal -->
        <div class="bg-white p-5 shadow rounded-xl border border-gray-100 hover:shadow-lg transition">
            <div class="flex items-center space-x-2">
                <div class="bg-red-100 text-red-600 rounded-full p-3 shadow-inner">
                    <iconify-icon icon="mdi:file-document-edit-outline" width="24" height="24"></iconify-icon>
                </div>
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Total Soal</h2>
                    <p class="text-3xl font-bold text-red-600">{{ $totalSoal }}</p>
                </div>
            </div>
        </div>
    </div>


    <!-- <div class="grid grid-cols-2 gap-3"> -->
        <div class="bg-white mt-8 p-6 shadow rounded-lg">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Grafik Transaksi Tahunan</h2>
            <canvas id="transaksiChart" height="100"></canvas>
        </div>

        <div class="bg-white mt-8 p-6 shadow rounded-lg">
            <h2 class="text-lg font-bold text-gray-700 mb-4">Grafik Peserta per Instansi</h2>
            <canvas id="pesertaChart" height="100"></canvas>
        </div>
    <!-- </div> -->


</main>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Grafik Transaksi
        const transaksiCtx = document.getElementById('transaksiChart').getContext('2d');
        new Chart(transaksiCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: {!! json_encode($dataBulanan) !!},
                    fill: false,
                    borderColor: 'rgba(59, 130, 246, 1)',
                    backgroundColor: 'rgba(59, 130, 246, 0.2)',
                    tension: 0.3,
                    pointBackgroundColor: 'rgba(59, 130, 246, 1)',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });

        // Grafik Peserta per Instansi
        const pesertaCtx = document.getElementById('pesertaChart').getContext('2d');
        new Chart(pesertaCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labelsInstansi) !!},
                datasets: [{
                    label: 'Jumlah Peserta',
                    data: {!! json_encode($dataPesertaInstansi) !!},
                    backgroundColor: 'rgba(16, 185, 129, 0.7)',
                    borderColor: 'rgba(5, 150, 105, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 }
                    }
                }
            }
        });
    });
</script>

@endpush
