<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\BahanPadat;
use App\Models\BahanCairanLama;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PinjamController extends Controller
{
    public function create()
    {
        $alats = Alat::orderBy('nama')->get();
        $bahan_padats = BahanPadat::orderBy('nama')->get();
        $bahan_cairan_lamas = BahanCairanLama::orderBy('nama')->get(); 
        return view('pinjam', compact('alats', 'bahan_padats', 'bahan_cairan_lamas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'nim_peminjam' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'item_type' => 'required|in:Alat,BahanPadat,BahanCairanLama', 
            'item_id' => 'required|integer',
            'jumlah_pinjam' => 'required|numeric|min:0.01',
        ]);

        $modelClass = 'App\\Models\\' . $request->item_type;
        $item = $modelClass::findOrFail($request->item_id);
        $jumlah_pinjam = $request->jumlah_pinjam;

        if ($request->item_type === 'Alat') {
            $request->validate([
                'jumlah_pinjam' => 'integer|min:1|max:' . $item->stok, 
            ]);
        } else { 
            $request->validate([
                'jumlah_pinjam' => 'numeric|min:0.01|max:' . $item->jumlah, 
            ]);
        }

        Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'nim_peminjam' => $request->nim_peminjam,
            'no_hp' => $request->no_hp,
            'peminjamable_id' => $request->item_id,
            'peminjamable_type' => $modelClass,
            'jumlah' => $jumlah_pinjam,
            'status' => 'Menunggu Persetujuan',
        ]);
        if ($request->item_type === 'Alat') {
            $item->decrement('stok', $jumlah_pinjam);
        } else {
            $item->decrement('jumlah', $jumlah_pinjam); 
        }

        return back()->with('success', 'Permintaan peminjaman Anda telah dikirim dan sedang menunggu persetujuan admin.');
    }
}
