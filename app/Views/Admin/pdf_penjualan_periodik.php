<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan Periodik</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0;
            font-size: 10px;
            color: #666;
        }
        .period-info {
            background-color: #f8f9fa;
            padding: 15px;
            border: 1px solid #ddd;
            margin: 20px 0;
            text-align: center;
        }
        .period-info h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
        }
        .period-dates {
            font-size: 12px;
            font-weight: bold;
            color: #007bff;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
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
        .footer-table {
            background-color: #e9ecef;
            font-weight: bold;
        }
        .summary-box {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 15px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .summary-box h4 {
            margin: 0 0 10px 0;
            color: #155724;
            font-size: 14px;
        }
        .summary-item {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
            font-size: 12px;
        }
        .summary-value {
            font-weight: bold;
            color: #155724;
        }
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PENJUALAN PERIODIK</h1>
        <p>Tanggal Cetak: <?= date('d F Y H:i:s') ?></p>
        <p>Laporan penjualan produk berdasarkan periode tertentu</p>
    </div>

    <div class="period-info">
        <h3>Periode Laporan</h3>
        <div class="period-dates">
            <?php if ($start_date && $end_date): ?>
                <?= date('d F Y', strtotime($start_date)) ?> - <?= date('d F Y', strtotime($end_date)) ?>
            <?php else: ?>
                Semua Data
            <?php endif; ?>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center" style="width: 5%;">No</th>
                <th style="width: 40%;">Nama Produk</th>
                <th class="text-center" style="width: 15%;">Total Terjual</th>
                <th class="text-right" style="width: 25%;">Total Pendapatan (Rp)</th>
                <th class="text-center" style="width: 15%;">Persentase</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $grandTotal = 0;
            $totalQty = 0;
            
            // Hitung grand total dan total qty untuk persentase
            foreach ($penjualan as $row) {
                $grandTotal += $row->total_pendapatan;
                $totalQty += $row->total_terjual;
            }
            
            foreach ($penjualan as $row): 
                $persentase = $grandTotal > 0 ? ($row->total_pendapatan / $grandTotal) * 100 : 0;
            ?>
                <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= esc($row->nama_produk) ?></td>
                    <td class="text-center"><?= number_format($row->total_terjual) ?> pcs</td>
                    <td class="text-right">Rp <?= number_format($row->total_pendapatan, 0, ',', '.') ?></td>
                    <td class="text-center"><?= number_format($persentase, 1) ?>%</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="footer-table">
                <th colspan="2" class="text-right">TOTAL</th>
                <th class="text-center"><?= number_format($totalQty) ?> pcs</th>
                <th class="text-right">Rp <?= number_format($grandTotal, 0, ',', '.') ?></th>
                <th class="text-center">100%</th>
            </tr>
        </tfoot>
    </table>

    <div class="summary-box">
        <h4>Ringkasan Laporan</h4>
        <div class="summary-item">
            <span>Jumlah Produk yang Terjual:</span>
            <span class="summary-value"><?= count($penjualan) ?> Jenis Produk</span>
        </div>
        <div class="summary-item">
            <span>Total Kuantitas Terjual:</span>
            <span class="summary-value"><?= number_format($totalQty) ?> pcs</span>
        </div>
        <div class="summary-item">
            <span>Total Pendapatan:</span>
            <span class="summary-value">Rp <?= number_format($grandTotal, 0, ',', '.') ?></span>
        </div>
        <div class="summary-item">
            <span>Rata-rata per Produk:</span>
            <span class="summary-value">Rp <?= number_format(count($penjualan) > 0 ? $grandTotal / count($penjualan) : 0, 0, ',', '.') ?></span>
        </div>
    </div>

    <div class="footer">
        <p>Laporan digenerate secara otomatis oleh sistem pada <?= date('d F Y H:i:s') ?></p>
    </div>
</body>
</html>