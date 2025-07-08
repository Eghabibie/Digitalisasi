<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanCairanLama extends Model
{
    public function peminjamans()
{
    return $this->morphMany(Peminjaman::class, 'peminjamable');
}
    protected $table = 'bahan_cairan_lamas';
    protected $guarded = [];
}
