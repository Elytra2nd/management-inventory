<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LogAktivitas extends Model
{
    use HasFactory;

    protected $table = 'log_aktivitas';
    protected $primaryKey = 'log_id';
    protected $fillable = ['username_id', 'aksi', 'tanggal_aksi', 'keterangan'];

    public function pengelolaGudang()
    {
        return $this->belongsTo(PengelolaGudang::class, 'username_id', 'pengelola_gudang_id');
    }
}
