<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<section class="section">
    <div class="card">
        <div class="card-body pt-4">
            <?php if (session()->getFlashdata('message')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('message') ?>
                </div>
            <?php endif; ?>

            <table class="table datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Konsumen</th>
                      
                        <th>Total Harga</th>
                        <th>Bukti Bayar</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($orders as $order): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= esc($order['username']) ?></td>
                           
                            <td>Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></td>
                            
                            <!-- Bukti Bayar -->
                            <td>
                                <?php if (!empty($order['bukti_bayar'])): ?>
                                    <a href="<?= base_url('uploads/bukti/' . $order['bukti_bayar']) ?>" target="_blank" class="btn btn-sm btn-secondary">
                                        Lihat
                                    </a>
                                <?php else: ?>
                                    <span class="text-danger">Belum Ada</span>
                                <?php endif; ?>
                            </td>

                            <!-- Status Order -->
                            <td>
                                <form action="<?= base_url('admin/order/update_status/' . $order['id']) ?>" method="post">
                                    <?= csrf_field() ?>
                                    <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                        <?php foreach ($statusLabel as $key => $label): ?>
                                            <option value="<?= $key ?>" <?= $order['status'] == $key ? 'selected' : '' ?>>
                                                <?= $label ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </form>
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
