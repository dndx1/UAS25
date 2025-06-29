<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="section dashboard">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title">Laporan Pendapatan Periodik</h5>
      
      <form method="get" action="<?= base_url('admin/laporan/pendapatan') ?>">
        <div class="row mb-3">
          <div class="col-md-4">
            <label class="form-label">Dari Tanggal</label>
            <input type="date" name="tanggal_mulai" class="form-control" value="<?= $tanggal_mulai ?>">
          </div>
          <div class="col-md-4">
            <label class="form-label">Sampai Tanggal</label>
            <input type="date" name="tanggal_akhir" class="form-control" value="<?= $tanggal_akhir ?>">
          </div>
          <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary me-2">Tampilkan</button>
            <?php if ($tanggal_mulai && $tanggal_akhir): ?>
              <a href="<?= base_url('admin/laporan/pendapatan/pdf?tanggal_mulai=' . $tanggal_mulai . '&tanggal_akhir=' . $tanggal_akhir) ?>" 
                 target="_blank" class="btn btn-danger">
                <i class="bi bi-file-pdf"></i> Export PDF
              </a>
            <?php endif; ?>
          </div>
        </div>
      </form>

      <?php if ($pendapatan): ?>
        <!-- Summary Card -->
        <?php 
        $grandTotal = 0;
        foreach ($pendapatan as $row): 
          $grandTotal += $row['total_pendapatan'];
        endforeach;
        ?>
        <div class="row mb-3">
          <div class="col-md-6">
            <div class="card text-center bg-light">
              <div class="card-body">
                <h5 class="card-title text-success">Total Pendapatan</h5>
                <h3 class="text-primary">Rp <?= number_format($grandTotal, 0, ',', '.') ?></h3>
                <small class="text-muted">
                  Periode: <?= date('d/m/Y', strtotime($tanggal_mulai)) ?> - <?= date('d/m/Y', strtotime($tanggal_akhir)) ?>
                </small>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card text-center bg-light">
              <div class="card-body">
                <h5 class="card-title text-info">Jumlah Hari</h5>
                <h3 class="text-primary"><?= count($pendapatan) ?> Hari</h3>
                <small class="text-muted">
                  Rata-rata: Rp <?= number_format(count($pendapatan) > 0 ? $grandTotal / count($pendapatan) : 0, 0, ',', '.') ?>/hari
                </small>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="table-dark">
              <tr>
                <th width="10%">No</th>
                <th width="40%">Tanggal</th>
                <th width="50%">Total Pendapatan (Rp)</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pendapatan as $i => $row): ?>
              <tr>
                <td class="text-center"><?= $i + 1 ?></td>
                <td><?= date('d/m/Y', strtotime($row['tanggal'])) ?></td>
                <td class="text-end"><?= number_format($row['total_pendapatan'], 0, ',', '.') ?></td>
              </tr>
              <?php endforeach ?>
            </tbody>
            <tfoot>
              <tr class="table-success">
                <th colspan="2" class="text-end">Total Keseluruhan</th>
                <th class="text-end"><?= number_format($grandTotal, 0, ',', '.') ?></th>
              </tr>
            </tfoot>
          </table>
        </div>
      <?php elseif ($tanggal_mulai && $tanggal_akhir): ?>
        <div class="alert alert-warning text-center">
          <i class="bi bi-exclamation-triangle"></i>
          Tidak ada data pendapatan pada periode <?= date('d/m/Y', strtotime($tanggal_mulai)) ?> - <?= date('d/m/Y', strtotime($tanggal_akhir)) ?>
        </div>
      <?php else: ?>
        <div class="alert alert-info text-center">
          <i class="bi bi-info-circle"></i>
          Silakan pilih periode tanggal untuk melihat laporan pendapatan
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<?= $this->endSection() ?>