<?php

namespace App\Http\Controllers;

use App\Models\PengelolaGudang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PengelolaGudangController extends Controller
{
    public function index()
    {
        $pengelolaGudang = PengelolaGudang::all();
        return view('pengelola_gudang.index', compact('pengelolaGudang'));
    }

    public function create()
    {
        return view('pengelola_gudang.create');
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:pengelola_gudang,username',
            'password' => 'required|min:6',
        ]);

        PengelolaGudang::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Enkripsi password
        ]);

        return redirect()->route('pengelola_gudang.index')->with('success', 'Pengelola Gudang berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengelolaGudang = PengelolaGudang::findOrFail($id);
        return view('pengelola_gudang.edit', compact('pengelolaGudang'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'username' => 'required|unique:pengelola_gudang,username,'.$id.',pengelola_gudang_id',
            'password' => 'nullable|min:8',
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($data['password']);
        }

        PengelolaGudang::where('pengelola_gudang_id', $id)->update($data);

        return redirect()->route('pengelola_gudang.index')->with('success', 'Pengelola Gudang berhasil diupdate.');
    }

    public function destroy($id)
    {
        PengelolaGudang::destroy($id);
        return redirect()->route('pengelola_gudang.index')->with('success', 'Pengelola Gudang berhasil dihapus.');
    }
}
