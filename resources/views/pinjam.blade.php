<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Opsi: Font kustom jika diinginkan */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="container mx-auto p-4 md:p-8 max-w-5xl">
        
        <div class="mb-6">
            <h1 class="text-3xl font-bold">Form Peminjaman Barang Laboratorium</h1>
        </div>

        <div class="bg-white p-6 md:p-8 rounded-lg shadow-md">

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p class="font-bold">Oops! Terjadi kesalahan:</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                 <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <form action="{{ route('pinjam.store') }}" method="POST" id="PinjamForm">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div>
                        <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam') }}" placeholder="Masukan Nama Lengkap...." required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="nim_peminjam" class="block text-sm font-medium text-gray-700">NIM <span class="text-red-500">*</span></label>
                        <input type="text" id="nim_peminjam" name="nim_peminjam" value="{{ old('nim_peminjam') }}" placeholder="Masukan NIM...." required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    
                    <div class="md:col-span-2"> <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP Aktif <span class="text-red-500">*</span></label>
                        <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Masukan Nomor HP Aktif...." required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="item_selection" class="block text-sm font-medium text-gray-700">Pilih Barang <span class="text-red-500">*</span></label>
                        <select name="item_selection" id="item_selection" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">-- Pilih Barang --</option>
                        <optgroup label="Alat">
                            @foreach ($alats as $item)
                                <option value="Alat-{{ $item->id }}" @if($item->stok <= 0) disabled @endif>
                                    {{ $item->nama }} (Stok: {{ $item->stok }})
                                </option>
                            @endforeach
                        </optgroup>

                        <optgroup label="Bahan Padat">
                            @foreach ($bahan_padats as $item)
                                <option value="BahanPadat-{{ $item->id }}" data-unit="{{ $item->unit }}" @if($item->sisa_bahan <= 0) disabled @endif>
                                    {{ $item->nama }} (Sisa: {{ $item->sisa_bahan }} {{ $item->unit }})
                                </option>
                            @endforeach
                        </optgroup>

                        <optgroup label="Bahan Cair">
                            @foreach ($bahan_cairan_lamas as $item)
                                <option value="BahanCairanLama-{{ $item->id }}" data-unit="{{ $item->unit }}" @if($item->sisa_bahan <= 0) disabled @endif>
                                    {{ $item->nama }} (Sisa: {{ $item->sisa_bahan }} {{ $item->unit }})
                                </option>
                            @endforeach
                        </optgroup>
                        </select>
                    </div>

                    <div id="jumlah_pinjam_div" style="display: none;" class="md:col-span-2">
                        <label for="jumlah_pinjam" class="block text-sm font-medium text-gray-700">Jumlah yang dipinjam <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                           <input type="number" name="jumlah_pinjam" id="jumlah_pinjam"
                                  class="flex-1 block w-full min-w-0 rounded-none rounded-l-md px-3 py-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                           <span id="unit_display" class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">unit</span>
                        </div>
                    </div>

                </div>

                <input type="hidden" name="item_type" id="item_type">
                <input type="hidden" name="item_id" id="item_id">
                
                <div class="flex items-center gap-4 pt-6 border-t border-gray-200 mt-6">
                    <button type="submit" id="sendButton"
                            class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Kirim Permintaan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('item_selection').addEventListener('change', function() {
            const jumlahDiv = document.getElementById('jumlah_pinjam_div');
            const jumlahInput = document.getElementById('jumlah_pinjam');
            const unitDisplay = document.getElementById('unit_display');
            
            if (!this.value) {
                jumlahDiv.style.display = 'none';
                return;
            }

            const selectedOption = this.options[this.selectedIndex];
            const [type, id] = this.value.split('-');
            
            document.getElementById('item_type').value = type;
            document.getElementById('item_id').value = id;

            
            jumlahDiv.style.display = 'block';

            if (type === 'Alat') {
                jumlahInput.step = '1';
                jumlahInput.placeholder = 'Jumlah unit...';
                unitDisplay.textContent = 'unit';
            } else {
                jumlahInput.step = '0.01';
                const unit = selectedOption.dataset.unit || '';
                jumlahInput.placeholder = `Jumlah dalam ${unit}...`;
                unitDisplay.textContent = unit;
            }
        });
        document.getElementById('PinjamForm') .addEventListener('submit', function () {
            Swal.fire({
        title: "Pememinjaman Sedang Diproses",
        icon: "success",
        });
        })
        
    </script>
</body>
</html>