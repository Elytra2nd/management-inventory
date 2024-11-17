<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Models\LogAktivitas;

class Laporan extends Model
{
    protected $table = 'laporan';

    protected $primaryKey = 'laporan_id';

    protected $guarded = [];

    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id', 'inventory_id');
    }

    public function pengelolaGudang()
    {
        return $this->belongsTo(PengelolaGudang::class, 'pengelola_gudang_id', 'pengelola_gudang_id');
    }

    protected static function booted()
    {
        // Log when creating a report
        static::created(function ($laporan) {
            $inventory = $laporan->inventory;

            LogAktivitas::create([
                'username_id' => Session::get('pengelola_gudang_id'),
                'aksi' => 'Buat Laporan',
                'tanggal_aksi' => now(),
                'keterangan' => "Membuat laporan {$laporan->jenis_laporan} untuk barang {$inventory->nama_brg}"
            ]);
        });

        // Log when updating a report
        static::updated(function ($laporan) {
            $changes = $laporan->getChanges();
            $oldValues = $laporan->getOriginal();
            $inventory = $laporan->inventory;

            $detailPerubahan = [];
            foreach ($changes as $field => $newValue) {
                if ($field !== 'updated_at') {
                    $detailPerubahan[] = "$field dari {$oldValues[$field]} menjadi $newValue";
                }
            }

            if (!empty($detailPerubahan)) {
                LogAktivitas::create([
                    'username_id' => Session::get('pengelola_gudang_id'),
                    'aksi' => 'Update Laporan',
                    'tanggal_aksi' => now(),
                    'keterangan' => "Mengupdate laporan untuk barang {$inventory->nama_brg}: " . implode(', ', $detailPerubahan)
                ]);
            }
        });

        // Log when deleting a report
        static::deleted(function ($laporan) {
            $inventory = $laporan->inventory;

            LogAktivitas::create([
                'username_id' => Session::get('pengelola_gudang_id'),
                'aksi' => 'Hapus Laporan',
                'tanggal_aksi' => now(),
                'keterangan' => "Menghapus laporan {$laporan->jenis_laporan} untuk barang {$inventory->nama_brg}"
            ]);
        });
    }
}
