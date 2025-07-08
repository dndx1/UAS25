<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Data Transaksi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
            <li class="breadcrumb-item active">Transaksi</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Daftar Transaksi</h5>
                    
                    <?php if (session()->getFlashdata('message')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <?= session()->getFlashdata('message') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Desktop Table View -->
                    <div class="table-responsive d-none d-md-block">
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
                                        <td>
                                            <?php if (!empty($order['bukti_bayar'])): ?>
                                                <a href="<?= base_url('uploads/bukti/' . $order['bukti_bayar']) ?>" target="_blank" class="btn btn-sm btn-secondary">Lihat</a>
                                            <?php else: ?>
                                                <span class="text-danger">Belum Ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <form action="<?= base_url('admin/order/update_status/' . $order['id']) ?>" method="post">
                                                <?= csrf_field() ?>
                                                <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                    <?php foreach ($statusLabel as $key => $label): ?>
                                                        <option value="<?= $key ?>" <?= $order['status'] == $key ? 'selected' : '' ?>><?= $label ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </form>
                                        </td>
                                        <td><?= date('d-m-Y H:i', strtotime($order['created_at'])) ?></td>
                                        <td>
                                            <button type="button" class="btn btn-info btn-sm" onclick="loadOrderDetail(<?= $order['id'] ?>)">
                                                <i class="bi bi-eye"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="d-block d-md-none">
                        <?php $no = 1; foreach ($orders as $order): ?>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="card-title mb-0"><?= esc($order['username']) ?></h6>
                                        <span class="badge bg-primary">#<?= $no++ ?></span>
                                    </div>
                                    
                                    <div class="row mb-2">
                                        <div class="col-6">
                                            <small class="text-muted">Total Harga:</small><br>
                                            <strong class="text-success">Rp <?= number_format($order['total_harga'], 0, ',', '.') ?></strong>
                                        </div>
                                        <div class="col-6">
                                            <small class="text-muted">Tanggal:</small><br>
                                            <span><?= date('d-m-Y H:i', strtotime($order['created_at'])) ?></span>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <small class="text-muted">Bukti Bayar:</small><br>
                                        <?php if (!empty($order['bukti_bayar'])): ?>
                                            <a href="<?= base_url('uploads/bukti/' . $order['bukti_bayar']) ?>" target="_blank" class="btn btn-sm btn-secondary">
                                                <i class="bi bi-eye"></i> Lihat
                                            </a>
                                        <?php else: ?>
                                            <span class="text-danger">Belum Ada</span>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <small class="text-muted">Status:</small><br>
                                        <form action="<?= base_url('admin/order/update_status/' . $order['id']) ?>" method="post">
                                            <?= csrf_field() ?>
                                            <select name="status" onchange="this.form.submit()" class="form-select form-select-sm">
                                                <?php foreach ($statusLabel as $key => $label): ?>
                                                    <option value="<?= $key ?>" <?= $order['status'] == $key ? 'selected' : '' ?>><?= $label ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </form>
                                    </div>
                                    
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-info btn-sm" onclick="loadOrderDetail(<?= $order['id'] ?>)">
                                            <i class="bi bi-eye"></i> Detail Transaksi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Empty State -->
                    <?php if (empty($orders)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-receipt" style="font-size: 3rem; color: #6c757d;"></i>
                            <h5 class="mt-3 text-muted">Belum ada transaksi</h5>
                            <p class="text-muted">Transaksi dari konsumen akan muncul di sini</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal Detail Transaksi -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="bi bi-receipt"></i> Detail Transaksi
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalContent">
                <!-- Loading content akan diisi dengan AJAX -->
                <div class="text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="mt-2">Memuat detail transaksi...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-x-circle"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function loadOrderDetail(orderId) {
    // Tampilkan modal
    const modal = new bootstrap.Modal(document.getElementById('detailModal'));
    modal.show();
    
    // Reset content ke loading
    document.getElementById('modalContent').innerHTML = `
        <div class="text-center py-5">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Memuat detail transaksi...</p>
        </div>
    `;
    
    // Load data via AJAX
    fetch('<?= base_url('admin/order/get_detail/') ?>' + orderId)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let detailHtml = `
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="bi bi-person"></i> Informasi Pelanggan
                                    </h6>
                                    <div class="row mb-1">
                                        <div class="col-sm-5"><strong>ID Transaksi:</strong></div>
                                        <div class="col-sm-7">#${data.transaksi.id}</div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-sm-5"><strong>Nama:</strong></div>
                                        <div class="col-sm-7">${data.transaksi.username}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5"><strong>Total:</strong></div>
                                        <div class="col-sm-7 text-success">
                                            <strong>Rp ${new Intl.NumberFormat('id-ID').format(data.transaksi.total_harga)}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">
                                        <i class="bi bi-calendar"></i> Informasi Waktu
                                    </h6>
                                    <div class="row mb-1">
                                        <div class="col-sm-5"><strong>Tanggal:</strong></div>
                                        <div class="col-sm-7">${new Date(data.transaksi.created_at).toLocaleDateString('id-ID')}</div>
                                    </div>
                                    <div class="row mb-1">
                                        <div class="col-sm-5"><strong>Waktu:</strong></div>
                                        <div class="col-sm-7">${new Date(data.transaksi.created_at).toLocaleTimeString('id-ID')}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-5"><strong>Status:</strong></div>
                                        <div class="col-sm-7">
                                            <span class="badge bg-primary">${getStatusLabel(data.transaksi.status)}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="bi bi-bag"></i> Detail Produk
                            </h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead>
                                        <tr>
                                            <th>Produk</th>
                                            <th class="text-center">Jumlah</th>
                                            <th class="text-end">Harga</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                `;
                
                data.detail.forEach(item => {
                    detailHtml += `
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-box me-2 text-muted"></i>
                                    <strong>${item.nama_produk}</strong>
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-secondary">${item.jumlah}</span>
                            </td>
                            <td class="text-end">Rp ${new Intl.NumberFormat('id-ID').format(item.harga)}</td>
                            <td class="text-end">
                                <strong>Rp ${new Intl.NumberFormat('id-ID').format(item.subtotal_harga)}</strong>
                            </td>
                        </tr>
                    `;
                });
                
                detailHtml += `
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-end">Total Keseluruhan:</th>
                                            <th class="text-end text-success">
                                                Rp ${new Intl.NumberFormat('id-ID').format(data.transaksi.total_harga)}
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                `;
                
                document.getElementById('modalContent').innerHTML = detailHtml;
            } else {
                document.getElementById('modalContent').innerHTML = `
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle"></i>
                        Error: ${data.message || 'Gagal memuat detail transaksi'}
                    </div>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('modalContent').innerHTML = `
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle"></i>
                    Terjadi kesalahan saat memuat data. Silakan coba lagi.
                </div>
            `;
        });
}

function getStatusLabel(status) {
    const statusLabels = {
        'pending': 'Menunggu',
        'confirmed': 'Dikonfirmasi',
        'processing': 'Diproses',
        'shipped': 'Dikirim',
        'delivered': 'Selesai',
        'cancelled': 'Dibatalkan'
    };
    return statusLabels[status] || status;
}
</script>

<?= $this->endSection() ?>