<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\Laporan;

class InventoryController extends Controller
{
    public function index()
    {
        $inventory = Inventory::all();
        return view('inventory.index', compact('inventory'));
    }

    public function create()
    {
        return view('inventory.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_brg' => 'required|string',
            'kategori_brg' => 'required|string',
            'jumlah' => 'required|integer',
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'nullable|date',
            'harga' => 'required|numeric',
        ]);

        Inventory::create($data);

        return redirect()->route('inventory.index')->with('success', 'Inventory berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventory.edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'nama_brg' => 'required|string',
            'kategori_brg' => 'required|string',
            'jumlah' => 'required|integer',
            'tgl_masuk' => 'required|date',
            'tgl_keluar' => 'nullable|date',
            'harga' => 'required|numeric',
        ]);

        Inventory::where('inventory_id', $id)->update($data);
        return redirect()->route('inventory.index')->with('success', 'Inventory berhasil diupdate.');
    }

    public function laporan()
    {
        $inventory = Inventory::all();
        return view('inventory.laporan', compact('inventory'));
    }

    public function destroy($id)
    {
        try {
            $inventory = Inventory::findOrFail($id);
            $inventory->delete();

            if (request()->ajax()) {
                return response()->json(['success' => true]);
            }
            return redirect()->route('inventory.index')->with('success', 'Data berhasil dihapus!');
        } catch (\Exception $e) {
            if (request()->ajax()) {
                return response()->json(['success' => false], 500);
            }
            return redirect()->back()->with('error', 'Gagal menghapus data!');
        }
    }

}
