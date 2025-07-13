<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\BahanPadat;
use App\Models\BahanCairanLama; // Pastikan nama model ini benar
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PinjamController extends Controller
{
    /**
     * Menampilkan halaman form peminjaman.
     */
    public function create()
    {
        $alats = Alat::orderBy('nama')->get();
        $bahan_padats = BahanPadat::orderBy('nama')->get();
        $bahan_cairan_lamas = BahanCairanLama::orderBy('nama')->get(); 
        return view('pinjam', compact('alats', 'bahan_padats', 'bahan_cairan_lamas'));
    }

    /**
     * Menyimpan data dari form peminjaman.
     */
    public function store(Request $request)
    {
        // 1. Validasi input dasar dari form
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'nim_peminjam' => 'required|string|max:255',
            'item_type' => 'required|in:Alat,BahanPadat,BahanCairanLama', 
            'item_id' => 'required|integer',
        ]);

        // Siapkan variabel
        $modelClass = 'App\\Models\\' . $request->item_type;
        $item = $modelClass::findOrFail($request->item_id);
        $jumlah_pinjam = 1; // Jumlah pinjam default untuk Alat

        // 2. Logika validasi stok yang berbeda untuk Alat dan Bahan
        if ($request->item_type === 'Alat') {
            if ($item->stok <= 0) {
                return back()->withErrors(['item_selection' => 'Stok alat yang dipilih sudah habis.'])->withInput();
            }
        } else { // Ini berlaku untuk BahanPadat dan BahanCairanLama
            // Validasi jumlah yang ingin dipinjam
            $request->validate([
                // Pastikan jumlah pinjam tidak melebihi jumlah yang ada
                'jumlah_pinjam' => 'required|numeric|min:0.01|max:' . $item->jumlah, 
            ]);
            $jumlah_pinjam = $request->jumlah_pinjam;
        }

        // 3. Buat dan simpan data peminjaman ke database
        Peminjaman::create([
            'nama_peminjam' => $request->nama_peminjam,
            'nim_peminjam' => $request->nim_peminjam,
            'peminjamable_id' => $request->item_id,
            'peminjamable_type' => $modelClass,
            'jumlah' => $jumlah_pinjam, // Simpan jumlah yang dipinjam
            'status' => 'Menunggu Persetujuan', // Status awal
        ]);

        // 4. Kurangi stok barang SETELAH data peminjaman berhasil disimpan
        if ($request->item_type === 'Alat') {
            $item->decrement('stok');
        } else {
            // Gunakan 'jumlah' sesuai nama kolom Anda
            $item->decrement('jumlah', $jumlah_pinjam); 
        }

        return back()->with('success', 'Permintaan peminjaman Anda telah dikirim dan sedang menunggu persetujuan admin.');
    }
}
