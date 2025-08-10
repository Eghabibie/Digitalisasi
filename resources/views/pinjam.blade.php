<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman Barang Laboratorium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
        }

        /* --- Palet Warna Soft & Modern --- */
        :root {
            --bg-primary: #F9FAFB;
            --bg-secondary: #FFFFFF;
            --accent-primary: #6366F1;
            --accent-hover: #4F46E5;
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            --border-color: #E5E7EB;
        }

        /* BARU: Style untuk menampilkan tulisan rumus kimia */
        .formula-display {
            background-color: #F3F4F6; /* Latar abu-abu soft */
            color: var(--text-primary);
            font-size: 2.25rem; /* Ukuran font 36px, bisa disesuaikan */
            font-weight: 600; /* Sedikit tebal */
            letter-spacing: 0.025em; /* Spasi antar huruf */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
            border-radius: 0.5rem;
            text-align: center;
            padding: 0.5rem;
        }
        
        /* Animasi untuk modal (tidak berubah) */
        .modal-enter { animation: fadeIn 0.3s ease-out; }
        .modal-leave { animation: fadeOut 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        @keyframes fadeOut { from { opacity: 1; transform: scale(1); } to { opacity: 0; transform: scale(0.95); } }
    </style>
</head>
<body class="bg-[var(--bg-primary)] text-[var(--text-primary)]">

<div class="container mx-auto p-4 md:p-8 max-w-7xl">
    
    <header class="mb-8 text-center">
        <h1 class="text-4xl font-bold text-[var(--text-primary)]">Katalog Barang Laboratorium</h1>
        <p class="text-lg text-[var(--text-secondary)] mt-2">Pilih barang yang ingin Anda pinjam dan tambahkan ke keranjang.</p>
    </header>

    <div class="mb-10 max-w-2xl mx-auto">
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                <i class="fa-solid fa-search"></i>
            </span>
            <input type="text" id="searchInput" placeholder="Cari nama alat atau bahan..."
                   class="w-full py-3 pl-12 pr-4 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-[var(--accent-primary)] focus:border-[var(--accent-primary)] transition">
        </div>
    </div>

    {{-- Notifikasi (tidak berubah) --}}
    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md shadow" role="alert"><p>{{ session('success') }}</p></div>
    @endif
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md shadow" role="alert">
            <p class="font-bold">Oops! Terjadi kesalahan:</p>
            <ul class="mt-2 list-disc list-inside text-sm">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <div id="items-container">
        <section id="alat-lab" class="catalog-section">
            <h2 class="text-2xl font-bold text-[var(--text-primary)] border-b-2 border-[var(--border-color)] pb-3 mb-6">Alat Laboratorium</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($alats as $item)
                <div class="item-card bg-[var(--bg-secondary)] rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105 duration-300">
                    @if($item->stok <= 0)
                    <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-10"><span class="text-lg font-bold text-red-600 border-2 border-red-500 bg-white px-4 py-2 rounded-md">Stok Habis</span></div>
                    @endif
                    <div class="h-48 bg-gray-100 flex items-center justify-center">
                        @if(!empty($item->images))
                            <img src="{{ asset('storage/' . $item->images[0]) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                        @else
                            <i class="fa-solid fa-image fa-4x text-gray-400"></i>
                        @endif
                    </div>
                    <div class="p-4 flex flex-col h-[calc(100%-12rem)]">
                        <h3 class="font-semibold text-lg truncate item-name">{{ $item->nama }}</h3>
                        <p class="text-sm text-[var(--text-secondary)]">Stok: <span class="font-medium text-gray-800">{{ $item->stok }}</span> unit</p>
                        <button class="add-to-cart-btn mt-auto w-full bg-[var(--accent-primary)] text-white py-2 px-4 rounded-md font-semibold hover:bg-[var(--accent-hover)] transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed" data-id="Alat-{{ $item->id }}" data-nama="{{ $item->nama }}" data-stok="{{ $item->stok }}" data-unit="unit" data-tipe="Alat" @if($item->stok <= 0) disabled @endif>
                            <i class="fa-solid fa-cart-plus mr-2"></i> Tambah
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- =================================== --}}
        {{--     PERUBAHAN BAGIAN BAHAN PADAT    --}}
        {{-- =================================== --}}
        <section id="bahan-padat" class="catalog-section mt-12">
            <h2 class="text-2xl font-bold text-[var(--text-primary)] border-b-2 border-[var(--border-color)] pb-3 mb-6">Bahan Padat</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($bahan_padats as $item)
                <div class="item-card bg-[var(--bg-secondary)] rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105 duration-300">
                    @if($item->sisa_bahan <= 0)
                    <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-10"><span class="text-lg font-bold text-red-600 border-2 border-red-500 bg-white px-4 py-2 rounded-md">Habis</span></div>
                    @endif
                    <div class="h-48 p-4">
                        {{-- Menampilkan tulisan rumus kimia --}}
                        <div class="formula-display">
                            {{-- Cek apakah ada kolom 'rumus_kimia', jika tidak, tampilkan '?' --}}
                            {!! !empty($item->rumus_kimia) ? $item->rumus_kimia : '<i class="fa-solid fa-question-circle text-gray-400"></i>' !!}
                        </div>
                    </div>
                    <div class="p-4 flex flex-col h-[calc(100%-12rem)]">
                        <h3 class="font-semibold text-lg truncate item-name">{{ $item->nama }}</h3>
                        <p class="text-sm text-[var(--text-secondary)]">Sisa: <span class="font-medium text-gray-800">{{ $item->sisa_bahan }}</span> {{ $item->unit }}</p>
                        <button class="add-to-cart-btn mt-auto w-full bg-[var(--accent-primary)] text-white py-2 px-4 rounded-md font-semibold hover:bg-[var(--accent-hover)] transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed" data-id="BahanPadat-{{ $item->id }}" data-nama="{{ $item->nama }}" data-stok="{{ $item->sisa_bahan }}" data-unit="{{ $item->unit }}" data-tipe="BahanPadat" @if($item->sisa_bahan <= 0) disabled @endif>
                            <i class="fa-solid fa-cart-plus mr-2"></i> Tambah
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        {{-- =================================== --}}
        {{--      PERUBAHAN BAGIAN BAHAN CAIR     --}}
        {{-- =================================== --}}
        <section id="bahan-cair" class="catalog-section mt-12">
            <h2 class="text-2xl font-bold text-[var(--text-primary)] border-b-2 border-[var(--border-color)] pb-3 mb-6">Bahan Cair</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($bahan_cairan_lamas as $item)
                <div class="item-card bg-[var(--bg-secondary)] rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105 duration-300">
                     @if($item->sisa_bahan <= 0)
                    <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-10"><span class="text-lg font-bold text-red-600 border-2 border-red-500 bg-white px-4 py-2 rounded-md">Habis</span></div>
                    @endif
                    <div class="h-48 p-4">
                        {{-- Menampilkan tulisan rumus kimia --}}
                        <div class="formula-display">
                            {{-- Tanda {!! !!} digunakan agar HTML seperti H₂SO₄ bisa dirender dengan benar --}}
                            {!! !empty($item->rumus_kimia) ? $item->rumus_kimia : '<i class="fa-solid fa-question-circle text-gray-400"></i>' !!}
                        </div>
                    </div>
                    <div class="p-4 flex flex-col h-[calc(100%-12rem)]">
                        <h3 class="font-semibold text-lg truncate item-name">{{ $item->nama }}</h3>
                        <p class="text-sm text-[var(--text-secondary)]">Sisa: <span class="font-medium text-gray-800">{{ $item->sisa_bahan }}</span> {{ $item->unit }}</p>
                        <button class="add-to-cart-btn mt-auto w-full bg-[var(--accent-primary)] text-white py-2 px-4 rounded-md font-semibold hover:bg-[var(--accent-hover)] transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed" data-id="BahanCairanLama-{{ $item->id }}" data-nama="{{ $item->nama }}" data-stok="{{ $item->sisa_bahan }}" data-unit="{{ $item->unit }}" data-tipe="BahanCairanLama" @if($item->sisa_bahan <= 0) disabled @endif>
                            <i class="fa-solid fa-cart-plus mr-2"></i> Tambah
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        
        <div id="no-results-message" class="text-center py-16 hidden">
            <i class="fa-solid fa-box-open fa-4x text-gray-300"></i>
            <h3 class="mt-4 text-xl font-semibold text-gray-800">Tidak Ada Hasil</h3>
            <p class="mt-2 text-gray-500">Kami tidak dapat menemukan barang yang cocok dengan pencarian Anda.</p>
        </div>
    </div>
