<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Instansi;

use App\Models\User;
use App\Models\Peserta;
use App\Models\Transaksi;
use App\Models\Soal;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(){
        $respon                     = [];
        $respon['dashboardmenu']    = 'active';
        $respon['title']            = '';

        $totalUsers = User::count();
        $totalPeserta = Peserta::count();
        $totalTransaksi = Transaksi::count();
        $totalInstansi = Instansi::count();
        $totalSoal = Soal::count();


        // Hitung transaksi per bulan (bulan 1–12)
        $transaksiBulanan = Transaksi::selectRaw('MONTH(tgl_transaksi) as bulan, COUNT(*) as jumlah')
            ->groupBy(DB::raw('MONTH(tgl_transaksi)'))
            ->pluck('jumlah', 'bulan')
            ->toArray();

        // Pastikan semua bulan 1-12 ada
        $dataBulanan = [];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulanan[] = $transaksiBulanan[$i] ?? 0;
        }


        $pesertaPerInstansi = Peserta::select('id_instansi', DB::raw('count(*) as jumlah'))
        ->groupBy('id_instansi')
        ->get()
        ->keyBy('id_instansi');

        $labelsInstansi = [];
        $dataPesertaInstansi = [];

        $allInstansi = Instansi::pluck('nama_instansi', 'id_instansi')->toArray();

        foreach ($allInstansi as $id => $nama) {
            $labelsInstansi[] = $nama;
            $dataPesertaInstansi[] = $pesertaPerInstansi[$id]->jumlah ?? 0;
        }


        return view('pages.admin.dashboard.main', compact(
            'totalUsers',
            'totalPeserta',
            'totalTransaksi',
            'totalInstansi',
            'totalSoal',
            'dataBulanan',
            'labelsInstansi',
            'dataPesertaInstansi',
            'respon'
        ));

    }

}
