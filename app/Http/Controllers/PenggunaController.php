<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class PenggunaController extends Controller
{
    public function index(){
        $respon                     = [];
        $respon['penggunamenu']     = 'active';
        $respon['title']            = '';

        return view('pages.admin.pengguna.main', compact('respon'));
    }

    public function data(Request $request){
        $query = User::query();
        if ($request->has('search') && $request->input('search.value') != '') {
            $search = $request->input('search.value');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('no_hp', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        if ($request->has('order')) {
            $columns        = ['name','email','no_hp', 'alamat'];
            $orderColumn    = $columns[$request->input('order.0.column')];
            $orderDirection = $request->input('order.0.dir');
            $query->orderBy($orderColumn, $orderDirection);
        }

        $length     = $request->input('length', 10);
        $start      = $request->input('start', 0);

        $totalData  = $query->count();
        $data       = $query->skip($start)->take($length)->get();

        $data->map(function($item, $index) use ($start) {
            $item->no               = $start + $index + 1;
            $item->action           =  '<a href="#" class="btn-edit" data-id="'.$item->id.'">
                                            <img src="'.asset('assets/icon/icon-edit.svg').'" class="h-4 h-5">
                                        </a>';
            $item->action           .= '<a href="#" class="btn-delete" data-id="'.$item->id.'" data-nama="'.$item->name.'">
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
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'no_hp'    => 'required|string|max:20',
            'alamat'   => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        $validated['password']  = Hash::make($validated['password']);
        $validated['role']      = 'admin';

        User::create($validated);

        return response()->json(['message' => 'Pengguna berhasil ditambahkan']);
    }

    public function get($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
            'no_hp'    => 'required|string|max:20',
            'alamat'   => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }
        $validated['role']      = 'admin';

        $user->update($validated);

        return response()->json(['message' => 'Pengguna berhasil diperbarui']);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'Pengguna berhasil dihapus']);
    }


}
