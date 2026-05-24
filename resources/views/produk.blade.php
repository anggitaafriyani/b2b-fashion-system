<style>
    /* CSS Tema Dark Mode */
    body { background: #0f172a; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #e2e8f0; margin: 0; }
    .wrapper { max-width: 1200px; margin: auto; padding: 40px 20px; }
    .product-box { background: #1e293b; border-radius: 12px; padding: 35px; box-shadow: 0 10px 25px rgba(0,0,0,0.5); }
    .title { color: #38bdf8; font-size: 28px; font-weight: 700; margin-bottom: 12px; }
    .subtitle { color: #94a3b8; margin-bottom: 30px; border-bottom: 1px solid #334155; padding-bottom: 20px; font-size: 15px; }
    .top-action { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px; }
    .btn-main { background: #38bdf8; color: #0f172a; border: none; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; transition: 0.3s; cursor: pointer; }
    .btn-main:hover { background: #0284c7; color: white; }
    table { width: 100%; border-collapse: collapse; overflow: hidden; border-radius: 8px; }
    thead { background: #38bdf8; }
    thead th { padding: 15px; text-align: left; font-size: 15px; color: #0f172a; font-weight: 700; }
    tbody { background: #1e293b; }
    tbody tr { border-bottom: 1px solid #334155; transition: 0.2s; }
    tbody tr:hover { background: #334155; }
    tbody td { padding: 15px; color: #f8fafc; font-size: 14px; }
    .price { font-weight: 700; color: #38bdf8; }
    .action { display: flex; gap: 10px; }
    .btn-edit, .btn-delete { text-align: center; padding: 8px 15px; border-radius: 6px; font-size: 13px; font-weight: 600; border: none; cursor: pointer; }
    .btn-edit { background: #38bdf8; color: #0f172a; }
    .btn-edit:hover { background: #0ea5e9; color: white; }
    .btn-delete { background: transparent; color: #ef4444; border: 1px solid #ef4444; }
    .btn-delete:hover { background: #ef4444; color: white; }

    /* CSS MODAL (POP-UP) */
    .modal { display: none; position: fixed; z-index: 100; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); }
    .modal-content { background-color: #1e293b; margin: 10% auto; padding: 30px; border-radius: 12px; width: 400px; border: 1px solid #334155; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; color: #94a3b8; font-size: 14px; }
    .form-group input, .form-group textarea { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #334155; background: #0f172a; color: white; box-sizing: border-box; }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #334155; padding-bottom: 10px;}
    .close { color: #ef4444; font-size: 24px; font-weight: bold; cursor: pointer; }
</style>

<div class="wrapper">
    <div class="product-box">
        <div class="title">Data Produk B2B</div>
        <div class="subtitle">Halaman manajemen produk fashion grosir & distributor.</div>
        <div class="top-action">
            <div></div>
            <div style="display:flex; gap:10px;">
                <button onclick="bukaModalTambah()" class="btn-main">+ Tambah Produk</button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Produk</th>
                    <th>Nama Produk</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="data-produk">
                <tr><td colspan="5" style="text-align: center; padding: 20px;">Sedang memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="margin:0; color:#38bdf8;">Tambah Produk</h3>
            <span class="close" onclick="tutupModalTambah()">&times;</span>
        </div>
        <form id="formTambah" onsubmit="tambahProduk(event)">
            <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" id="tambah_nama" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="tambah_deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" id="tambah_harga" required min="0">
            </div>
            <button type="submit" class="btn-main" style="width:100%; margin-top:10px;">Simpan Produk</button>
        </form>
    </div>
</div>

<div id="modalEdit" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="margin:0; color:#38bdf8;">Edit Produk</h3>
            <span class="close" onclick="tutupModalEdit()">&times;</span>
        </div>
        <form id="formEdit" onsubmit="simpanEditProduk(event)">
            <input type="hidden" id="edit_id"> <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" id="edit_nama" required>
            </div>
            <div class="form-group">
                <label>Deskripsi</label>
                <textarea id="edit_deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label>Harga (Rp)</label>
                <input type="number" id="edit_harga" required min="0">
            </div>
            <button type="submit" class="btn-main" style="width:100%; margin-top:10px;">Update Produk</button>
        </form>
    </div>
</div>

<script>
    // Variabel buat nyimpen data sementara biar Edit gampang
    let dataProdukGlobal = []; 

    // 1. FUNGSI NAMPILIN DATA (READ)
    function muatData() {
        fetch('/api/products')
            .then(response => response.json())
            .then(res => {
                let tableBody = document.getElementById('data-produk');
                let html = '';
                
                if(res.status === 'success' && res.data.length > 0) {
                    dataProdukGlobal = res.data; // Simpan ke variabel global
                    
                    res.data.forEach(product => {
                        let formatHarga = new Intl.NumberFormat('id-ID').format(product.price);
                        html += `
                        <tr>
                            <td>#PRD-00${product.id}</td>
                            <td>${product.name}</td>
                            <td>${product.description}</td>
                            <td class="price">Rp ${formatHarga}</td>
                            <td>
                                <div class="action">
                                    <button class="btn-edit" onclick="siapkanEdit(${product.id})">Edit</button>
                                    <button class="btn-delete" onclick="hapusProduk(${product.id})">Hapus</button>
                                </div>
                            </td>
                        </tr>`;
                    });
                } else {
                    dataProdukGlobal = [];
                    html = '<tr><td colspan="5" style="text-align: center; color: #94a3b8;">Belum ada data produk</td></tr>';
                }
                tableBody.innerHTML = html;
            });
    }

    // 2. FUNGSI TAMBAH DATA (CREATE)
    function tambahProduk(event) {
        event.preventDefault(); 
        let data = {
            name: document.getElementById('tambah_nama').value,
            description: document.getElementById('tambah_deskripsi').value,
            price: document.getElementById('tambah_harga').value
        };

        fetch('/api/products', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                alert('Berhasil! Produk baru ditambahkan.');
                tutupModalTambah(); 
                document.getElementById('formTambah').reset(); 
                muatData(); 
            }
        });
    }

    // 3. FUNGSI MENYIAPKAN FORM EDIT
    function siapkanEdit(id) {
        // Cari data produk berdasarkan ID di variabel global
        let produk = dataProdukGlobal.find(p => p.id === id);
        if(produk) {
            // Isi form dengan data yang ditarik
            document.getElementById('edit_id').value = produk.id;
            document.getElementById('edit_nama').value = produk.name;
            document.getElementById('edit_deskripsi').value = produk.description;
            document.getElementById('edit_harga').value = produk.price;
            
            // Tampilkan pop up edit
            document.getElementById('modalEdit').style.display = 'block';
        }
    }

    // 4. FUNGSI SIMPAN UPDATE DATA (UPDATE)
    function simpanEditProduk(event) {
        event.preventDefault();
        let id = document.getElementById('edit_id').value;
        let data = {
            name: document.getElementById('edit_nama').value,
            description: document.getElementById('edit_deskripsi').value,
            price: document.getElementById('edit_harga').value
        };

        fetch('/api/products/' + id, {
            method: 'PUT', // Pakai PUT untuk update
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                alert('Mantap! Produk berhasil di-update.');
                tutupModalEdit();
                muatData();
            }
        });
    }

    // 5. FUNGSI HAPUS DATA (DELETE)
    function hapusProduk(id) {
        if(confirm('Yakin mau dihapus produknya?')) {
            fetch('/api/products/' + id, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            })
            .then(response => response.json())
            .then(res => {
                if(res.status === 'success') {
                    alert('Produk berhasil dihapus!');
                    muatData(); 
                }
            });
        }
    }

    // Fungsi Buka/Tutup Modal
    function bukaModalTambah() { document.getElementById('modalTambah').style.display = 'block'; }
    function tutupModalTambah() { document.getElementById('modalTambah').style.display = 'none'; }
    function tutupModalEdit() { document.getElementById('modalEdit').style.display = 'none'; }

    // Mulai narik data
    muatData();
</script>