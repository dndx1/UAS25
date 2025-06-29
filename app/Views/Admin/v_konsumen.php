<?= $this->extend('layout') ?>
<?= $this->section('content') ?>



<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body pt-4">

          <table class="table datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Jumlah Transaksi</th>
                <th>Total Belanja (Rp)</th>
                <th>Terdaftar Sejak</th>
              </tr>
            </thead>
            <tbody>
             <?php $no = 1; foreach ($konsumen as $row): ?>
  <tr>
    <td><?= $no++ ?></td>
    <td><?= esc($row['username']) ?></td> <!-- ganti dari 'nama' ke 'username' -->
    <td><?= esc($row['email']) ?></td>
    <td><?= esc($row['total_transaksi']) ?></td>
    <td><?= number_format($row['total_belanja'], 0, ',', '.') ?></td>
    <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
  </tr>
<?php endforeach; ?>

            </tbody>
          </table>

        </div>
      </div>

    </div>
  </div>
</section>

<?= $this->endSection() ?>
