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
    
    /* Badge Status */
    .badge-status {
        background: #16a34a;
        color: white;
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 12px;
        font-weight: 600;
    }
    .badge-pending { background: #eab308; }
    .badge-gagal { background: #ef4444; }
    
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
    .modal { display: none; position: fixed; z-index: 100; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7); overflow-y: auto; }
    .modal-content { background-color: #1e293b; margin: 3% auto; padding: 20px 25px; border-radius: 12px; width: 400px; border: 1px solid #334155; }
    .form-group { margin-bottom: 10px; }
    .form-group label { display: block; margin-bottom: 4px; color: #94a3b8; font-size: 13px; }
    .form-group input, .form-group select { width: 100%; padding: 8px 10px; border-radius: 6px; border: 1px solid #334155; background: #0f172a; color: white; box-sizing: border-box; font-size: 14px; }
    .modal-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #334155; padding-bottom: 10px;}
    .close { color: #ef4444; font-size: 24px; font-weight: bold; cursor: pointer; line-height: 1; }
</style>

<div class="wrapper">
    <div class="customer-box">
        <div class="title">Data Pembayaran B2B</div>
        <div class="subtitle">Halaman manajemen data transaksi pembayaran sistem B2B Fashion.</div>
        
        <div class="top-action">
            <div></div>
            <div>
                <button onclick="bukaModalTambah()" class="btn-main">+ Tambah Pembayaran</button>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No Invoice</th>
                    <th>ID Pelanggan</th>
                    <th>Total Tagihan</th>
                    <th>Metode</th>
                    <th>Bukti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="data-pembayaran">
                <tr><td colspan="7" style="text-align: center; padding: 20px;">Sedang memuat data...</td></tr>
            </tbody>
        </table>
    </div>
</div>

<div id="modalTambah" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="margin:0; color:#38bdf8; font-size: 18px;">Tambah Data Pembayaran</h3>
            <span class="close" onclick="tutupModalTambah()">&times;</span>
        </div>
        <form id="formTambah" onsubmit="tambahPembayaran(event)">
            <div class="form-group">
                <label>Pilih Pelanggan</label>
                <select id="tambah_pelanggan_id" required>
                    <option value="" disabled selected>Memuat pelanggan...</option>
                </select>
            </div>
            <div class="form-group">
                <label>No Invoice</label>
                <input type="text" id="tambah_no_invoice" required>
            </div>
            <div class="form-group">
                <label>Total Tagihan (Rp)</label>
                <input type="number" id="tambah_total_tagihan" required>
            </div>
            <div class="form-group">
                <label>Jumlah Dibayar (Rp)</label>
                <input type="number" id="tambah_jumlah_dibayar" value="0" required>
            </div>
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select id="tambah_metode" required>
                    <option value="transfer_bank">Transfer Bank</option>
                    <option value="dp">DP (Down Payment)</option>
                    <option value="termin">Termin</option>
                </select>
            </div>
            <div class="form-group">
                <label>Upload Bukti (Opsional - Max 2MB)</label>
                <input type="file" id="tambah_bukti" accept="image/*" style="padding: 5px;">
            </div>
            <div class="form-group">
                <label>Status Pembayaran</label>
                <select id="tambah_status" required>
                    <option value="Pending">Pending</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Gagal">Gagal</option>
                </select>
            </div>
            <button type="submit" class="btn-main" style="width:100%; margin-top:5px; padding: 10px;">Simpan Pembayaran</button>
        </form>
    </div>
</div>

<div id="modalEdit" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h3 style="margin:0; color:#38bdf8; font-size: 18px;">Edit Data Pembayaran</h3>
            <span class="close" onclick="tutupModalEdit()">&times;</span>
        </div>
        <form id="formEdit" onsubmit="simpanEditPembayaran(event)">
            <input type="hidden" id="edit_id">
            <div class="form-group">
                <label>Pilih Pelanggan</label>
                <select id="edit_pelanggan_id" required>
                    <option value="" disabled selected>Memuat pelanggan...</option>
                </select>
            </div>
            <div class="form-group">
                <label>No Invoice</label>
                <input type="text" id="edit_no_invoice" required>
            </div>
            <div class="form-group">
                <label>Total Tagihan (Rp)</label>
                <input type="number" id="edit_total_tagihan" required>
            </div>
            <div class="form-group">
                <label>Jumlah Dibayar (Rp)</label>
                <input type="number" id="edit_jumlah_dibayar" required>
            </div>
            <div class="form-group">
                <label>Metode Pembayaran</label>
                <select id="edit_metode" required>
                    <option value="transfer_bank">Transfer Bank</option>
                    <option value="dp">DP (Down Payment)</option>
                    <option value="termin">Termin</option>
                </select>
            </div>
            <div class="form-group">
                <label>Upload Bukti Baru (Kosongkan jika tidak diganti)</label>
                <input type="file" id="edit_bukti" accept="image/*" style="padding: 5px;">
            </div>
            <div class="form-group">
                <label>Status Pembayaran</label>
                <select id="edit_status" required>
                    <option value="Pending">Pending</option>
                    <option value="Lunas">Lunas</option>
                    <option value="Gagal">Gagal</option>
                </select>
            </div>
            <button type="submit" class="btn-main" style="width:100%; margin-top:5px; padding: 10px;">Update Data</button>
        </form>
    </div>
</div>

<script>
    let dataPembayaranGlobal = [];

    // 0. AMBIL DATA PELANGGAN UNTUK DROPDOWN
    function muatPelanggan() {
        fetch('/api/pelanggan')
            .then(response => response.json())
            .then(res => {
                let options = '<option value="" disabled selected>-- Pilih Pelanggan --</option>';
                if(res.status === 'success' && res.data.length > 0) {
                    res.data.forEach(p => {
                        options += `<option value="${p.id}">${p.name} (ID: ${p.id})</option>`;
                    });
                } else {
                    options = '<option value="" disabled>Belum ada data pelanggan</option>';
                }
                document.getElementById('tambah_pelanggan_id').innerHTML = options;
                document.getElementById('edit_pelanggan_id').innerHTML = options;
            });
    }

    // 1. READ DATA
    function muatData() {
        fetch('/api/pembayaran')
            .then(response => response.json())
            .then(res => {
                let tableBody = document.getElementById('data-pembayaran');
                let html = '';
                
                if(res.status === 'success' && res.data.length > 0) {
                    dataPembayaranGlobal = res.data;
                    res.data.forEach(payment => {
                        let statusClass = 'badge-status';
                        if(payment.status_pembayaran === 'Pending') statusClass += ' badge-pending';
                        if(payment.status_pembayaran === 'Gagal') statusClass += ' badge-gagal';

                        let buktiLink = payment.bukti_pembayaran ? `<a href="/${payment.bukti_pembayaran}" target="_blank" style="color:#38bdf8; text-decoration:none;">🖼️ Lihat</a>` : '-';

                        html += `
                        <tr>
                            <td>${payment.no_invoice}</td>
                            <td>CUST-B2B-00${payment.pelanggan_id}</td>
                            <td>Rp ${parseInt(payment.total_tagihan).toLocaleString('id-ID')}</td>
                            <td>${payment.metode_pembayaran}</td>
                            <td>${buktiLink}</td>
                            <td><span class="${statusClass}">${payment.status_pembayaran}</span></td>
                            <td>
                                <div class="action">
                                    <button class="btn-edit" onclick="siapkanEdit(${payment.id})">Kelola</button>
                                    <button class="btn-delete" onclick="hapusPembayaran(${payment.id})">Hapus</button>
                                </div>
                            </td>
                        </tr>`;
                    });
                } else {
                    dataPembayaranGlobal = [];
                    html = '<tr><td colspan="7" style="text-align: center; color: #94a3b8;">Belum ada data pembayaran</td></tr>';
                }
                tableBody.innerHTML = html;
            });
    }

    // 2. CREATE DATA (Diperbarui pakai FormData)
    function tambahPembayaran(event) {
        event.preventDefault();
        
        let formData = new FormData();
        formData.append('pelanggan_id', document.getElementById('tambah_pelanggan_id').value);
        formData.append('no_invoice', document.getElementById('tambah_no_invoice').value);
        formData.append('total_tagihan', document.getElementById('tambah_total_tagihan').value);
        formData.append('jumlah_dibayar', document.getElementById('tambah_jumlah_dibayar').value);
        formData.append('metode_pembayaran', document.getElementById('tambah_metode').value);
        formData.append('status_pembayaran', document.getElementById('tambah_status').value);

        let fileUpload = document.getElementById('tambah_bukti');
        if(fileUpload.files.length > 0) {
            formData.append('bukti_pembayaran', fileUpload.files[0]);
        }

        fetch('/api/pembayaran', {
            method: 'POST',
            headers: { 'Accept': 'application/json' }, // Tidak pakai Content-Type khusus agar file terbaca
            body: formData
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                alert('Data Pembayaran Baru Sukses Ditambahkan!');
                tutupModalTambah();
                document.getElementById('formTambah').reset();
                muatData();
            } else {
                alert('Gagal menambahkan: ' + (res.message || 'Cek kembali data Anda'));
            }
        });
    }

    // 3. AMBIL DATA KELOLA (PRE-EDIT)
    function siapkanEdit(id) {
        let payment = dataPembayaranGlobal.find(p => p.id === id);
        if(payment) {
            document.getElementById('edit_id').value = payment.id;
            document.getElementById('edit_pelanggan_id').value = payment.pelanggan_id;
            document.getElementById('edit_no_invoice').value = payment.no_invoice;
            document.getElementById('edit_total_tagihan').value = Math.floor(payment.total_tagihan);
            document.getElementById('edit_jumlah_dibayar').value = Math.floor(payment.jumlah_dibayar);
            document.getElementById('edit_metode').value = payment.metode_pembayaran;
            document.getElementById('edit_status').value = payment.status_pembayaran;
            document.getElementById('edit_bukti').value = ''; // Kosongkan form file sebelumnya
            document.getElementById('modalEdit').style.display = 'block';
        }
    }

    // 4. UPDATE DATA (Diperbarui pakai FormData & Method PUT)
    function simpanEditPembayaran(event) {
        event.preventDefault();
        let id = document.getElementById('edit_id').value;
        
        let formData = new FormData();
        formData.append('_method', 'PUT'); // Syarat dari Laravel untuk FormData Edit
        formData.append('pelanggan_id', document.getElementById('edit_pelanggan_id').value);
        formData.append('no_invoice', document.getElementById('edit_no_invoice').value);
        formData.append('total_tagihan', document.getElementById('edit_total_tagihan').value);
        formData.append('jumlah_dibayar', document.getElementById('edit_jumlah_dibayar').value);
        formData.append('metode_pembayaran', document.getElementById('edit_metode').value);
        formData.append('status_pembayaran', document.getElementById('edit_status').value);

        let fileUpload = document.getElementById('edit_bukti');
        if(fileUpload.files.length > 0) {
            formData.append('bukti_pembayaran', fileUpload.files[0]);
        }

        fetch('/api/pembayaran/' + id, {
            method: 'POST', // Wajib POST karena membawa _method=PUT
            headers: { 'Accept': 'application/json' },
            body: formData
        })
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                alert('Data Pembayaran Berhasil Diperbarui!');
                tutupModalEdit();
                muatData();
            } else {
                alert('Gagal memperbarui: ' + (res.message || 'Cek kembali data Anda'));
            }
        });
    }

    // 5. DELETE DATA
    function hapusPembayaran(id) {
        if(confirm('Hapus data pembayaran ini dari sistem?')) {
            fetch('/api/pembayaran/' + id, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            })
            .then(response => response.json())
            .then(res => {
                if(res.status === 'success') {
                    alert('Data pembayaran berhasil dihapus.');
                    muatData();
                }
            });
        }
    }

    function bukaModalTambah() { document.getElementById('modalTambah').style.display = 'block'; }
    function tutupModalTambah() { document.getElementById('modalTambah').style.display = 'none'; }
    function tutupModalEdit() { document.getElementById('modalEdit').style.display = 'none'; }

    muatData();
    muatPelanggan(); // Panggil fungsi muat dropdown
</script>