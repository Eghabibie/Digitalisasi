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
        // 1. Validasi data peminjam dan memastikan keranjang (items) tidak kosong.
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'nim_peminjam'  => 'required|string|max:255',
            'no_hp'         => 'required|string|max:20',
            'items'         => 'required|array|min:1', // Memastikan minimal ada 1 item di keranjang
            'items.*.item_id'       => 'required|integer',
            'items.*.item_type'     => 'required|string|in:Alat,BahanPadat,BahanCairanLama',
            'items.*.jumlah_pinjam' => 'required|numeric|min:0.01',
        ]);

        // 2. Validasi stok untuk SETIAP item SEBELUM melakukan penyimpanan.
        // Ini untuk mencegah hanya sebagian barang yang berhasil dipinjam jika salah satu stoknya tidak cukup.
        foreach ($request->items as $itemData) {
            $modelClass = 'App\\Models\\' . $itemData['item_type'];
            $item = $modelClass::findOrFail($itemData['item_id']);
            $jumlah_pinjam = $itemData['jumlah_pinjam'];

            if ($itemData['item_type'] === 'Alat') {
                if ($jumlah_pinjam > $item->stok) {
                    return back()->withErrors(['stok' => 'Jumlah peminjaman untuk ' . $item->nama . ' melebihi stok yang tersedia.'])->withInput();
                }
            } else {
                if ($jumlah_pinjam > $item->sisa_bahan) {
                    return back()->withErrors(['stok' => 'Jumlah peminjaman untuk ' . $item->nama . ' melebihi sisa bahan yang tersedia.'])->withInput();
                }
            }
        }

        // 3. Jika semua validasi lolos, simpan setiap item ke database.
        foreach ($request->items as $itemData) {
            $modelClass = 'App\\Models\\' . $itemData['item_type'];
            $item = $modelClass::findOrFail($itemData['item_id']);
            $jumlah_pinjam = $itemData['jumlah_pinjam'];

            // Buat record peminjaman baru
            Peminjaman::create([
                'nama_peminjam' => $request->nama_peminjam,
                'nim_peminjam' => $request->nim_peminjam,
                'no_hp' => $request->no_hp,
                'peminjamable_id' => $itemData['item_id'],
                'peminjamable_type' => $modelClass,
                'jumlah' => $jumlah_pinjam,
                'status' => 'Menunggu Persetujuan', // Status awal
            ]);

            // Kurangi stok atau sisa bahan
            if ($itemData['item_type'] === 'Alat') {
                $item->decrement('stok', $jumlah_pinjam);
            } else {
                $item->decrement('sisa_bahan', $jumlah_pinjam);
            }
        }

        // 4. Kembalikan ke halaman sebelumnya dengan pesan sukses.
        return back()->with('success', 'Permintaan peminjaman Anda untuk ' . count($request->items) . ' barang telah dikirim!');
    }
}
