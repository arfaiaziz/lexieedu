<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Soal;

class LevelController extends Controller
{
    public function index(){
        $respon                     = [];
        $respon['levelmenu']        = 'active';
        $respon['title']            = '';

        return view('pages.admin.level.main', compact('respon'));
    }

    public function data(Request $request){
        $query = Level::query();
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('nama_level', 'like', "%{$search}%")
                ->orWhere('keterangan_level', 'like', "%{$search}%");
            });
        }

        if ($request->has('order')) {
            $columns        = ['id_level','nama_level', 'keterangan_level'];
            $orderColumn    = $columns[$request->input('order.0.column')];
            $orderDirection = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDirection);
        }

        $length     = $request->input('length', 10);
        $start      = $request->input('start', 0);

        $totalData  = $query->count();
        $data       = $query->skip($start)->take($length)->get();

        $data->map(function($item) {
            $item->action       =  '<a href="#" class="btn-edit" data-id="'.$item->id_level.'">
                                        <img src="'.asset('assets/icon/icon-edit.svg').'" class="h-4 h-5">
                                    </a>';
            $item->action       .= '<a href="#" class="btn-delete" data-id="'.$item->id_level.'" data-nama="'.$item->nama_level.'">
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
            'nama_level'        => 'required|string|max:255',
            'keterangan_level'  => 'required|string|max:255',
        ]);

        $level                      = new Level();
        $level->nama_level          = $validated['nama_level'];
        $level->keterangan_level    = $validated['keterangan_level'];
        $level->save();

        return response()->json([
            'success' => true,
            'message' => 'level berhasil disimpan.'
        ]);
    }

    public function get($id)
    {
        $level = Level::findOrFail($id);
        return response()->json($level);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_level'        => 'required|string|max:255',
            'keterangan_level'  => 'required|string|max:255',
        ]);

        $level                      = Level::findOrFail($id);
        $level->nama_level          = $request->nama_level;
        $level->keterangan_level    = $request->keterangan_level;
        $level->save();

        return response()->json(['success' => true, 'message' => 'Data berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $level = Level::findOrFail($id);
        $level->delete();
        Soal::where('id_level', $id)->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }


}
