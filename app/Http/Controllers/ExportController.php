<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportBahanPadat; 

class ExportController extends Controller
{
        public function export()
    {
       
        return Excel::download(new ExportBahanPadat(), 'BahanPadat.xlsx');
    }
}