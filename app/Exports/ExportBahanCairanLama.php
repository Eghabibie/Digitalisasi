<?php

namespace App\Exports;
use App\Models\BahanCairanLama;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBahanCairanLama implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return BahanCairanLama::all();
    }
}
