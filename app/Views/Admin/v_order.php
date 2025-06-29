<?= $this->extend('layout') ?>
<?= $this->section('content') ?>



<section class="section">
  <div class="card">
    <div class="card-body pt-4">
      <table class="table datatable">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Konsumen</th>
            <th>Email</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Tanggal</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1; foreach ($orders as $order): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($order['username']) ?></td>
              <td><?= esc($order['email']) ?></td>
              <td>Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></td>
              <td>
                <?php
                  $statusLabel = ['Menunggu', 'Diproses', 'Dikirim', 'Selesai', 'Dibatalkan'];
                  echo $statusLabel[$order['status']] ?? 'Tidak diketahui';
                ?>
              </td>
              <td><?= date('d-m-Y H:i', strtotime($order['created_at'])) ?></td>
              <td>
                <a href="<?= base_url('admin/order/detail/' . $order['id']) ?>" class="btn btn-sm btn-info">Detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</section>

<?= $this->endSection() ?>
