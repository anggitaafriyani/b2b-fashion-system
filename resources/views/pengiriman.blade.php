@extends('layouts.app')

@section('content')

<style>
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

    .product-box {
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
        font-weight: 600;
        cursor: pointer;
    }

    .btn-main:hover {
        background: #0284c7;
        color: white;
    }

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

    .price {
        font-weight: 700;
        color: #38bdf8;
    }

    .action {
        display: flex;
        gap: 10px;
    }

    .btn-edit,
    .btn-delete {
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

    .btn-delete {
        background: transparent;
        color: #ef4444;
        border: 1px solid #ef4444;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
    }

    /* MODAL STYLES */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(15, 23, 42, 0.8);
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: #1e293b;
        padding: 30px;
        border-radius: 12px;
        width: 100%;
        max-width: 500px;
        border: 1px solid #334155;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3);
    }

    .modal-title {
        font-size: 20px;
        font-weight: 700;
        color: #38bdf8;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #94a3b8;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        background: #0f172a;
        border: 1px solid #334155;
        border-radius: 6px;
        color: white;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #38bdf8;
    }

    .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 25px;
    }

    .btn-secondary {
        background: #475569;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
    }
</style>

<div class="wrapper">
    <div class="product-box">

        <div class="title">Data Pengiriman B2B</div>
        <div class="subtitle">
            Halaman manajemen pengiriman pesanan grosir & distributor.
        </div>

        <div class="top-action">
            <div></div>
            <!-- Trigger Modal Tambah -->
            <button class="btn-main" onclick="bukaModal('tambah')">+ Tambah Pengiriman</button>
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID Kirim</th>
                    <th>Kode Pesanan</th>
                    <th>Pelanggan</th>
                    <th>Ekspedisi</th>
                    <th>No Resi</th>
                    <th>Ongkir</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="data-pengiriman">
                <tr>
                    <td colspan="8" style="text-align:center;">
                        Sedang memuat data...
                    </td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<!-- MODAL FORM (TAMBAH / EDIT) -->
