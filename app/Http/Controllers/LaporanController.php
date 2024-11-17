<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\PengelolaGudang;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = Laporan::with(['pengelolaGudang', 'inventory'])
            ->select('laporan_id', 'judul_laporan', 'deskripsi', 'tanggal_laporan', 'status_laporan', 'pengelola_gudang_id', 'inventory_id')
            ->get();
        return view('laporan.index', compact('laporan'));
    }

    public function create()
    {
        $pengelolaGudang = PengelolaGudang::all();
        $inventory = Inventory::all();
        return view('laporan.create', compact('pengelolaGudang', 'inventory'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'judul_laporan' => 'required|string|max:255',
            'tanggal_laporan' => 'required|date',
            'deskripsi' => 'nullable|string', // Sesuaikan dengan nama di database
            'pengelola_gudang_id' => 'required|exists:pengelola_gudang,pengelola_gudang_id',
            'inventory_id' => 'required|exists:inventory,inventory_id',
            'status_laporan' => 'required|in:pending,approved,rejected'
        ]);

        // Set default status jika tidak ada
        if (!isset($validatedData['status_laporan'])) {
            $validatedData['status_laporan'] = 'pending';
        }

        // Create new report with validated data
        $laporan = Laporan::create($validatedData);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $laporan = Laporan::with(['pengelolaGudang', 'inventory'])->findOrFail($id);
        $pengelolaGudang = PengelolaGudang::all();
        $inventory = Inventory::all();
        return view('laporan.edit', compact('laporan', 'pengelolaGudang', 'inventory'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validatedData = $request->validate([
            'pengelola_gudang_id' => 'required|exists:pengelola_gudang,pengelola_gudang_id',
            'inventory_id' => 'required|exists:inventory,inventory_id',
            'judul_laporan' => 'required|string|max:255',
            'tanggal_laporan' => 'required|date',
            'deskripsi' => 'nullable|string', // Sesuaikan dengan nama di database
            'status_laporan' => 'required|in:pending,approved,rejected',
        ]);

        // Update the report
        $laporan = Laporan::findOrFail($id);
        $laporan->update($validatedData);

        return redirect()->route('laporan.index')
            ->with('success', 'Laporan berhasil diupdate.');
    }
}
