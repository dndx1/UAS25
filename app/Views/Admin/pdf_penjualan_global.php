<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan Global</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px;
            font-size: 12px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        
        .header h1 {
            margin: 0;
            font-size: 18px;
            color: #333;
            font-weight: bold;
        }
        
        .header p {
            margin: 5px 0;
            font-size: 10px;
            color: #666;
        }
        
        .summary-section {
            margin: 20px 0;
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #ddd;
        }
        
        .summary-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #333;
            text-align: center;
        }
        
        .summary-grid {
            display: flex;
            justify-content: space-between;
        }
        
        .summary-item {
            text-align: center;
            flex: 1;
            padding: 0 10px;
        }
        
        .summary-item h3 {
            margin: 0;
            font-size: 16px;
            color: #007bff;
        }
        
        .summary-item p {
            margin: 5px 0 0 0;
            font-size: 10px;
            color: #666;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        
        th, td { 
            border: 1px solid #ddd; 
            padding: 8px; 
            text-align: left; 
        }
        
        th { 
            background-color: #f2f2f2; 
            font-weight: bold;
            text-align: center;
            font-size: 11px;
        }
        
        td {
            font-size: 10px;
        }
        
        .text-center {
            text-align: center;
        }
        
        .text-right {
            text-align: right;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
        
        .table-title {
            font-size: 14px;
            font-weight: bold;
            margin: 20px 0 10px 0;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENJUALAN GLOBAL</h1>
        <p>Tanggal Cetak: <?= date('d F Y H:i:s') ?></p>
        <p>Laporan keseluruhan penjualan dan transaksi</p>
    </div>
    
    <div class="summary-section">
        <div class="summary-title">RINGKASAN PENJUALAN</div>
        <div class="summary-grid">
            <div class="summary-item">
                <h3><?= $totalTransaksi ?></h3>
                <p>Total Transaksi</p>
            </div>
            <div class="summary-item">
                <h3>Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></h3>
                <p>Total Pendapatan</p>
            </div>
            <div class="summary-item">
                <h3><?= $totalProduk ?> pcs</h3>
                <p>Produk Terjual</p>
            </div>
        </div>
    </div>

    <div class="table-title">DAFTAR TRANSAKSI</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Konsumen</th>
                <th width="20%">Tanggal</th>
                <th width="25%">Total Harga (Rp)</th>
                <th width="25%">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($transaksi as $row): ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= esc($row['username']) ?></td>
                    <td class="text-center"><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                    <td class="text-right"><?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                    <td class="text-center">
                        <?php
                        $status = ['Menunggu', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
                        echo $status[$row['status']] ?? 'Tidak diketahui';
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div class="footer">
        <p>Laporan digenerate secara otomatis oleh sistem pada <?= date('d F Y H:i:s') ?></p>
    </div>
</body>
</html>