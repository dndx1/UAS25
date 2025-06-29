<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="section dashboard">
  <div class="card">
    <div class="card-body pt-3">
      <form method="get" action="<?= base_url('admin/laporan/penjualan') ?>" class="row g-3 mb-4">
        <div class="col-md-4">
          <label for="start_date" class="form-label">Dari Tanggal</label>
          <input type="date" class="form-control" name="start_date" value="<?= esc($start_date) ?>">
        </div>
        <div class="col-md-4">
          <label for="end_date" class="form-label">Sampai Tanggal</label>
          <input type="date" class="form-control" name="end_date" value="<?= esc($end_date) ?>">
        </div>
        <div class="col-md-4 d-flex align-items-end">
          <button type="submit" class="btn btn-primary me-2">Tampilkan</button>
          <?php if ($start_date && $end_date): ?>
            <a href="<?= base_url('admin/laporan/penjualan/periodik/pdf?start_date=' . $start_date . '&end_date=' . $end_date) ?>" 
               class="btn btn-danger btn-sm">
              <i class="bi bi-file-pdf"></i> Export PDF
            </a>
          <?php endif; ?>
        </div>
      </form>

      <?php if (!empty($penjualan)): ?>
        <!-- Summary Cards -->
        <div class="row mb-4">
          <?php 
          $totalItems = count($penjualan);
          $totalQuantity = array_sum(array_column($penjualan, 'total_terjual'));
          $totalRevenue = array_sum(array_column($penjualan, 'total_pendapatan'));
          ?>
          <div class="col-md-4">
            <div class="card text-center">
              <div class="card-body">
                <h5 class="card-title text-primary"><?= $totalItems ?></h5>
                <p class="card-text">Jenis Produk Terjual</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center">
              <div class="card-body">
                <h5 class="card-title text-success"><?= number_format($totalQuantity) ?> pcs</h5>
                <p class="card-text">Total Kuantitas</p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card text-center">
              <div class="card-body">
                <h5 class="card-title text-info">Rp <?= number_format($totalRevenue, 0, ',', '.') ?></h5>
                <p class="card-text">Total Pendapatan</p>
              </div>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead class="table-light">
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Total Terjual</th>
              <th>Total Pendapatan (Rp)</th>
              <th>Persentase</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            $grand_total = 0;
            foreach ($penjualan as $row): 
              $grand_total += $row->total_pendapatan;
            endforeach;
            
            foreach ($penjualan as $row): 
              $persentase = $grand_total > 0 ? ($row->total_pendapatan / $grand_total) * 100 : 0;
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($row->nama_produk) ?></td>
                <td><?= number_format($row->total_terjual) ?> pcs</td>
                <td><?= number_format($row->total_pendapatan, 0, ',', '.') ?></td>
                <td>
                  <div class="d-flex align-items-center">
                    <span class="me-2"><?= number_format($persentase, 1) ?>%</span>
                    <div class="progress flex-grow-1" style="height: 15px;">
                      <div class="progress-bar" role="progressbar" style="width: <?= $persentase ?>%"></div>
                    </div>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
          <tfoot>
            <tr class="table-dark">
              <th colspan="2" class="text-end">Total Pendapatan</th>
              <th><?= number_format($totalQuantity ?? 0) ?> pcs</th>
              <th><?= number_format($grand_total, 0, ',', '.') ?></th>
              <th>100%</th>
            </tr>
          </tfoot>
        </table>
      </div>

      <?php if (empty($penjualan)): ?>
        <div class="alert alert-info text-center">
          <i class="bi bi-info-circle"></i>
          <?php if ($start_date && $end_date): ?>
            Tidak ada data penjualan pada periode <?= date('d F Y', strtotime($start_date)) ?> - <?= date('d F Y', strtotime($end_date)) ?>
          <?php else: ?>
            Silakan pilih periode untuk melihat laporan penjualan
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?= $this->endSection() ?>