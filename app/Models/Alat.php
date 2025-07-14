<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alats';
    protected $fillable = ['nama','volume','kondisi','stok','merek','tahun_pengadaan','images'];
    protected $guarded = [];
    public function peminjamans()
{
    return $this->morphMany(Peminjaman::class, 'peminjamable');
}
}
