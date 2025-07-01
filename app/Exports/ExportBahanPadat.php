<?php

namespace App\Exports;
use App\Models\BahanPadat;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBahanPadat implements FromCollection
{
       /**
     * Hapus seluruh method __construct() karena tidak ada lagi $id
     */

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Ambil SEMUA data BahanPadat
        return BahanPadat::all();
    }
}
