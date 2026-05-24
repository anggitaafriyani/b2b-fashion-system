<style>
    /* CSS Tema Dark Mode Premium khas Awin */
    body { 
        background: #0f172a; 
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
        color: #e2e8f0; 
        margin: 0; 
    }
    .wrapper { 
        max-width: 1200px; 
        margin: auto; 
        padding: 40px 20px; 
    }
    .customer-box { 
        background: #1e293b; 
        border-radius: 12px; 
        padding: 35px; 
        box-shadow: 0 10px 25px rgba(0,0,0,0.5); 
    }
    .title { 
        color: #38bdf8; 
        font-size: 28px; 
        font-weight: 700; 
        margin-bottom: 12px; 
    }
    .subtitle { 
        color: #94a3b8; 
        margin-bottom: 30px; 
        border-bottom: 1px solid #334155; 
        padding-bottom: 20px; 
        font-size: 15px; 
    }
    .top-action { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 25px; 
        flex-wrap: wrap; 
        gap: 15px; 
    }
    .btn-main { 
        background: #38bdf8; 
        color: #0f172a; 
        border: none; 
        padding: 10px 20px; 
        border-radius: 8px; 
        text-decoration: none; 
        font-weight: 600; 
        transition: 0.3s; 
        cursor: pointer; 
    }
    .btn-main:hover { 
        background: #0284c7; 
        color: white; 
    }
    
    /* Styling Tabel Dark Mode */
    table { 
        width: 100%; 
        border-collapse: collapse; 
        overflow: hidden; 
        border-radius: 8px; 
    }
    thead { 
        background: #38bdf8; 
    }
    thead th { 
        padding: 15px; 
        text-align: left; 
        font-size: 15px; 
        color: #0f172a; 
        font-weight: 700; 
    }
    tbody { 
        background: #1e293b; 
    }
    tbody tr { 
        border-bottom: 1px solid #334155; 
        transition: 0.2s; 
    }
    tbody tr:hover { 
        background: #334155; 
    }
    tbody td { 
        padding: 15px; 
        color: #f8fafc; 
        font-size: 14px; 
    }
    
    /* Badge Status Aktif Hijau */
    .badge-aktif {
        background: #16a34a;
        color: white;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    
    .action { 
        display: flex; 
        gap: 10px; 
    }
    .btn-edit, .btn-delete { 
        text-align: center; 
        padding: 8px 15px; 
        border-radius: 6px; 
        font-size: 13px; 
        font-weight: 600; 
        border: none; 
        cursor: pointer; 
    }
    .btn-edit { 
        background: #38bdf8; 
        color: #0f172a; 
    }
    .btn-edit:hover { 
        background: #0ea5e9; 
        color: white; 
    }
    .btn-delete { 
        background: transparent; 
        color: #ef4444; 
        border: 1px solid #ef4444; 
    }
    .btn-delete:hover { 
        background: #ef4444; 
        color: white; 
    }

    /* POP-UP MODAL STYLING */
    .modal { display: none; position: fixed; z-index: 100; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); }
    .modal-content { background-color: #1e293b; margin: 10% auto; padding: 30px; border-radius: 12px; width: 400px; border: 1px solid #334155; }
    .form-group { margin-bottom: 15px; }
    .form-group label { display: block; margin-bottom: 5px; color: #94a3b8; font-size: 14px; }
    .form-group input, .form-group select { width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #334155; background: #0f172a; color: white; box-sizing: border-box; }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #334155; padding-bottom: 10px;}
    .close { color: #ef4444; font-size: 24px; font-weight: bold; cursor: pointer; }
</style>

<div class="wrapper">
    <div class="customer-box">
        <div class="title">Data Pelanggan B2B (Grosir & Distributor)</div>
        <div class="subtitle">Halaman manajemen data mitra pelanggan sistem B2B Fashion.</div>
        
        <div class="top-action">
            <div></div>
            <div>
                <button onclick="bukaModalTambah()" class="btn-main">+ Tambah Mitra</button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Pelanggan</th>
                    <th>Nama Toko / Mitra</th>
                    <th>Kategori</th>
                    <th>Status Akun</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="data-pelanggan">
                <tr><td colspan="5" style="text-align: center; padding: 20px;">Sedang memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="margin:0; color:#38bdf8;">Tambah Mitra Pelanggan</h3>
            <span class="close" onclick="tutupModalTambah()">&times;</span>
        </div>
        <form id="formTambah" onsubmit="tambahPelanggan(event)">
            <div class="form-group">
                <label>Nama Toko / Mitra</label>
                <input type="text" id="tambah_nama" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select id="tambah_kategori" required>
                    <option value="Distributor Wilayah">Distributor Wilayah</option>
                    <option value="Reseller Besar">Reseller Besar</option>
                    <option value="Grosir Retail">Grosir Retail</option>
                </select>
            </div>
            <div class="form-group">
                <label>Status Akun</label>
                <select id="tambah_status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Non-Aktif">Non-Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn-main" style="width:100%; margin-top:10px;">Simpan Mitra</button>
        </form>
    </div>
</div>

<div id="modalEdit" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="margin:0; color:#38bdf8;">Edit Data Mitra</h3>
            <span class="close" onclick="tutupModalEdit()">&times;</span>
        </div>
        <form id="formEdit" onsubmit="simpanEditPelanggan(event)">
            <input type="hidden" id="edit_id">
            <div class="form-group">
                <label>Nama Toko / Mitra</label>
                <input type="text" id="edit_nama" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <select id="edit_kategori" required>
                    <option value="Distributor Wilayah">Distributor Wilayah</option>
                    <option value="Reseller Besar">Reseller Besar</option>
                    <option value="Grosir Retail">Grosir Retail</option>
                </select>
            </div>
            <div class="form-group">
                <label>Status Akun</label>
                <select id="edit_status" required>
                    <option value="Aktif">Aktif</option>
                    <option value="Non-Aktif">Non-Aktif</option>
                </select>
            </div>
            <button type="submit" class="btn-main" style="width:100%; margin-top:10px;">Update Data</button>
        </form>
    </div>
</div>

<script>
    let dataPelangganGlobal = [];

    // 1. READ DATA
    function muatData() {
        fetch('/api/pelanggan')
            .then(response => response.json())
            .then(res => {
                let tableBody = document.getElementById('data-pelanggan');
                let html = '';
                
                if(res.status === 'success' && res.data.length > 0) {
                    dataPelangganGlobal = res.data;
                    res.data.forEach(customer => {
                        html += `
                        <tr>
                            <td>CUST-B2B-00${customer.id}</td>
                            <td>${customer.name}</td>
                            <td>${customer.category}</td>
                            <td><span class="badge-aktif">${customer.status}</span></td>
                            <td>
                                <div class="action">
                                    <button class="btn-edit" onclick="siapkanEdit(${customer.id})">Kelola</button>
                                    <button class="btn-delete" onclick="hapusPelanggan(${customer.id})">Hapus</button>
                                </div>
                            </td>
                        </tr>`;
                    });
                } else {
                    dataPelangganGlobal = [];
                    html = '<tr><td colspan="5" style="text-align: center; color: #94a3b8;">Belum ada data pelanggan B2B</td></tr>';
                }
                tableBody.innerHTML = html;
            });
    }

    // 2. CREATE DATA
    function tambahPelanggan(event) {
        event.preventDefault();
        let data = {
            name: document.getElementById('tambah_nama').value,
            category: document.getElementById('tambah_kategori').value,
            status: document.getElementById('tambah_status').value
        };

        fetch('/api/pelanggan', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                alert('Mitra Baru Sukses Terdaftar!');
                tutupModalTambah();
                document.getElementById('formTambah').reset();
                muatData();
            }
        });
    }

    // 3. AMBIL DATA KELOLA (PRE-EDIT)
    function siapkanEdit(id) {
        let customer = dataPelangganGlobal.find(c => c.id === id);
        if(customer) {
            document.getElementById('edit_id').value = customer.id;
            document.getElementById('edit_nama').value = customer.name;
            document.getElementById('edit_kategori').value = customer.category;
            document.getElementById('edit_status').value = customer.status;
            document.getElementById('modalEdit').style.display = 'block';
        }
    }

    // 4. UPDATE DATA
    function simpanEditPelanggan(event) {
        event.preventDefault();
        let id = document.getElementById('edit_id').value;
        let data = {
            name: document.getElementById('edit_nama').value,
            category: document.getElementById('edit_kategori').value,
            status: document.getElementById('edit_status').value
        };

        fetch('/api/pelanggan/' + id, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                alert('Data Mitra Berhasil Diperbarui!');
                tutupModalEdit();
                muatData();
            }
        });
    }

    // 5. DELETE DATA
    function hapusPelanggan(id) {
        if(confirm('Hapus mitra pelanggan ini dari sistem?')) {
            fetch('/api/pelanggan/' + id, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            })
            .then(response => response.json())
            .then(res => {
                if(res.status === 'success') {
                    alert('Mitra berhasil dihapus.');
                    muatData();
                }
            });
        }
    }

    function bukaModalTambah() { document.getElementById('modalTambah').style.display = 'block'; }
    function tutupModalTambah() { document.getElementById('modalTambah').style.display = 'none'; }
    function tutupModalEdit() { document.getElementById('modalEdit').style.display = 'none'; }

    muatData();
</script>