</div>

{{-- Bagian Modal, Tombol Keranjang, dan JavaScript tidak ada perubahan --}}
<button id="cart-button" class="fixed bottom-6 right-6 bg-[var(--accent-primary)] text-white w-16 h-16 rounded-full shadow-lg flex items-center justify-center text-2xl transform transition-transform hover:scale-110">
    <i class="fa-solid fa-shopping-cart"></i>
    <span id="cart-item-count" class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center border-2 border-white">0</span>
</button>
<div id="cart-modal-overlay" class="fixed inset-0 bg-black bg-opacity-60 z-40 hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div id="cart-modal" class="modal-enter fixed inset-0 flex items-center justify-center p-4">
        <form id="loan-form" action="{{ route('pinjam.store') }}" method="POST" class="bg-[var(--bg-secondary)] rounded-xl shadow-2xl w-full max-w-2xl max-h-[90vh] flex flex-col">
            @csrf
            <div class="flex justify-between items-center p-5 border-b border-[var(--border-color)]">
                <h2 id="modal-title" class="text-2xl font-bold">Keranjang Peminjaman</h2>
                <button type="button" id="close-modal-btn" class="text-gray-400 hover:text-gray-800 text-2xl">&times;</button>
            </div>
            <div class="p-6 overflow-y-auto">
                <div id="cart-items-container"></div>
                <div id="cart-empty-message" class="text-center py-10">
                    <i class="fa-solid fa-dolly-empty fa-3x text-gray-300"></i>
                    <p class="mt-4 text-[var(--text-secondary)]">Keranjang Anda masih kosong.</p>
                </div>
                <div id="borrower-form-container" class="mt-6 pt-6 border-t border-[var(--border-color)]" style="display: none;">
                    <h3 class="text-xl font-bold mb-4">Data Diri Peminjam</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_peminjam" name="nama_peminjam" placeholder="Masukan Nama Lengkap" required value="{{ old('nama_peminjam') }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[var(--accent-primary)] focus:border-[var(--accent-primary)] sm:text-sm">
                        </div>
                         <div>
                            <label for="nim_peminjam" class="block text-sm font-medium text-gray-700">NIM <span class="text-red-500">*</span></label>
                            <input type="text" id="nim_peminjam" name="nim_peminjam" placeholder="Masukan NIM" required value="{{ old('nim_peminjam') }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[var(--accent-primary)] focus:border-[var(--accent-primary)] sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP Aktif <span class="text-red-500">*</span></label>
                            <input type="tel" id="no_hp" name="no_hp" placeholder="Contoh: 081234567890" required value="{{ old('no_hp') }}"
                                   class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-[var(--accent-primary)] focus:border-[var(--accent-primary)] sm:text-sm">
                        </div>
                    </div>
                </div>
                <div id="hidden-inputs-for-cart"></div>
            </div>
            <div id="modal-footer" class="p-5 border-t border-[var(--border-color)] bg-gray-50 rounded-b-xl" style="display: none;">
                <button type="submit" id="submit-loan-btn" class="w-full bg-[var(--accent-primary)] text-white py-3 px-6 rounded-lg font-semibold text-lg hover:bg-[var(--accent-hover)] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--accent-primary)]">
                    <i class="fa-solid fa-paper-plane mr-2"></i> Ajukan Peminjaman
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // === Bagian Keranjang (Cart) ===
    const cartButton = document.getElementById('cart-button');
    const cartModalOverlay = document.getElementById('cart-modal-overlay');
    const cartModal = document.getElementById('cart-modal');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const cartItemCount = document.getElementById('cart-item-count');
    const cartItemsContainer = document.getElementById('cart-items-container');
    const cartEmptyMessage = document.getElementById('cart-empty-message');
    const borrowerFormContainer = document.getElementById('borrower-form-container');
    const modalFooter = document.getElementById('modal-footer');
    const mainForm = document.getElementById('loan-form');
    const hiddenInputsContainer = document.getElementById('hidden-inputs-for-cart');
    let cart = {}; 

    const toggleModal = (show) => {
        if (show) {
            cartModalOverlay.classList.remove('hidden');
            cartModal.classList.remove('modal-leave');
            cartModal.classList.add('modal-enter');
        } else {
            cartModal.classList.remove('modal-enter');
            cartModal.classList.add('modal-leave');
            setTimeout(() => cartModalOverlay.classList.add('hidden'), 300);
        }
    };

    const renderCart = () => {
        cartItemsContainer.innerHTML = '';
        const items = Object.values(cart);
        
        if (items.length === 0) {
            cartEmptyMessage.style.display = 'block';
            borrowerFormContainer.style.display = 'none';
            modalFooter.style.display = 'none';
        } else {
            cartEmptyMessage.style.display = 'none';
            borrowerFormContainer.style.display = 'block';
            modalFooter.style.display = 'block';
            
            items.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.className = 'flex items-center justify-between gap-4 py-3 border-b border-gray-200';
                const step = item.tipe === 'Alat' ? '1' : '0.01';
                itemElement.innerHTML = `
                    <div class="flex-grow">
                        <p class="font-semibold text-gray-800">${item.nama}</p>
                        <p class="text-sm text-gray-500">Stok: ${item.stok} ${item.unit}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" class="quantity-change-btn w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 font-bold" data-id="${item.id}" data-change="-1">-</button>
                        <input type="number" value="${item.quantity}" min="1" max="${item.stok}" step="${step}" class="w-20 text-center border-gray-300 rounded-md quantity-input" data-id="${item.id}">
                        <button type="button" class="quantity-change-btn w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 font-bold" data-id="${item.id}" data-change="1">+</button>
                    </div>
                    <button type="button" class="remove-item-btn text-red-500 hover:text-red-700 text-lg" data-id="${item.id}"><i class="fa-solid fa-trash-can"></i></button>
                `;
                cartItemsContainer.appendChild(itemElement);
            });
        }
        cartItemCount.textContent = items.length;
    };
    
    const addItemToCart = (button) => {
        const data = button.dataset;
        if (cart[data.id]) {
            Swal.fire({ toast: true, position: 'top-end', icon: 'info', title: 'Barang sudah di keranjang', showConfirmButton: false, timer: 1500 });
            return;
        }
        cart[data.id] = { id: data.id, nama: data.nama, stok: parseFloat(data.stok), unit: data.unit, tipe: data.tipe, quantity: 1 };
        button.classList.add('animate-pulse');
        setTimeout(() => button.classList.remove('animate-pulse'), 1000);
        renderCart();
    };
    
    const changeItemQuantity = (id, change) => {
        if (!cart[id]) return;
        const newQuantity = cart[id].quantity + change;
        if (newQuantity > 0 && newQuantity <= cart[id].stok) {
            cart[id].quantity = newQuantity;
        } else if (newQuantity > cart[id].stok) {
             Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Melebihi stok!', showConfirmButton: false, timer: 1500 });
        } else {
            removeItemFromCart(id);
        }
        renderCart();
    };

    const removeItemFromCart = (id) => {
        delete cart[id];
        renderCart();
    };

    cartButton.addEventListener('click', () => toggleModal(true));
    closeModalBtn.addEventListener('click', () => toggleModal(false));
    cartModalOverlay.addEventListener('click', (e) => { if (e.target === cartModalOverlay) toggleModal(false); });
    document.querySelectorAll('.add-to-cart-btn').forEach(button => { button.addEventListener('click', (e) => { e.preventDefault(); addItemToCart(button); }); });
    cartItemsContainer.addEventListener('click', e => {
        const button = e.target.closest('button');
        if (!button) return;
        const id = button.dataset.id;
        if (button.classList.contains('quantity-change-btn')) changeItemQuantity(id, parseInt(button.dataset.change));
        else if (button.classList.contains('remove-item-btn')) removeItemFromCart(id);
    });
    cartItemsContainer.addEventListener('input', e => {
        if (e.target.classList.contains('quantity-input')) {
            const id = e.target.dataset.id;
            let newQuantity = parseFloat(e.target.value);
            if (isNaN(newQuantity) || newQuantity < 1) newQuantity = 1;
            if (newQuantity > cart[id].stok) {
                newQuantity = cart[id].stok;
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Melebihi stok!', showConfirmButton: false, timer: 1500 });
            }
            cart[id].quantity = newQuantity;
            e.target.value = newQuantity;
        }
    });

    mainForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const nama = document.getElementById('nama_peminjam').value, nim = document.getElementById('nim_peminjam').value, no_hp = document.getElementById('no_hp').value;
        if (!nama || !nim || !no_hp) {
            Swal.fire('Data Tidak Lengkap', 'Mohon isi semua data diri peminjam.', 'warning');
            return;
        }
        hiddenInputsContainer.innerHTML = '';
        Object.values(cart).forEach((item, index) => {
            const [type, id] = item.id.split('-');
            hiddenInputsContainer.innerHTML += `
                <input type="hidden" name="items[${index}][item_id]" value="${id}">
                <input type="hidden" name="items[${index}][item_type]" value="${type}">
                <input type="hidden" name="items[${index}][jumlah_pinjam]" value="${item.quantity}">
            `;
        });
        Swal.fire({
            title: 'Konfirmasi Peminjaman',
            text: `Anda akan mengajukan peminjaman untuk ${Object.keys(cart).length} jenis barang. Lanjutkan?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4F46E5',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Lanjutkan!',
            cancelButtonText: 'Batal'
        }).then((result) => { if (result.isConfirmed) mainForm.submit(); });
    });

    @if ($errors->any())
        toggleModal(true);
    @endif

    const searchInput = document.getElementById('searchInput');
    const allItemCards = document.querySelectorAll('.item-card');
    const allSections = document.querySelectorAll('.catalog-section');
    const noResultsMessage = document.getElementById('no-results-message');

    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let totalVisibleItems = 0;

        allItemCards.forEach(card => {
            const itemName = card.querySelector('.item-name').textContent.toLowerCase();
            const isVisible = itemName.includes(searchTerm);
            card.style.display = isVisible ? '' : 'none';
        });

        allSections.forEach(section => {
            const visibleCardsInSection = section.querySelectorAll('.item-card:not([style*="display: none"])');
            if (visibleCardsInSection.length > 0) {
                section.style.display = '';
                totalVisibleItems += visibleCardsInSection.length;
            } else {
                section.style.display = 'none';
            }
        });

        if (totalVisibleItems === 0 && searchTerm !== '') {
            noResultsMessage.classList.remove('hidden');
        } else {
            noResultsMessage.classList.add('hidden');
        }
    });
});
</script>
</body>
</html>