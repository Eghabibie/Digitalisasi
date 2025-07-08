<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanPadat extends Model
{
    public function peminjamans()
{
    return $this->morphMany(Peminjaman::class, 'peminjamable');
}
    protected $table = 'bahan_padats';
    protected $guarded = [];
}
