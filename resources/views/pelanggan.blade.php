<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Pelanggan - B2B Fashion</title>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #0f172a; color: white; padding: 40px; }
        .container { max-width: 1000px; margin: auto; background: #1e293b; padding: 30px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        h2 { color: #38bdf8; border-bottom: 2px solid #334155; padding-bottom: 10px; margin-top: 0; }
        p { color: #94a3b8; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #0f172a; border-radius: 8px; overflow: hidden; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #334155; }
        th { background-color: #38bdf8; color: #0f172a; font-weight: bold; }
        td { color: #e2e8f0; }
        .badge { padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-success { background: #10b981; color: white; }
        .btn { padding: 8px 12px; background-color: #38bdf8; color: #0f172a; text-decoration: none; border-radius: 5px; font-size: 14px; font-weight: bold; }
        .btn:hover { background-color: #0ea5e9; }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Pelanggan B2B (Grosir & Distributor)</h2>
    <p>Halaman manajemen data mitra pelanggan sistem B2B Fashion.</p>
    
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
        <tbody>
            <tr>
                <td>CUST-B2B-001</td>
                <td>Toko Makmur Sandang</td>
                <td>Distributor Wilayah</td>
                <td><span class="badge badge-success">Aktif</span></td>
                <td><a href="#" class="btn">Kelola</a></td>
            </tr>
            <tr>
                <td>CUST-B2B-002</td>
                <td>Grosir Pakaian Jaya Bengkulu</td>
                <td>Reseller Besar</td>
                <td><span class="badge badge-success">Aktif</span></td>
                <td><a href="#" class="btn">Kelola</a></td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>