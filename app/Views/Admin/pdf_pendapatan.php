<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pendapatan</title>
    <meta charset="UTF-8">
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
            padding-bottom: 10px;
        }
        
        .header h2 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }
        
        .periode {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
        }
        
        th, td { 
            border: 1px solid #000; 
            padding: 8px; 
            text-align: left; 
        }
        
        th { 
            background-color: #f0f0f0; 
            font-weight: bold;
            text-align: center;
        }
        
        td.number {
            text-align: right;
        }
        
        td.center {
            text-align: center;
        }
        
        tfoot th {
            background-color: #e0e0e0;
            font-weight: bold;
        }
        
        .no-data {
            text-align: center;
            font-style: italic;
            color: #666;
            padding: 20px;
        }
        
        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENDAPATAN</h2>
    </div>
    
    <div class="periode">
        Periode: <?= date('d/m/Y', strtotime($tanggal_mulai)) ?> s/d <?= date('d/m/Y', strtotime($tanggal_akhir)) ?>
    </div>

    <?php if (!empty($pendapatan)) : ?>
    <table>
        <thead>
            <tr>
                <th width="10%">No</th>
                <th width="40%">Tanggal</th>
                <th width="50%">Total Pendapatan (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php $grandTotal = 0; ?>
            <?php foreach ($pendapatan as $i => $row) : ?>
                <?php $grandTotal += (float)$row['total_pendapatan']; ?>
                <tr>
                    <td class="center"><?= $i + 1 ?></td>
                    <td class="center"><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                    <td class="number"><?= number_format($row['total_pendapatan'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="2">TOTAL KESELURUHAN</th>
                <th class="number"><?= number_format($grandTotal, 0, ',', '.') ?></th>
            </tr>
        </tfoot>
    </table>
    <?php else: ?>
        <div class="no-data">
            <p>Tidak ada data pendapatan untuk periode <?= date('d/m/Y', strtotime($tanggal_mulai)) ?> s/d <?= date('d/m/Y', strtotime($tanggal_akhir)) ?></p>
        </div>
    <?php endif; ?>
    
    <div class="footer">
        <p>Dicetak pada: <?= date('d/m/Y H:i:s') ?></p>
    </div>
</body>
</html>