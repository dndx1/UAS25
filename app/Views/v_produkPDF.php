<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: center;
            color: #333;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .summary {
            margin-top: 20px;
            padding: 10px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
        }
        .summary-item {
            display: inline-block;
            margin-right: 20px;
        }
    </style>
</head>
<body>
    <h1>Laporan Data Produk</h1>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Produk</th>
                <th width="15%">Kategori</th>
                <th width="15%">Harga Jual</th>
                <th width="15%">Harga Beli</th>
                <th width="10%">Stok</th>
                <th width="15%">Keuntungan/Unit</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $totalProduk = 0;
            $totalStok = 0;
            $totalKeuntungan = 0;
            foreach ($product as $index => $produk): 
                $keuntungan = $produk['harga'] - $produk['harga_beli'];
                $totalProduk++;
                $totalStok += $produk['jumlah'];
                $totalKeuntungan += ($keuntungan * $produk['jumlah']);
            ?>
                <tr>
                    <td class="text-center"><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($produk['nama']) ?></td>
                    <td class="text-center"><?= htmlspecialchars($produk['kategori']) ?></td>
                    <td class="text-right"><?= "Rp " . number_format($produk['harga'], 0, ",", ".") ?></td>
                    <td class="text-right"><?= "Rp " . number_format($produk['harga_beli'], 0, ",", ".") ?></td>
                    <td class="text-center"><?= $produk['jumlah'] ?></td>
                    <td class="text-right"><?= "Rp " . number_format($keuntungan, 0, ",", ".") ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="summary">
        <h3>Ringkasan</h3>
        <div class="summary-item">
            <strong>Total Produk:</strong> <?= $totalProduk ?> jenis
        </div>
        <div class="summary-item">
            <strong>Total Stok:</strong> <?= number_format($totalStok, 0, ",", ".") ?> unit
        </div>
        <div class="summary-item">
            <strong>Potensi Keuntungan:</strong> Rp <?= number_format($totalKeuntungan, 0, ",", ".") ?>
        </div>
    </div>

    <div class="footer">
        <p>Laporan dibuat pada <?= date("d F Y H:i:s") ?></p>
    </div>
</body>
</html>