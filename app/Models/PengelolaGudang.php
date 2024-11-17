<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengelolaGudang extends Model
{
    use HasFactory;

    protected $table = 'pengelola_gudang';
    protected $primaryKey = 'pengelola_gudang_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $casts = [
        'pengelola_gudang_id' => 'string',
        'username' => 'string',
        'password' => 'string',
    ];
    protected $hidden = ['password'];
    protected $fillable = ['pengelola_gudang_id', 'username', 'password'];

    public function logAktivitas()
    {
        return $this->hasMany(LogAktivitas::class, 'username_id', 'pengelola_gudang_id');
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class, 'pengelola_gudang_id', 'pengelola_gudang_id');
    }
}
