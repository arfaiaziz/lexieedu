<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Instansi;
use App\Models\Level;
use Illuminate\Validation\Rule;
use App\Models\Soal;
use App\Models\Tes;

use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class MulaiTesController extends Controller
{
    public function index(){
        $respon['instansiData'] = Instansi::all();
        // $respon['levelData']    = Level::all();
        return view('pages.web.dashboard.mulai-tes', compact('respon'));
    }

    public function quiz(Request $request){

        $validated = $request->validate([
            'email'    => 'required|email|unique:peserta,email',
        ]);

        $pertanyaan = array();
        $soal       = Soal::all();
        foreach($soal as $key => $value){
            $pertanyaan[$key]['text']       = $value->pertanyaan;
            $pertanyaan[$key]['audio']      = $value->audio;
            $pertanyaan[$key]['options']    = array($value->a, $value->b, $value->c, $value->d);
            $pertanyaan[$key]['id']         = $value->id_soal;
            $pertanyaan[$key]['jawaban']    = $value->jawaban;
        }
        return view('pages.web.dashboard.quiz', compact('request', 'pertanyaan'));
    }

    public function submitquiz(Request $request){
        $peserta = Peserta::create([
            'nama_peserta' => $request->nama,
            'umur' => $request->umur,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tgl_daftar' => date('Y-m-d'),
            'id_instansi' => $request->instansi,
        ]);
        $jawaban = array(0 => 'A', 1 => 'B', 2 => 'C', 3 => 'D');
        foreach($request->answers as $answer){
            if(!empty($answer['id_soal'])){
                $soal = Soal::find($answer['id_soal']);
                Tes::create([
                    'tgl_tes' => date('Y-m-d'),
                    'id_peserta' => $peserta->id_peserta,
                    'id_soal' => $soal->id_soal,
                    'nama_soal' => $soal->pertanyaan,
                    'jawaban_soal' => $soal->jawaban,
                    'jawaban_peserta' => $jawaban[$answer['jawaban_peserta']],
                ]);
            }

        }

        return response()->json([
            'message' => 'Tes Selesai.',
            'data' => $peserta
        ]);
    }

    public function selesaiTest($id){
        $peserta    = Peserta::where('id_peserta', $id)->first();

        $cekJawaban = Tes::where('id_peserta', $id)->get();
        $benar      = 0;
        $totalsoal  = 0;
        foreach($cekJawaban as $item){
            if($item->jawaban_soal == $item->jawaban_peserta){
                $benar++;
            }
            $totalsoal++;
        }
        $persentase = ($benar / $totalsoal) * 100;

        $level          = $this->hasilLevel($persentase);
        $peserta->level = $level;
        $peserta->save();

        return view('pages.web.dashboard.selesai', compact('id', 'persentase', 'peserta', 'level'));
    }

    public function hasilLevel($persentasi)
    {
        if ($persentasi >= 0 && $persentasi <= 20) {
            return 'A1';
        } elseif ($persentasi >= 21 && $persentasi <= 40) {
            return 'A2';
        } elseif ($persentasi >= 41 && $persentasi <= 60) {
            return 'B1';
        } elseif ($persentasi >= 61 && $persentasi <= 75) {
            return 'B2';
        } elseif ($persentasi >= 76 && $persentasi <= 90) {
            return 'C1';
        } elseif ($persentasi >= 91 && $persentasi <= 100) {
            return 'C2';
        } else {
            return 'Unknown';
        }
    }


public function generateSertifikat(Request $request, $id)
{
    $peserta = Peserta::findOrFail($id);
    $nama = $peserta->nama_peserta;
    $filename = Str::slug($nama, '_');

    $cekJawaban = Tes::where('id_peserta', $id)->get();
    $totalSoalTersedia = Soal::count(); // Total semua soal
    $soalDijawab = $cekJawaban->count(); // Jumlah soal yang dijawab

    // Jumlah jawaban yang benar
    $benar = $cekJawaban->filter(function ($item) {
        return $item->jawaban_soal === $item->jawaban_peserta;
    })->count();

    // Persentase berdasarkan total soal yang tersedia, bukan soal yang dijawab
    $persentase = ($totalSoalTersedia > 0) ? ($benar / $totalSoalTersedia) * 100 : 0;

    $templatePath = storage_path('app/template/sertifikat.docx');
    $template = new TemplateProcessor($templatePath);
    $template->setValue('nama', $nama);
    $template->setValue('level', $peserta->level);
    $template->setValue('total_score', $benar.'/'.$totalSoalTersedia.' ('.round($persentase).'%)');
    $template->setValue('jawaban_pertanyaan', $soalDijawab.'/'.$totalSoalTersedia);

    $outputDocx = storage_path("app/sertifikat_{$filename}.docx");
    $outputPdf = storage_path("app/public/sertifikat/sertifikat_{$filename}.pdf");
    $template->saveAs($outputDocx);

    // Jalankan konversi ke PDF
    $command = 'soffice --headless --convert-to pdf --outdir ' . dirname($outputPdf) . ' ' . $outputDocx;
    exec($command, $output, $status);

    if (!file_exists($outputPdf)) {
        return response()->json([
            'message' => 'Gagal membuat file PDF. Pastikan LibreOffice terinstal dan file template tidak rusak.',
            'output' => $output,
            'status' => $status,
        ], 500);
    }

    return response()->download($outputPdf)->deleteFileAfterSend(true);
}




}
