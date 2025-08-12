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
        
        body { font-family: 'Inter', sans-serif; }
        :root {
            --bg-primary: #F9FAFB;
            --bg-secondary: #FFFFFF;
            --accent-primary: #6366F1;
            --accent-hover: #4F46E5;
            --text-primary: #1F2937;
            --text-secondary: #6B7280;
            --border-color: #E5E7EB;
        }
        .formula-display {
            background-color: #F3F4F6; color: var(--text-primary);
            font-weight: 600; letter-spacing: 0.025em;
            display: flex; align-items: center; justify-content: center;
            height: 100%; border-radius: 0.5rem; text-align: center; padding: 0.5rem;
        }
        .modal-enter { animation: fadeIn 0.3s ease-out; }
        .modal-leave { animation: fadeOut 0.3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        @keyframes fadeOut { from { opacity: 1; transform: scale(1); } to { opacity: 0; transform: scale(0.95); } }
        
        .search-bar-container.is-sticky .search-bar-inner {
            background-color: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            box-shadow: 0 2px 4px -2px rgb(0 0 0 / 0.08);
            border-bottom: 1px solid var(--border-color);
        }
    </style>
</head>
<body class="bg-[var(--bg-primary)] text-[var(--text-primary)]">

<div class="container mx-auto p-4 md:p-8 max-w-7xl">
    
    <header class="mb-8 text-center pt-4 md:pt-8">
        <h1 class="text-3xl md:text-4xl font-bold text-[var(--text-primary)]">Katalog Barang Laboratorium</h1>
        <p class="text-base md:text-lg text-[var(--text-secondary)] mt-2">Pilih barang yang ingin Anda pinjam.</p>
    </header>

    <div id="search-container" class="search-bar-container sticky top-0 z-30 mb-8 transition-all duration-300 ease-in-out">
        <div class="search-bar-inner py-3 md:py-4 transition-all duration-300 ease-in-out">
            <div class="relative max-w-2xl mx-auto">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <i class="fa-solid fa-search"></i>
                </span>
                <input type="text" id="searchInput" placeholder="Cari nama alat atau bahan..."
                       class="w-full py-3 pl-12 pr-4 border border-gray-300 rounded-full shadow-sm focus:ring-2 focus:ring-[var(--accent-primary)] focus:border-[var(--accent-primary)] transition">
            </div>
        </div>
    </div>

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
            <h2 class="text-xl md:text-2xl font-bold text-[var(--text-primary)] border-b-2 border-[var(--border-color)] pb-3 mb-6">Alat Laboratorium</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach ($alats as $item)
                <div class="item-card relative bg-[var(--bg-secondary)] rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105 duration-300 flex flex-col">
                    @if($item->stok <= 0)
                    <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-10 p-2">
                        <span class="text-sm md:text-base font-bold text-red-600 border-2 border-red-500 bg-white px-3 py-1 rounded-md">Stok Habis</span>
                    </div>
                    @endif
                    <div class="h-36 md:h-48 bg-gray-100 flex items-center justify-center">
                         @if(!empty($item->images))
                             <img src="{{ asset('storage/' . $item->images[0]) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                         @else
                             <i class="fa-solid fa-flask fa-3x text-gray-400"></i>
                         @endif
                    </div>
                    <div class="p-3 flex flex-col flex-grow">
                        <h3 class="font-semibold text-base truncate item-name">{{ $item->nama }}</h3>
                        <p class="text-xs text-[var(--text-secondary)] mb-2">Stok: <span class="font-medium text-gray-800">{{ $item->stok }}</span> unit</p>
                        <button class="add-to-cart-btn mt-auto w-full bg-[var(--accent-primary)] text-white py-2 px-3 rounded-md font-semibold text-sm hover:bg-[var(--accent-hover)] transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed" data-id="Alat-{{ $item->id }}" data-nama="{{ $item->nama }}" data-stok="{{ $item->stok }}" data-unit="unit" data-tipe="Alat" @if($item->stok <= 0) disabled @endif>
                            <i class="fa-solid fa-plus mr-1"></i> Tambah
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <section id="bahan-padat" class="catalog-section mt-10 md:mt-12">
            <h2 class="text-xl md:text-2xl font-bold text-[var(--text-primary)] border-b-2 border-[var(--border-color)] pb-3 mb-6">Bahan Padat</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                @foreach ($bahan_padats as $item)
                <div class="item-card relative bg-[var(--bg-secondary)] rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105 duration-300 flex flex-col">
                    @if($item->sisa_bahan <= 0)
                    <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-10 p-2">
                        <span class="text-sm md:text-base font-bold text-red-600 border-2 border-red-500 bg-white px-3 py-1 rounded-md">Habis</span>
                    </div>
                    @endif
                    <div class="h-36 md:h-48 p-2 md:p-4">
                        <div class="formula-display text-2xl md:text-4xl">
                            {!! !empty($item->rumus_kimia) ? $item->rumus_kimia : '<i class="fa-solid fa-cubes text-gray-400"></i>' !!}
                        </div>
                    </div>
                    <div class="p-3 flex flex-col flex-grow">
                        <h3 class="font-semibold text-base truncate item-name">{{ $item->nama }}</h3>
                        <p class="text-xs text-[var(--text-secondary)] mb-2">Sisa: <span class="font-medium text-gray-800">{{ $item->sisa_bahan }}</span> {{ $item->unit }}</p>
                        <button class="add-to-cart-btn mt-auto w-full bg-[var(--accent-primary)] text-white py-2 px-3 rounded-md font-semibold text-sm hover:bg-[var(--accent-hover)] transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed" data-id="BahanPadat-{{ $item->id }}" data-nama="{{ $item->nama }}" data-stok="{{ $item->sisa_bahan }}" data-unit="{{ $item->unit }}" data-tipe="BahanPadat" @if($item->sisa_bahan <= 0) disabled @endif>
                            <i class="fa-solid fa-plus mr-1"></i> Tambah
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>

        <section id="bahan-cair" class="catalog-section mt-10 md:mt-12">
            <h2 class="text-xl md:text-2xl font-bold text-[var(--text-primary)] border-b-2 border-[var(--border-color)] pb-3 mb-6">Bahan Cair</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
                 @foreach ($bahan_cairan_lamas as $item)
                 <div class="item-card relative bg-[var(--bg-secondary)] rounded-lg shadow-md overflow-hidden transform transition-transform hover:scale-105 duration-300 flex flex-col">
                    @if($item->sisa_bahan <= 0)
                    <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center z-10 p-2">
                        <span class="text-sm md:text-base font-bold text-red-600 border-2 border-red-500 bg-white px-3 py-1 rounded-md">Habis</span>
                    </div>
                    @endif
                    <div class="h-36 md:h-48 p-2 md:p-4">
                        <div class="formula-display text-2xl md:text-4xl">
                           {!! !empty($item->rumus_kimia) ? $item->rumus_kimia : '<i class="fa-solid fa-vial text-gray-400"></i>' !!}
                        </div>
                    </div>
                    <div class="p-3 flex flex-col flex-grow">
                        <h3 class="font-semibold text-base truncate item-name">{{ $item->nama }}</h3>
                        <p class="text-xs text-[var(--text-secondary)] mb-2">Sisa: <span class="font-medium text-gray-800">{{ $item->sisa_bahan }}</span> {{ $item->unit }}</p>
                        <button class="add-to-cart-btn mt-auto w-full bg-[var(--accent-primary)] text-white py-2 px-3 rounded-md font-semibold text-sm hover:bg-[var(--accent-hover)] transition-colors disabled:bg-gray-400 disabled:cursor-not-allowed" data-id="BahanCairanLama-{{ $item->id }}" data-nama="{{ $item->nama }}" data-stok="{{ $item->sisa_bahan }}" data-unit="{{ $item->unit }}" data-tipe="BahanCairanLama" @if($item->sisa_bahan <= 0) disabled @endif>
                           <i class="fa-solid fa-plus mr-1"></i> Tambah
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
        
        <div id="no-results-message" class="text-center py-16 hidden">
            <i class="fa-solid fa-box-open fa-4x text-gray-300"></i>
            <h3 class="mt-4 text-xl font-semibold text-gray-800">Tidak Ada Hasil</h3>
            <p class="mt-2 text-gray-500">Kami tidak dapat menemukan barang yang cocok.</p>
        </div>
    </div>
</div>

<button id="cart-button" class="fixed bottom-5 right-5 bg-[var(--accent-primary)] text-white w-14 h-14 md:w-16 md:h-16 rounded-full shadow-lg flex items-center justify-center text-2xl transform transition-transform hover:scale-110">
    <i class="fa-solid fa-clipboard-list"></i>
    <span id="cart-item-count" class="absolute -top-1 -right-1 bg-red-600 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center border-2 border-white">0</span>
</button>

<div id="cart-modal-overlay" class="fixed inset-0 bg-black bg-opacity-60 z-40 hidden">
    <div id="cart-modal" class="modal-enter fixed inset-0 flex items-center justify-center p-4">
        <form id="loan-form" action="{{ route('pinjam.store') }}" method="POST" class="bg-[var(--bg-secondary)] rounded-xl shadow-2xl w-full max-w-lg max-h-[90vh] flex flex-col">
            @csrf
            <div class="flex justify-between items-center p-4 md:p-5 border-b border-[var(--border-color)]">
                <h2 class="text-xl md:text-2xl font-bold">Daftar Peminjaman</h2>
                <button type="button" id="close-modal-btn" class="text-gray-400 hover:text-gray-800 text-3xl">&times;</button>
            </div>
            
            <div class="p-4 md:p-6 overflow-y-auto">
                <div id="cart-items-container"></div>
                <div id="cart-empty-message" class="text-center py-10">
                    <i class="fa-solid fa-list-ul fa-3x text-gray-300"></i>
                    <p class="mt-4 text-[var(--text-secondary)]">Daftar peminjaman masih kosong.</p>
                </div>
                
                <div id="borrower-form-container" class="mt-6 pt-6 border-t border-[var(--border-color)]" style="display: none;">
                    <h3 class="text-lg md:text-xl font-bold mb-4">Data Diri Peminjam</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" id="nama_peminjam" name="nama_peminjam" required value="{{ old('nama_peminjam') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--accent-primary)] focus:border-[var(--accent-primary)] sm:text-sm">
                        </div>
                        <div>
                            <label for="nim_peminjam" class="block text-sm font-medium text-gray-700">NIM <span class="text-red-500">*</span></label>
                            <input type="text" id="nim_peminjam" name="nim_peminjam" required value="{{ old('nim_peminjam') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--accent-primary)] focus:border-[var(--accent-primary)] sm:text-sm">
                        </div>
                        <div class="md:col-span-2">
                            <label for="no_hp" class="block text-sm font-medium text-gray-700">Nomor HP Aktif <span class="text-red-500">*</span></label>
                            <input type="tel" id="no_hp" name="no_hp" required value="{{ old('no_hp') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-[var(--accent-primary)] focus:border-[var(--accent-primary)] sm:text-sm">
                        </div>
                    </div>
                </div>
                <div id="hidden-inputs-for-cart"></div>
            </div>
            
            <div id="modal-footer" class="p-4 md:p-5 border-t border-[var(--border-color)] bg-gray-50 rounded-b-xl" style="display: none;">
                <button type="submit" id="submit-loan-btn" class="w-full bg-[var(--accent-primary)] text-white py-3 px-6 rounded-lg font-semibold text-base md:text-lg hover:bg-[var(--accent-hover)] transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--accent-primary)]">
                    <i class="fa-solid fa-paper-plane mr-2"></i> Ajukan Peminjaman
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const listButton = document.getElementById('cart-button');
    const listModalOverlay = document.getElementById('cart-modal-overlay');
    const listModal = document.getElementById('cart-modal');
    const closeModalBtn = document.getElementById('close-modal-btn');
    const listItemCount = document.getElementById('cart-item-count');
    const listItemsContainer = document.getElementById('cart-items-container');
    const listEmptyMessage = document.getElementById('cart-empty-message');
    const borrowerFormContainer = document.getElementById('borrower-form-container');
    const modalFooter = document.getElementById('modal-footer');
    const mainForm = document.getElementById('loan-form');
    const hiddenInputsContainer = document.getElementById('hidden-inputs-for-cart');
    let loanList = {}; 

    const toggleModal = (show) => {
        if (show) {
            listModalOverlay.classList.remove('hidden');
            document.body.style.overflow = 'hidden'; 
            listModal.classList.remove('modal-leave');
            listModal.classList.add('modal-enter');
        } else {
            listModal.classList.remove('modal-enter');
            listModal.classList.add('modal-leave');
            setTimeout(() => {
                listModalOverlay.classList.add('hidden');
                document.body.style.overflow = ''; 
            }, 300);
        }
    };

    const renderList = () => {
        listItemsContainer.innerHTML = '';
        const items = Object.values(loanList);
        
        if (items.length === 0) {
            listEmptyMessage.style.display = 'block';
            borrowerFormContainer.style.display = 'none';
            modalFooter.style.display = 'none';
        } else {
            listEmptyMessage.style.display = 'none';
            borrowerFormContainer.style.display = 'block';
            modalFooter.style.display = 'block';
            
            items.forEach(item => {
                const itemElement = document.createElement('div');
                itemElement.className = 'flex flex-wrap items-center justify-between gap-x-4 gap-y-2 py-3 border-b border-gray-200';
                const step = item.tipe === 'Alat' ? '1' : '0.01';
                
                itemElement.innerHTML = `
                    <div class="flex-grow min-w-[120px]">
                        <p class="font-semibold text-gray-800">${item.nama}</p>
                        <p class="text-sm text-gray-500">Stok: ${item.stok} ${item.unit}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <button type="button" class="quantity-change-btn w-7 h-7 md:w-8 md:h-8 rounded-full bg-gray-200 hover:bg-gray-300 font-bold flex-shrink-0" data-id="${item.id}" data-change="-1">-</button>
                        <input type="number" value="${item.quantity}" min="1" max="${item.stok}" step="${step}" class="w-16 md:w-20 text-center border-gray-300 rounded-md quantity-input" data-id="${item.id}">
                        <button type="button" class="quantity-change-btn w-7 h-7 md:w-8 md:h-8 rounded-full bg-gray-200 hover:bg-gray-300 font-bold flex-shrink-0" data-id="${item.id}" data-change="1">+</button>
                    </div>
                    <button type="button" class="remove-item-btn text-red-500 hover:text-red-700 text-lg ml-auto md:ml-0" data-id="${item.id}"><i class="fa-solid fa-trash-can"></i></button>
                `;
                listItemsContainer.appendChild(itemElement);
            });
        }
        listItemCount.textContent = items.length;
        listItemCount.style.display = items.length > 0 ? 'flex' : 'none';
    };
    
    const addItemToList = (button) => {
        const data = button.dataset;
        if (loanList[data.id]) {
            Swal.fire({ toast: true, position: 'top-end', icon: 'info', title: 'Barang sudah di daftar', showConfirmButton: false, timer: 1500 });
            return;
        }
        loanList[data.id] = { id: data.id, nama: data.nama, stok: parseFloat(data.stok), unit: data.unit, tipe: data.tipe, quantity: 1 };
        renderList();
        Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Ditambahkan ke daftar', showConfirmButton: false, timer: 1500 });
    };
    
    const changeItemQuantity = (id, change) => {
        if (!loanList[id]) return;
        const item = loanList[id];
        const step = item.tipe === 'Alat' ? 1 : 0.01;
        let newQuantity = parseFloat((item.quantity + (change * step)).toFixed(2));

        if (newQuantity >= step && newQuantity <= item.stok) {
            item.quantity = newQuantity;
        } else if (newQuantity > item.stok) {
            item.quantity = item.stok;
            Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Melebihi stok!', showConfirmButton: false, timer: 1500 });
        } else {
            removeItemFromList(id);
        }
        renderList();
    };
    const removeItemFromList = (id) => {
        delete loanList[id];
        renderList();
    };
    listButton.addEventListener('click', () => toggleModal(true));
    closeModalBtn.addEventListener('click', () => toggleModal(false));
    listModalOverlay.addEventListener('click', (e) => { if (e.target === listModalOverlay) toggleModal(false); });
    document.querySelectorAll('.add-to-cart-btn').forEach(button => { button.addEventListener('click', (e) => { e.preventDefault(); addItemToList(e.currentTarget); }); });
    
    listItemsContainer.addEventListener('click', e => {
        const button = e.target.closest('button');
        if (!button) return;
        const id = button.dataset.id;
        if (button.classList.contains('quantity-change-btn')) {
            changeItemQuantity(id, parseInt(button.dataset.change));
        } else if (button.classList.contains('remove-item-btn')) {
            removeItemFromList(id);
        }
    });

    listItemsContainer.addEventListener('input', e => {
        if (e.target.classList.contains('quantity-input')) {
            const id = e.target.dataset.id;
            if (!loanList[id]) return;

            let newQuantity = parseFloat(e.target.value);
            
            if (isNaN(newQuantity) || newQuantity < 0) {
                newQuantity = 1;
            }
            if (newQuantity > loanList[id].stok) {
                newQuantity = loanList[id].stok;
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Melebihi stok!', showConfirmButton: false, timer: 1500 });
            }
            if (newQuantity === 0) {
                 removeItemFromList(id);
                 renderList();
                 return;
            }
            loanList[id].quantity = newQuantity;
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
        Object.values(loanList).forEach((item, index) => {
            const [type, id] = item.id.split('-');
            hiddenInputsContainer.innerHTML += `
                <input type="hidden" name="items[${index}][item_id]" value="${id}">
                <input type="hidden" name="items[${index}][item_type]" value="${type}">
                <input type="hidden" name="items[${index}][jumlah_pinjam]" value="${item.quantity}">
            `;
        });
        Swal.fire({
            title: 'Konfirmasi Peminjaman',
            text: `Anda akan mengajukan peminjaman untuk ${Object.keys(loanList).length} jenis barang. Lanjutkan?`,
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
    
    // --- PERUBAHAN LOGIKA PENCARIAN DIMULAI DI SINI ---
    const searchInput = document.getElementById('searchInput');
    const allSections = document.querySelectorAll('.catalog-section');
    const noResultsMessage = document.getElementById('no-results-message');
    
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        let totalVisibleItems = 0;
        
        allSections.forEach(section => {
            let visibleCardsInSection = 0;
            const cardsInSection = section.querySelectorAll('.item-card');
            
            cardsInSection.forEach(card => {
                // Ambil teks dari nama barang
                const itemName = card.querySelector('.item-name').textContent.toLowerCase();
                
                // Ambil teks dari rumus kimia (jika ada)
                const formulaElement = card.querySelector('.formula-display');
                const itemFormula = formulaElement ? formulaElement.textContent.toLowerCase() : '';

                // Cek apakah nama ATAU rumus kimia cocok dengan pencarian
                const isVisible = itemName.includes(searchTerm) || (itemFormula && itemFormula.includes(searchTerm));
                
                card.style.display = isVisible ? 'flex' : 'none';
                
                if (isVisible) {
                    visibleCardsInSection++;
                }
            });

            if (visibleCardsInSection > 0) {
                section.style.display = '';
                totalVisibleItems += visibleCardsInSection;
            } else {
                section.style.display = 'none';
            }
        });

        noResultsMessage.style.display = (totalVisibleItems === 0 && searchTerm !== '') ? 'block' : 'none';
    });
    // --- PERUBAHAN LOGIKA PENCARIAN BERAKHIR DI SINI ---


    const searchContainer = document.getElementById('search-container');
    if(searchContainer) {
        const stickyThreshold = searchContainer.offsetTop; 
        window.addEventListener('scroll', () => {
            if (window.scrollY > stickyThreshold) {
                searchContainer.classList.add('is-sticky');
            } else {
                searchContainer.classList.remove('is-sticky');
            }
        });
    }

    renderList();
});
</script>
</body>
</html>