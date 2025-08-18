<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\BahanPadat;
use App\Models\BahanCairanLama;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

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
        // 1. Validasi input
        $validatedData = $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'nim_peminjam'  => 'required|string|max:255',
            'no_hp'         => ['required', 'string', 'regex:/^\+62[0-9]{9,15}$/'],
            'items'         => 'required|array|min:1',
            'items.*.item_id'       => 'required|integer',
            'items.*.item_type'     => 'required|string',
            'items.*.jumlah_pinjam' => 'required|numeric|min:0.01',
        ], [
            'no_hp.regex' => 'Format Nomor HP tidak valid. Harap masukkan nomor yang benar (contoh: 81234567890).',
        ]);

        // --- START: Logika Pengecekan Diperbarui ---
        $nim = $validatedData['nim_peminjam'];
        $nama = $validatedData['nama_peminjam'];
        $no_hp = $validatedData['no_hp'];

        // Cek jika ada peminjaman aktif berdasarkan NIM, Nama, ATAU No. HP
        $peminjamanAktif = Peminjaman::where(function ($query) use ($nim, $nama, $no_hp) {
            $query->where('nim_peminjam', $nim)
                ->orWhere('nama_peminjam', $nama)
                ->orWhere('no_hp', $no_hp);
        })
            ->whereNotIn('status', ['Dikembalikan', 'Ditolak'])
            ->exists();

        // Jika ditemukan, hentikan proses
        if ($peminjamanAktif) {
            return redirect()->back()
                ->withErrors(['peminjaman_aktif' => 'Anda (atau data identik) terdeteksi masih memiliki peminjaman yang belum selesai.'])
                ->withInput();
        }
        // --- END: Logika Pengecekan Diperbarui ---

        // 3. Proses transaksi database
        DB::transaction(function () use ($validatedData, $request) {
            $allowedModels = [
                'Alat' => \App\Models\Alat::class,
                'BahanPadat' => \App\Models\BahanPadat::class,
                'BahanCairanLama' => \App\Models\BahanCairanLama::class,
            ];

            foreach ($validatedData['items'] as $index => $itemData) {

                if (!isset($allowedModels[$itemData['item_type']])) {
                    throw ValidationException::withMessages([
                        'items.' . $index . '.item_type' => 'Tipe barang tidak valid.'
                    ]);
                }

                $modelClass = $allowedModels[$itemData['item_type']];
                $jumlah_pinjam = $itemData['jumlah_pinjam'];

                $item = $modelClass::where('id', $itemData['item_id'])->lockForUpdate()->firstOrFail();

                $stokTersedia = ($itemData['item_type'] === 'Alat') ? $item->stok : $item->sisa_bahan;

                if ($jumlah_pinjam > $stokTersedia) {
                    throw ValidationException::withMessages([
                        'items.' . $index . '.jumlah_pinjam' => 'Stok untuk ' . $item->nama . ' tidak cukup (sisa: ' . $stokTersedia . ').'
                    ]);
                }

                Peminjaman::create([
                    'nama_peminjam' => $request->nama_peminjam,
                    'nim_peminjam' => $request->nim_peminjam,
                    'no_hp' => $validatedData['no_hp'],
                    'peminjamable_id' => $itemData['item_id'],
                    'peminjamable_type' => $modelClass,
                    'jumlah' => $jumlah_pinjam,
                    'status' => 'Menunggu Persetujuan',
                ]);

                if ($itemData['item_type'] === 'Alat') {
                    $item->decrement('stok', $jumlah_pinjam);
                } else {
                    $item->decrement('sisa_bahan', $jumlah_pinjam);
                }
            }
        });

        return back()->with('success', 'Permintaan peminjaman untuk ' . count($request->items) . ' barang telah berhasil dikirim!');
    }
}
