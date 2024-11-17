<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Models\LogAktivitas;


class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';
    protected $primaryKey = 'inventory_id';
    protected $fillable = ['nama_brg', 'kategori_brg', 'jumlah', 'tgl_masuk', 'tgl_keluar', 'harga'];

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'inventory_id', 'inventory_id');
    }

    // Event untuk mencatat log aktivitas
    protected static function booted()
    {
        // Log saat menambah barang
        static::created(function ($inventory) {
            LogAktivitas::create([
                'username_id' => Session::get('pengelola_gudang_id'),
                'aksi' => 'Tambah Barang',
                'tanggal_aksi' => now(),
                'keterangan' => "Menambahkan barang {$inventory->nama_brg} dengan jumlah {$inventory->jumlah}"
            ]);
        });

        // Log saat mengupdate barang
        static::updated(function ($inventory) {
            $changes = $inventory->getChanges();
            $oldValues = $inventory->getOriginal();

            $detailPerubahan = [];
            foreach ($changes as $field => $newValue) {
                if ($field !== 'updated_at') {
                    $detailPerubahan[] = "$field dari {$oldValues[$field]} menjadi $newValue";
                }
            }

            if (!empty($detailPerubahan)) {
                LogAktivitas::create([
                    'username_id' => Session::get('pengelola_gudang_id'),
                    'aksi' => 'Update Barang',
                    'tanggal_aksi' => now(),
                    'keterangan' => "Mengupdate barang {$inventory->nama_brg}: " . implode(', ', $detailPerubahan)
                ]);
            }
        });

        // Log saat menghapus barang
        static::deleted(function ($inventory) {
            LogAktivitas::create([
                'username_id' => Session::get('pengelola_gudang_id'),
                'aksi' => 'Hapus Barang',
                'tanggal_aksi' => now(),
                'keterangan' => "Menghapus barang {$inventory->nama_brg} dengan jumlah {$inventory->jumlah}"
            ]);
        });
    }
}
