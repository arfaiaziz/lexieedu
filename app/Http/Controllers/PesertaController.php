<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Peserta;
use App\Models\Instansi;
use App\Models\Level;
use Illuminate\Validation\Rule;
use App\Models\Tes;


class PesertaController extends Controller
{
    public function index(){
        $respon                 = [];
        $respon['pesertamenu']  = 'active';
        $respon['title']        = '';
        $respon['instansiData'] = Instansi::all();
        $respon['levelData']    = ["A1", "A2", "B1", "B2", "C1", "C2"];
        return view('pages.admin.peserta.main', compact('respon'));
    }

    public function data(Request $request){
        $query = Peserta::with(['intansi'])
            ->join('instansi', 'peserta.id_instansi', '=', 'instansi.id_instansi')
            ->select('peserta.*', 'instansi.nama_instansi');

        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');

            $query->where(function($q) use ($search) {
                $q->where('peserta.nama_peserta', 'like', "%{$search}%")
                    ->orWhere('peserta.umur', 'like', "%{$search}%")
                    ->orWhere('peserta.alamat', 'like', "%{$search}%")
                    ->orWhere('peserta.email', 'like', "%{$search}%")
                    ->orWhere('level', 'like', "%{$search}%")
                    ->orWhere('instansi.nama_instansi', 'like', "%{$search}%");
            });
        }

        if ($request->has('order')) {
            $columns = [
                'id_peserta', 'nama_peserta', 'umur', 'alamat', 'email',
                'tgl_daftar', 'level', 'instansi.nama_instansi'
            ];
            $orderColumn = $columns[$request->input('order.0.column')];
            $orderDirection = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDirection);
        }

        $length = $request->input('length', 10);
        $start = $request->input('start', 0);

        $totalData = $query->count();
        $data = $query->skip($start)->take($length)->get();


        $data->map(function($item) {

            $item->nama_instansi    = $item->intansi ? $item->intansi->nama_instansi : '-';
            $item->tgl_daftar       = date('d-m-Y', strtotime($item->tgl_daftar));
            $item->umur             = $item->umur . ' Tahun';

            $item->action       =  '<a href="#" class="btn-edit" data-id="'.$item->id_peserta.'">
                                        <img src="'.asset('assets/icon/icon-edit.svg').'" class="h-4 h-5">
                                    </a>';
            $item->action       .= '<a href="#" class="btn-delete" data-id="'.$item->id_peserta.'" data-nama="'.$item->nama_peserta.'">
                                        <img src="'.asset('assets/icon/icon-hapus.svg').'" class="h-4 h-5">
                                    </a>';

            $cekTest = Tes::where('id_peserta', $item->id_peserta)->count();

            if ($cekTest > 0) {
                $item->action .= '<a href="'.url('download-sertifikat/'.$item->id_peserta).'" class="btn-download">
                                    <img src="'.asset('assets/icon/icon-download.svg').'" class="h-4 h-5">
                                </a>';
            } else {
                $item->action .= '<a href="#" onclick="alert(\'Data tidak ditemukan, silahkan lakukan tes ulang.\')">
                                    <img src="'.asset('assets/icon/icon-download.svg').'" class="h-4 h-5 opacity-50">
                                </a>';
            }
            return $item;
        });

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalData,
            'data' => $data,
        ]);
    }


    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_pelajar' => 'required|string|max:255',
            'umur' => 'required|integer|min:1',
            'email' => 'required|email|unique:peserta,email',
            'alamat' => 'required|string',
            'tgl_daftar' => 'required|date',
            'id_level' => 'required|string',
            'id_instansi' => 'required|integer',
        ]);

        // Simpan ke database
        $peserta = Peserta::create([
            'nama_peserta' => $request->nama_pelajar,
            'umur' => $request->umur,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tgl_daftar' => $request->tgl_daftar,
            'level' => $request->id_level,
            'id_instansi' => $request->id_instansi,
        ]);

        // Response sukses (jika AJAX)
        return response()->json([
            'message' => 'Peserta berhasil disimpan.',
            'data' => $peserta
        ]);
    }

    public function get($id)
    {
        $instansi = Peserta::findOrFail($id);
        return response()->json($instansi);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_pelajar' => 'required|string|max:255',
            'umur' => 'required|integer|min:1',
            'email' => [
                'required',
                'email',
                Rule::unique('peserta', 'email')->ignore($id, 'id_peserta'),
            ],
            'alamat' => 'required|string',
            'tgl_daftar' => 'required|date',
            'id_level' => 'required|string',
            'id_instansi' => 'required|integer',
        ]);

        // Cari data peserta berdasarkan ID
        $peserta = Peserta::where('id_peserta', $id)->firstOrFail();

        // Update data peserta
        $peserta->update([
            'nama_peserta' => $request->nama_pelajar,
            'umur' => $request->umur,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'tgl_daftar' => $request->tgl_daftar,
            'level' => $request->id_level,
            'id_instansi' => $request->id_instansi,
        ]);

        // Response sukses (jika pakai AJAX)
        return response()->json([
            'message' => 'Data peserta berhasil diperbarui.',
            'data' => $peserta
        ]);
    }


    public function destroy($id)
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
