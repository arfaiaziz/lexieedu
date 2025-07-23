<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Instansi;

class InstansiController extends Controller
{
    public function index(){
        $respon                     = [];
        $respon['instansimenu']     = 'active';
        $respon['title']            = '';

        return view('pages.admin.instansi.main', compact('respon'));
    }

    public function data(Request $request){
        $query = Instansi::query();
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('nama_instansi', 'like', "%{$search}%")
                ->orWhere('jumlah_sesi', 'like', "%{$search}%");
            });
        }

        if ($request->has('order')) {
            $columns        = ['id_instansi','nama_instansi','tgl_mulai', 'tgl_berakhir', 'jumlah_sesi'];
            $orderColumn    = $columns[$request->input('order.0.column')];
            $orderDirection = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDirection);
        }

        $length     = $request->input('length', 10);
        $start      = $request->input('start', 0);

        $totalData  = $query->count();
        $data       = $query->skip($start)->take($length)->get();

        $data->map(function($item) {
            $item->tgl_mulai    = date('d-m-Y', strtotime($item->tgl_mulai));
            $item->tgl_berakhir = date('d-m-Y', strtotime($item->tgl_berakhir));
            $item->jumlah_sesi  = number_format($item->jumlah_sesi, 0, ',', '.').' Sesi';
            $item->action       =  '<a href="#" class="btn-edit" data-id="'.$item->id_instansi.'">
                                        <img src="'.asset('assets/icon/icon-edit.svg').'" class="h-4 h-5">
                                    </a>';
            $item->action       .= '<a href="#" class="btn-delete" data-id="'.$item->id_instansi.'" data-nama="'.$item->nama_instansi.'">
                                        <img src="'.asset('assets/icon/icon-hapus.svg').'" class="h-4 h-5">
                                    </a>';
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
        $validated = $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_berakhir' => 'required|date|after_or_equal:tgl_mulai',
            'jumlah_sesi' => 'required|integer|min:1',
        ]);

        $instansi                   = new Instansi();
        $instansi->nama_instansi    = $validated['nama_instansi'];
        $instansi->tgl_mulai        = $validated['tgl_mulai'];
        $instansi->tgl_berakhir     = $validated['tgl_berakhir'];
        $instansi->jumlah_sesi      = $validated['jumlah_sesi'];
        $instansi->save();

        return response()->json([
            'success' => true,
            'message' => 'Instansi berhasil disimpan.'
        ]);
    }

    public function get($id)
    {
        $instansi = Instansi::findOrFail($id);
        return response()->json($instansi);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_instansi' => 'required|string|max:255',
            'tgl_mulai' => 'required|date',
            'tgl_berakhir' => 'required|date|after_or_equal:tgl_mulai',
            'jumlah_sesi' => 'required|integer|min:1',
        ]);

        $instansi                   = Instansi::findOrFail($id);
        $instansi->nama_instansi    = $request->nama_instansi;
        $instansi->tgl_mulai        = $request->tgl_mulai;
        $instansi->tgl_berakhir     = $request->tgl_berakhir;
        $instansi->jumlah_sesi      = $request->jumlah_sesi;
        $instansi->save();

        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $instansi = Instansi::findOrFail($id);
        $instansi->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }


}
