<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class TransaksiController extends Controller
{
    public function index(){
        $respon                     = [];
        $respon['transaksimenu']    = 'active';
        $respon['title']            = '';

        return view('pages.admin.transaksi.main', compact('respon'));
    }

    public function data(Request $request){
        $query = Transaksi::query();
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                ->orWhere('via_pembayaran', 'like', "%{$search}%")
                ->orWhere('nominal', 'like', "%{$search}%")
                ->orWhere('keterangan', 'like', "%{$search}%");
            });
        }

        if ($request->has('order')) {
            $columns        = ['id_transaksi','nama','tgl_transaksi','via_pembayaran', 'nominal'];
            $orderColumn    = $columns[$request->input('order.0.column')];
            $orderDirection = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDirection);
        }

        $length     = $request->input('length', 10);
        $start      = $request->input('start', 0);

        $totalData  = $query->count();
        $data       = $query->skip($start)->take($length)->get();

        $data->map(function($item, $index) use ($start) {
            $item->no             = $start + $index + 1;
            $item->tgl_transaksi  = date('d-m-Y', strtotime($item->tgl_transaksi));
            $item->nominal        = number_format($item->nominal, 0, ',', '.');
            $item->action         =  '<a href="#" class="btn-edit" data-id="'.$item->id_transaksi.'">
                                        <img src="'.asset('assets/icon/icon-edit.svg').'" class="h-4 h-5">
                                    </a>';
            $item->action        .= '<a href="#" class="btn-delete" data-id="'.$item->id_transaksi.'" data-nama="'.$item->nama.'">
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
            'nama'            => 'required|string|max:255',
            'tgl_transaksi'   => 'required|date',
            'via_pembayaran'  => 'required|string|max:100',
            'nominal'         => 'required|numeric',
            'keterangan'      => 'required|string|max:255',
        ]);

        Transaksi::create($validated);

        return response()->json(['message' => 'Transaksi berhasil ditambahkan!']);
    }


    public function get($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        return response()->json($transaksi);
    }


    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nama'            => 'required|string|max:255',
            'tgl_transaksi'   => 'required|date',
            'via_pembayaran'  => 'required|string|max:100',
            'nominal'         => 'required|numeric',
            'keterangan'      => 'required|string|max:255',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update($validated);

        return response()->json(['message' => 'Transaksi berhasil diupdate!']);
    }


    public function destroy($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }


}
