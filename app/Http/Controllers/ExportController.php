<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportBahanPadat; 
use App\Exports\ExportBahanCairanLama;

class ExportController extends Controller
{
       public function exportBahanPadat()
    {
        return Excel::download(new ExportBahanPadat(), 'BahanPadat.xlsx');
    }

    public function exportBahanCairanLama()
    {
        return Excel::download(new ExportBahanCairanLama(), 'BahanCair.xlsx');
    }
}