<!DOCTYPE html>
<html>
<head>
    <title>Form Peminjaman Barang</title>
    <style>
        /* CSS sederhana untuk tampilan lebih baik */
        body { font-family: sans-serif; line-height: 1.6; padding: 20px; max-width: 600px; margin: auto; }
        div { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, button { padding: 10px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { width: auto; cursor: pointer; background-color: #007bff; color: white; border: none; }
        .success-message { color: #155724; background-color: #d4edda; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 4px;}
        .error-message { color: #721c24; background-color: #f8d7da; border: 1px solid #f5c6cb; padding: 10px; margin-top: 5px; border-radius: 4px; }
        .error-list { list-style-type: none; padding: 0; }
    </style>
</head>
<body>
    <h1>Form Peminjaman Barang Laboratorium</h1>

    @if ($errors->any())
        <div class="error-message">
            <strong>Oops! Terjadi kesalahan:</strong>
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    <form action="{{ route('pinjam.store') }}" method="POST">
        @csrf
        <div>
            <label for="nama_peminjam">Nama Lengkap:</label>
            <input type="text" id="nama_peminjam" name="nama_peminjam" value="{{ old('nama_peminjam') }}" required>
        </div>
        
        <div>
            <label for="nim_peminjam">NIM:</label>
            <input type="text" id="nim_peminjam" name="nim_peminjam" value="{{ old('nim_peminjam') }}" required>
        </div>
        
        <div>
            <label for="no_hp">Nomor HP Aktif:</label>
            <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
        </div>
        
        <div>
            <label for="item_selection">Pilih Barang:</label>
            <select name="item_selection" id="item_selection" required>
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
                        <option value="BahanPadat-{{ $item->id }}" data-unit="{{ $item->unit }}">
                            {{ $item->nama }} (Stok: {{ $item->jumlah }} {{ $item->unit }})
                        </option>
                    @endforeach
                </optgroup>
                <optgroup label="Bahan Cair">
                    @foreach ($bahan_cairan_lamas as $item)
                        <option value="BahanCairanLama-{{ $item->id }}" data-unit="{{ $item->unit }}">
                            {{ $item->nama }} (Stok: {{ $item->jumlah }} {{ $item->unit }})
                        </option>
                    @endforeach
                </optgroup>
            </select>
        </div>

        <div id="jumlah_pinjam_div" style="display: none;">
            <label for="jumlah_pinjam">Jumlah yang dipinjam:</label>
            <input type="number" step="0.01" name="jumlah_pinjam" id="jumlah_pinjam">
            <span id="unit_display" style="font-weight: bold;"></span>
        </div>

        <input type="hidden" name="item_type" id="item_type">
        <input type="hidden" name="item_id" id="item_id">
        
        <button type="submit">Kirim Permintaan Pinjam</button>
    </form>

    <script>
        document.getElementById('item_selection').addEventListener('change', function() {
            const jumlahDiv = document.getElementById('jumlah_pinjam_div');
            const unitDisplay = document.getElementById('unit_display');
            
            if (!this.value) {
                jumlahDiv.style.display = 'none';
                return;
            }

            const selectedOption = this.options[this.selectedIndex];
            const [type, id] = this.value.split('-');
            
            document.getElementById('item_type').value = type;
            document.getElementById('item_id').value = id;

            if (type === 'BahanPadat' || type === 'BahanCairanLama') {
                jumlahDiv.style.display = 'block';
                unitDisplay.textContent = selectedOption.dataset.unit || '';
            } else {
                jumlahDiv.style.display = 'none';
            }
        });
    </script>
</body>
</html>
