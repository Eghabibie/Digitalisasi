<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    protected $table = 'alats';
    protected $fillable = ['nama','volume','kondisi','jumlah','merek','tahun_pengadaan','images'];
    protected $guarded = [];
}