<div id="formModal" class="modal">
    <div class="modal-content">
        <div class="modal-title" id="modalTitle">Tambah Pengiriman</div>
        <form id="pengirimanForm" onsubmit="simpanData(event)">
            <input type="hidden" id="pengiriman_id">
            
            <div class="form-group">
                <label for="kode_pesanan">Kode Pesanan</label>
                <input type="text" id="kode_pesanan" class="form-control" required placeholder="Contoh: INV-20260501">
            </div>

            <div class="form-group">
                <label for="nama_pelanggan">Nama Pelanggan</label>
                <input type="text" id="nama_pelanggan" class="form-control" required placeholder="Nama Distributor / Toko">
            </div>

            <div class="form-group">
                <label for="ekspedisi">Ekspedisi</label>
                <input type="text" id="ekspedisi" class="form-control" required placeholder="Contoh: JNE Cargo, J&T Cargo">
            </div>

            <div class="form-group">
                <label for="no_resi">No Resi</label>
                <input type="text" id="no_resi" class="form-control" placeholder="Isi '-' jika belum ada">
            </div>

            <div class="form-group">
                <label for="ongkir">Ongkos Kirim (Rp)</label>
                <input type="number" id="ongkir" class="form-control" required placeholder="Contoh: 150000">
            </div>

            <div class="form-group">
                <label for="status_pengiriman">Status Pengiriman</label>
                <select id="status_pengiriman" class="form-control">
                    <option value="Diproses">Diproses</option>
                    <option value="Dikirim">Dikirim</option>
                    <option value="Selesai">Selesai</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="tutupModal()">Batal</button>
                <button type="submit" class="btn-main">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID').format(angka ?? 0);
    }

    // Ambil Data Utama
    function muatPengiriman() {
        fetch('/api/pengiriman')
            .then(response => {
                if (!response.ok) throw new Error();
                return response.json();
            })
            .then(res => {
                const tbody = document.getElementById('data-pengiriman');
                const data = Array.isArray(res) ? res : (res.data ?? []);
                let html = '';

                if (data.length > 0) {
                    data.forEach(item => {
                        html += `
                            <tr>
                                <td>#KRM-00${item.id}</td>
                                <td>${item.kode_pesanan ?? '-'}</td>
                                <td>${item.nama_pelanggan ?? '-'}</td>
                                <td>${item.ekspedisi ?? '-'}</td>
                                <td>${item.no_resi ?? '-'}</td>
                                <td class="price">Rp ${formatRupiah(item.ongkir)}</td>
                                <td><span style="padding: 4px 8px; border-radius: 4px; background: #334155; font-size: 12px;">${item.status_pengiriman ?? '-'}</span></td>
                                <td>
                                    <div class="action">
                                        <button class="btn-edit" onclick="bukaModal('edit', ${JSON.stringify(item).replace(/"/g, '&quot;')})">Edit</button>
                                        <button class="btn-delete" onclick="hapusPengiriman(${item.id})">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = `<tr><td colspan="8" style="text-align:center; color:#94a3b8;">Belum ada data pengiriman</td></tr>`;
                }
                tbody.innerHTML = html;
            })
            .catch(() => {
                document.getElementById('data-pengiriman').innerHTML = `
                    <tr><td colspan="8" style="text-align:center; color:#ef4444;">Gagal memuat data pengiriman (API tidak merespon)</td></tr>
                `;
            });
    }

    // Kontrol Modal Box
    // Kontrol Modal Box (Tambah / Edit)
    function bukaModal(tipe, data = null) {
        const modal = document.getElementById('formModal');
        const title = document.getElementById('modalTitle');
        const form = document.getElementById('pengirimanForm');
        
        form.reset();
        modal.style.display = "flex";

        if (tipe === 'tambah') {
            title.innerText = "Tambah Pengiriman Baru";
            document.getElementById('pengiriman_id').value = "";
        } else if (tipe === 'edit' && data) {
            title.innerText = "Edit Data Pengiriman";
            document.getElementById('pengiriman_id').value = data.id;
            document.getElementById('kode_pesanan').value = data.kode_pesanan;
            document.getElementById('nama_pelanggan').value = data.nama_pelanggan;
            document.getElementById('ekspedisi').value = data.ekspedisi;
            document.getElementById('no_resi').value = data.no_resi;
            document.getElementById('ongkir').value = data.ongkir;
            document.getElementById('status_pengiriman').value = data.status_pengiriman;
        }
    }

    function tutupModal() {
        document.getElementById('formModal').style.display = "none";
    }

    // Aksi Simpan Data (Handle Tambah & Edit)
    function simpanData(event) {
        event.preventDefault();
        
        const id = document.getElementById('pengiriman_id').value;
        const payload = {
            kode_pesanan: document.getElementById('kode_pesanan').value,
            nama_pelanggan: document.getElementById('nama_pelanggan').value,
            ekspedisi: document.getElementById('ekspedisi').value,
            no_resi: document.getElementById('no_resi').value,
            ongkir: document.getElementById('ongkir').value,
            status_pengiriman: document.getElementById('status_pengiriman').value,
        };

        // Jika ada ID berarti EDIT (PUT), jika kosong berarti TAMBAH (POST)
        const url = id ? `/api/pengiriman/${id}` : '/api/pengiriman';
        const method = id ? 'PUT' : 'POST';

        fetch(url, {
            method: method,
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(response => {
            if (!response.ok) throw new Error();
            alert(id ? 'Data berhasil diubah!' : 'Data berhasil ditambahkan!');
            tutupModal();
            muatPengiriman(); // Refresh tabel otomatis
        })
        .catch(() => {
            alert('Gagal menyimpan data! Hubungkan dulu ke API Controller backend Anda.');
        });
    }

    // Aksi Hapus Data
    function hapusPengiriman(id) {
        if (confirm('Apakah Anda yakin ingin menghapus data pengiriman ini?')) {
            fetch(`/api/pengiriman/${id}`, { method: 'DELETE' })
                .then(response => {
                    if (!response.ok) throw new Error();
                    alert('Data berhasil dihapus!');
                    muatPengiriman(); // Refresh tabel otomatis
                })
                .catch(() => {
                    alert('Gagal menghapus data! Pastikan API Controller backend Anda merespon permintaan DELETE.');
                });
        }
    }

    // Muat data pengiriman saat halaman siap
    muatPengiriman();
</script>   
@endsection