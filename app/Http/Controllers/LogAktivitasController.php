<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\PengelolaGudang;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index()
    {
        $logAktivitas = LogAktivitas::with('pengelolaGudang')->get();
        return view('log_aktivitas.index', compact('logAktivitas'));
    }

    public function create()
    {
        $pengelolaGudang = PengelolaGudang::all();
        return view('log_aktivitas.create', compact('pengelolaGudang'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username_id' => 'required|exists:pengelola_gudang,pengelola_gudang_id',
            'aksi' => 'required|string',
            'tanggal_aksi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        LogAktivitas::create($data);

        return redirect()->route('log_aktivitas.index')->with('success', 'Log aktivitas berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        LogAktivitas::destroy($id);
        return redirect()->route('log_aktivitas.index')->with('success', 'Log aktivitas berhasil dihapus.');
    }
}

