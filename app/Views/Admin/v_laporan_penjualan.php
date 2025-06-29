<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="section dashboard">
  <div class="row">

    <!-- Statistik -->
    <div class="col-lg-4 col-md-6">
      <div class="card info-card sales-card">
        <div class="card-body">
          <h5 class="card-title">Total Transaksi</h5>
          <div class="d-flex align-items-center">
            <div class="ps-3">
              <h6><?= $totalTransaksi ?></h6>
              <span class="text-muted small pt-2">Transaksi</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6">
      <div class="card info-card revenue-card">
        <div class="card-body">
          <h5 class="card-title">Total Pendapatan</h5>
          <div class="d-flex align-items-center">
            <div class="ps-3">
              <h6>Rp <?= number_format($totalPendapatan, 0, ',', '.') ?></h6>
              <span class="text-muted small pt-2">Seluruh transaksi</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6">
      <div class="card info-card customers-card">
        <div class="card-body">
          <h5 class="card-title">Produk Terjual</h5>
          <div class="d-flex align-items-center">
            <div class="ps-3">
              <h6><?= $totalProduk ?> pcs</h6>
              <span class="text-muted small pt-2">Seluruh transaksi</span>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Export Section -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Export Laporan</h5>
      <div class="row">
        <div class="col-md-6">
          <a href="<?= base_url('admin/laporan/penjualan/global/pdf') ?>" class="btn btn-danger btn-sm" target="_blank">
  <i class="bi bi-file-pdf"></i> Export PDF Laporan Global
</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Tabel Transaksi -->
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Daftar Transaksi</h5>
      <table class="table datatable">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Konsumen</th>
            <th>Tanggal</th>
            <th>Total Harga</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($transaksi as $row): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($row['username']) ?></td>
              <td><?= date('d-m-Y H:i', strtotime($row['created_at'])) ?></td>
              <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
              <td>
                <?php
                  $status = ['Menunggu', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
                  echo $status[$row['status']] ?? 'Tidak diketahui';
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

</section>

<?= $this->endSection() ?>