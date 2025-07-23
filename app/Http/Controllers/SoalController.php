<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Level;
use App\Models\Soal;
use Illuminate\Support\Str;

class SoalController extends Controller
{
    public function index(){
        $respon                     = [];
        $respon['soalmenu']         = 'active';
        $respon['title']            = '';

        return view('pages.admin.soal.main', compact('respon'));
    }


    public function datasoal(Request $request){
        $query = Soal::query();
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('pertanyaan', 'like', "%{$search}%")
                ->orWhere('a', 'like', "%{$search}%")
                ->orWhere('b', 'like', "%{$search}%")
                ->orWhere('c', 'like', "%{$search}%")
                ->orWhere('d', 'like', "%{$search}%")
                ->orWhere('jawaban', 'like', "%{$search}%");
            });
        }

        if ($request->has('order')) {
            $columns        = ['id_soal','pertanyaan', 'a', 'b', 'c', 'd', 'jawaban'];
            $orderColumn    = $columns[$request->input('order.0.column')];
            $orderDirection = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDirection);
        }

        $length     = $request->input('length', 10);
        $start      = $request->input('start', 0);

        $totalData  = $query->count();
        $data       = $query->skip($start)->take($length)->get();

        $data->map(function($item) {
            $item->action       =  '<a href="#" class="btn-edit" data-id="'.$item->id_soal.'">
                                        <img src="'.asset('assets/icon/icon-edit.svg').'" class="h-4 h-5">
                                    </a>';
            $item->action       .= '<a href="#" class="btn-delete" data-id="'.$item->id_soal.'" data-nama="'.$item->pertanyaan.'">
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
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'a' => 'required|string|max:255',
            'b' => 'required|string|max:255',
            'c' => 'required|string|max:255',
            'd' => 'required|string|max:255',
            'jawaban' => 'required|in:A,B,C,D',
            'audio' => 'nullable|file|mimes:mp3|max:5120',
        ]);

        $audioPath = null;
        if ($request->hasFile('audio')) {
            $filename = Str::uuid() . '.' . $request->file('audio')->getClientOriginalExtension();
            $audioPath = $request->file('audio')->storeAs('audio_soal', $filename, 'public');
        }

        Soal::create([
            'pertanyaan'    => $request->pertanyaan,
            'a'             => $request->a,
            'b'             => $request->b,
            'c'             => $request->c,
            'd'             => $request->d,
            'jawaban'       => $request->jawaban,
            'audio'         => $audioPath,
        ]);

        return response()->json(['message' => 'Soal berhasil ditambahkan']);
    }

    // Ambil data soal by ID
    public function get($id)
    {
        $soal = Soal::findOrFail($id);
        return response()->json($soal);
    }

    // Update Soal
    public function update(Request $request, $id)
    {
        $request->validate([
            'pertanyaan' => 'required|string|max:255',
            'a' => 'required|string|max:255',
            'b' => 'required|string|max:255',
            'c' => 'required|string|max:255',
            'd' => 'required|string|max:255',
            'jawaban' => 'required|in:A,B,C,D',
            'audio' => 'nullable|mimes:mp3,wav',
        ]);


        $soal = Soal::findOrFail($id);

        $dataUpdate = [
            'pertanyaan' => $request->pertanyaan,
            'a' => $request->a,
            'b' => $request->b,
            'c' => $request->c,
            'd' => $request->d,
            'jawaban' => $request->jawaban,
        ];

        if ($request->hasFile('audio')) {
            if ($soal->audio && \Storage::disk('public')->exists('audio/' . $soal->audio)) {
                \Storage::disk('public')->delete('audio/' . $soal->audio);
            }

            $file = $request->file('audio');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('audio_soal', $filename, 'public');
            $dataUpdate['audio'] = $filename;
        }

        $soal->update($dataUpdate);

        return response()->json(['message' => 'Soal berhasil diupdate']);

    }

    // Delete Soal
    public function destroy($id)
    {
        $soal = Soal::findOrFail($id);
        $soal->delete();

        return response()->json(['message' => 'Soal berhasil dihapus']);
    }

}
