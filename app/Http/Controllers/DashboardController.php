<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Laporan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalInventory = Inventory::count();
        $totalLaporan = Laporan::count();

        return view('dashboard.index', compact('totalInventory', 'totalLaporan'));
    }
}
