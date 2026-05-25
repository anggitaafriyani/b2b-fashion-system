<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan B2B</title>

    <style>
        body { 
            background: #0f172a; 
            font-family: 'Segoe UI'; 
            color: #e2e8f0; 
            margin: 0; 
        }
        .wrapper { max-width: 1200px; margin: auto; padding: 40px 20px; }
        .box { background: #1e293b; padding: 30px; border-radius: 12px; }
        .title { color: #38bdf8; font-size: 28px; font-weight: bold; margin-bottom: 10px; }
        .subtitle { color: #94a3b8; margin-bottom: 20px; }

        .btn { background: #38bdf8; color: black; padding: 10px 15px; border: none; border-radius: 8px; cursor: pointer; }
        .btn:hover { background: #0ea5e9; color: white; }

        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        th { background: #38bdf8; color: black; padding: 12px; }
        td { padding: 12px; border-bottom: 1px solid #334155; }

        .btn-del { background: red; color: white; padding: 5px 10px; border: none; border-radius: 6px; cursor: pointer; }
        .btn-edit { background: orange; color: black; padding: 5px 10px; border: none; border-radius: 6px; cursor: pointer; }

        /* MODAL */
        .modal { display: none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.7); }
        .modal-content { background:#1e293b; padding:20px; width:400px; margin:10% auto; border-radius:10px; }

        input { width:100%; padding:10px; margin-bottom:10px; border-radius:6px; border:none; }
    </style>
</head>

<body>

<div class="wrapper">
    <div class="box">

        <div class="title">Data Pesanan B2B</div>
        <div class="subtitle">Manajemen pesanan sistem B2B Fashion</div>

        <button class="btn" onclick="openModal()">+ Tambah Pesanan</button>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody id="tableData">
                <tr><td colspan="6">Loading...</td></tr>
            </tbody>
        </table>

    </div>
</div>

<!-- MODAL TAMBAH -->
<div id="modal" class="modal">
    <div class="modal-content">
        <h3>Tambah Pesanan</h3>

        <input type="text" id="nama" placeholder="Nama Pelanggan">
        <input type="text" id="produk" placeholder="Produk">
        <input type="number" id="jumlah" placeholder="Jumlah">
        <input type="text" id="status" placeholder="Status">

        <button class="btn" onclick="tambah()">Simpan</button>
        <button onclick="closeModal()">Tutup</button>
    </div>
</div>

<!-- MODAL EDIT -->
<div id="modalEdit" class="modal">
    <div class="modal-content">
        <h3>Edit Pesanan</h3>

        <input type="hidden" id="edit_id">
        <input type="text" id="edit_nama" placeholder="Nama Pelanggan">
        <input type="text" id="edit_produk" placeholder="Produk">
        <input type="number" id="edit_jumlah" placeholder="Jumlah">
        <input type="text" id="edit_status" placeholder="Status">

        <button class="btn" onclick="update()">Update</button>
        <button onclick="closeEdit()">Tutup</button>
    </div>
</div>

<script>
let data = [];

// LOAD DATA
function load() {
    fetch('/api/pesanan')
    .then(res => res.json())
    .then(res => {
        data = res.data;

        let html = '';
        if(data.length > 0){
            data.forEach(p => {
                html += `
                <tr>
                    <td>${p.id}</td>
                    <td>${p.nama_pelanggan}</td>
                    <td>${p.produk}</td>
                    <td>${p.jumlah}</td>
                    <td>${p.status}</td>
                    <td>
                        <button class="btn-edit" onclick="edit(${p.id})">Edit</button>
                        <button class="btn-del" onclick="hapus(${p.id})">Hapus</button>
                    </td>
                </tr>`;
            });
        } else {
            html = `<tr><td colspan="6">Belum ada data</td></tr>`;
        }

        document.getElementById('tableData').innerHTML = html;
    });
}

// TAMBAH
function tambah() {
    let data = {
        nama_pelanggan: document.getElementById('nama').value,
        produk: document.getElementById('produk').value,
        jumlah: document.getElementById('jumlah').value,
        status: document.getElementById('status').value
    };

    fetch('/api/pesanan', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(() => {
        closeModal();
        load();
    });
}

// EDIT (AMBIL DATA)
function edit(id) {
    let p = data.find(x => x.id === id);

    document.getElementById('edit_id').value = p.id;
    document.getElementById('edit_nama').value = p.nama_pelanggan;
    document.getElementById('edit_produk').value = p.produk;
    document.getElementById('edit_jumlah').value = p.jumlah;
    document.getElementById('edit_status').value = p.status;

    document.getElementById('modalEdit').style.display = 'block';
}

// UPDATE
function update() {
    let id = document.getElementById('edit_id').value;

    let data = {
        nama_pelanggan: document.getElementById('edit_nama').value,
        produk: document.getElementById('edit_produk').value,
        jumlah: document.getElementById('edit_jumlah').value,
        status: document.getElementById('edit_status').value
    };

    fetch('/api/pesanan/' + id, {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(data)
    })
    .then(() => {
        closeEdit();
        load();
    });
}

// HAPUS
function hapus(id) {
    fetch('/api/pesanan/' + id, {
        method: 'DELETE'
    })
    .then(() => load());
}

// MODAL
function openModal() {
    document.getElementById('modal').style.display = 'block';
}

function closeModal() {
    document.getElementById('modal').style.display = 'none';
}

function closeEdit() {
    document.getElementById('modalEdit').style.display = 'none';
}

load();
</script>

</body>
</html>