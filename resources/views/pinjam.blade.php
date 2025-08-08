<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Barang</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        img[alt]:after {
            content: attr(alt);
            font-size: 14px;
            color: rgb(107 114 128);
            display: block;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">

<div class="container mx-auto p-4 md:p-8 max-w-7xl">
    
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Form Peminjaman Barang Laboratorium</h1>
        <p class="text-gray-600 mt-1">Isi data diri dan pilih barang yang akan dipinjam.</p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
        <div class="lg:col-span-3 bg-white p-6 md:p-8 rounded-xl shadow-lg">

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
                        <input type="text" id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam') }}" placeholder="Masukan Nama Lengkap" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    
                    <div>
                        <label for="nim_peminjam" class="block text-sm font-medium text-gray-700">NIM <span class="text-red-500">*</span></label>
                        <input type="text" id="nim_peminjam" name="nim_peminjam" value="{{ old('nim_peminjam') }}" placeholder="Masukan NIM" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP Aktif <span class="text-red-500">*</span></label>
                        <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890" required
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="item_selection" class="block text-sm font-medium text-gray-700">Pilih Barang <span class="text-red-500">*</span></label>
                        <select name="item_selection" id="item_selection" required
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">-- Pilih dari Daftar --</option>
                            <optgroup label="Alat Laboratorium">
                                @foreach ($alats as $item)
                                    <option value="Alat-{{ $item->id }}"
                                            data-nama="{{ $item->nama }}"
                                            data-stok="{{ $item->stok }}"
                                            data-tipe="Alat"
                                            data-images-json="{{ json_encode(collect($item->images)->map(fn($path) => asset('storage/' . $path))) }}"
                                            @if($item->stok <= 0) disabled @endif>
                                        {{ $item->nama }} (Stok: {{ $item->stok }})
                                    </option>
                                @endforeach
                            </optgroup>
                            
                            <optgroup label="Bahan Padat">
                                @foreach ($bahan_padats as $item)
                                    <option value="BahanPadat-{{ $item->id }}" 
                                            data-nama="{{ $item->nama }}" 
                                            data-sisa="{{ $item->sisa_bahan }}"
                                            data-unit="{{ $item->unit }}"
                                            data-tipe="BahanPadat"
                                            @if($item->sisa_bahan <= 0) disabled @endif>
                                        {{ $item->nama }} (Sisa: {{ $item->sisa_bahan }} {{ $item->unit }})
                                    </option>
                                @endforeach
                            </optgroup>
                            <optgroup label="Bahan Cair">
                                @foreach ($bahan_cairan_lamas as $item)
                                    <option value="BahanCairanLama-{{ $item->id }}"
                                            data-nama="{{ $item->nama }}"
                                            data-sisa="{{ $item->sisa_bahan }}"
                                            data-unit="{{ $item->unit }}"
                                            data-tipe="BahanCairanLama"
                                            @if($item->sisa_bahan <= 0) disabled @endif>
                                        {{ $item->nama }} (Sisa: {{ $item->sisa_bahan }} {{ $item->unit }})
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>
                    </div>

                    <div id="jumlah_pinjam_div" style="display: none;" class="md:col-span-2">
                        <label for="jumlah_pinjam" class="block text-sm font-medium text-gray-700">Jumlah yang dipinjam <span class="text-red-500">*</span></label>
                        <div class="mt-1 flex rounded-md shadow-sm">
                            <input type="number" name="jumlah_pinjam" id="jumlah_pinjam" required
                                   class="flex-1 block w-full min-w-0 rounded-none rounded-l-md px-3 py-2 border border-gray-300 placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <span id="unit_display" class="inline-flex items-center px-3 rounded-r-md border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">unit</span>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="item_type" id="item_type">
                <input type="hidden" name="item_id" id="item_id">
                
                <div class="pt-6 mt-6 border-t border-gray-200">
                    <button type="submit" id="sendButton" class="inline-flex justify-center py-2.5 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full md:w-auto">
                        Kirim Permintaan Pinjam
                    </button>
                </div>
            </form>
        </div>
        <div class="lg:col-span-2">
            <div id="item-preview" class="bg-white p-6 rounded-xl shadow-lg sticky top-8" style="display: none;">
                <h3 class="text-lg font-bold text-gray-900 border-b pb-3 mb-4">Pratinjau Barang</h3>
                <div id="gallery-container" class="mb-4" style="display: none;">
                    <img id="main-preview-image" src="" alt="Pratinjau Alat" class="w-full h-56 object-contain rounded-md bg-gray-100 border relative">
                    
                    <div id="thumbnail-container" class="flex gap-2 mt-3 overflow-x-auto p-1">
                    </div>
                </div>
                
                <div class="text-center">
                    <h4 id="preview-nama" class="text-xl font-semibold text-gray-800">Nama Alat</h4>
                    <p id="preview-stok" class="text-md text-gray-500 mt-1">Stok: 10</p>
                </div>

                <div id="preview-info-tambahan" class="mt-4 border-t pt-4">
                        <p class="text-sm text-gray-600 text-center">Pastikan jumlah pinjaman tidak melebihi stok yang tersedia.</p>
                </div>
            </div>
            
            <div id="item-preview-placeholder" class="bg-white/60 border-2 border-dashed border-gray-300 p-6 rounded-xl sticky top-8 h-[400px] flex items-center justify-center">
                <div class="text-center">
                    
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Pratinjau Barang</h3>
                    <p class="mt-1 text-sm text-gray-500">Pilih barang untuk melihat detailnya di sini.</p>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    const itemSelection = document.getElementById('item_selection');
    const jumlahDiv = document.getElementById('jumlah_pinjam_div');
    const jumlahInput = document.getElementById('jumlah_pinjam');
    const unitDisplay = document.getElementById('unit_display');
    const itemTypeInput = document.getElementById('item_type');
    const itemIdInput = document.getElementById('item_id');
    const pinjamForm = document.getElementById('PinjamForm');

    const itemPreview = document.getElementById('item-preview');
    const itemPreviewPlaceholder = document.getElementById('item-preview-placeholder');
    const previewNama = document.getElementById('preview-nama');
    const previewStok = document.getElementById('preview-stok');
    
    const galleryContainer = document.getElementById('gallery-container');
    const mainPreviewImage = document.getElementById('main-preview-image');
    const thumbnailContainer = document.getElementById('thumbnail-container');

    function resetPreview() {
        itemPreview.style.display = 'none';
        itemPreviewPlaceholder.style.display = 'flex';
        jumlahDiv.style.display = 'none';
        jumlahInput.value = '';
        galleryContainer.style.display = 'none';
        thumbnailContainer.innerHTML = '';
    }

    itemSelection.addEventListener('change', function() {
        if (!this.value) {
            resetPreview();
            return;
        }

        const selectedOption = this.options[this.selectedIndex];
        const dataset = selectedOption.dataset;
        const [type, id] = this.value.split('-');

        itemTypeInput.value = type;
        itemIdInput.value = id;

        itemPreview.style.display = 'block';
        itemPreviewPlaceholder.style.display = 'none';
        jumlahDiv.style.display = 'block';
        previewNama.textContent = dataset.nama;

        if (type === 'Alat') {
            const imagesJson = dataset.imagesJson;
            const images = imagesJson && imagesJson !== '[]' ? JSON.parse(imagesJson) : [];

            if (images.length > 0) {
                galleryContainer.style.display = 'block';
                mainPreviewImage.src = images[0];
                mainPreviewImage.alt = `Gambar utama untuk ${dataset.nama}`;
                thumbnailContainer.innerHTML = '';

                images.forEach((imageUrl, index) => {
                    const thumb = document.createElement('img');
                    thumb.src = imageUrl;
                    thumb.alt = `Thumbnail ${index + 1} untuk ${dataset.nama}`;
                    thumb.className = 'w-16 h-16 object-cover rounded-md cursor-pointer border-2 border-transparent hover:border-indigo-500 transition';
                    
                    if (index === 0) {
                        thumb.classList.add('border-indigo-500');
                    }

                    thumb.addEventListener('click', () => {
                        mainPreviewImage.src = imageUrl;
                        thumbnailContainer.querySelectorAll('img').forEach(t => t.classList.remove('border-indigo-500'));
                        thumb.classList.add('border-indigo-500');
                    });
                    
                    thumbnailContainer.appendChild(thumb);
                });
            } else {
                galleryContainer.style.display = 'none';
            }
            
            previewStok.textContent = `Stok Tersedia: ${dataset.stok} unit`;
            jumlahInput.step = '1';
            jumlahInput.min = '1';
            jumlahInput.max = dataset.stok;
            jumlahInput.placeholder = 'Jumlah unit...';
            unitDisplay.textContent = 'unit';

        } else {
            galleryContainer.style.display = 'none';
            
            const sisa = dataset.sisa || '0';
            const unit = dataset.unit || '';
            previewStok.textContent = `Sisa Bahan: ${sisa} ${unit}`;
            jumlahInput.step = '0.01';
            jumlahInput.min = '0.01';
            jumlahInput.max = sisa;
            jumlahInput.placeholder = `Jumlah dalam ${unit}...`;
            unitDisplay.textContent = unit;
        }
    });

    pinjamForm.addEventListener('submit', function (e) {
        if (!this.checkValidity()) { return; }
        e.preventDefault();
        Swal.fire({
            title: 'Konfirmasi Peminjaman',
            html: `Anda akan meminjam <strong>${previewNama.textContent}</strong> sejumlah <strong>${jumlahInput.value} ${unitDisplay.textContent}</strong>. <br><br>Lanjutkan?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Permintaan Terkirim!",
                    text: "Peminjaman Anda sedang diproses oleh admin.",
                    icon: "success",
                    timer: 2000,
                    showConfirmButton: false,
                });
                setTimeout(() => { this.submit(); }, 1500);
            }
        });
    });
});
</script>

</body>
</html>