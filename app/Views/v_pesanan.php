<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h4>History Transaksi Pembelian <strong><?= $username ?></strong></h4>
<hr>

<div class="table-responsive">
    <table class="table datatable">
        <thead>
            <tr>
                <th>#</th>
                <th>ID Pembelian</th>
                <th>Waktu Pembelian</th>
                <th>Total Bayar</th>
                <th>Alamat</th>
                <th>Status</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($buy)) : ?>
                <?php foreach ($buy as $index => $item) : ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= $item['id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>
                        <td><?= number_to_currency($item['total_harga'], 'IDR') ?></td>
                        <td><?= esc($item['alamat']) ?></td>
                        <td>
                            <?php if ($item['status'] == "1") : ?>
                                <span class="badge bg-success">Sudah Diterima</span>
                            <?php else : ?>
                                <form action="<?= base_url('admin/order/diterima/' . $item['id']) ?>" method="post" onsubmit="return confirm('Apakah barang sudah diterima?');" class="d-inline">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-primary">Tandai Diterima</button>
                                </form>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#detailModal<?= $item['id'] ?>">
                                <i class="fas fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" class="text-center">Belum ada history transaksi</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Modal Detail Transaksi -->
<?php if (!empty($buy)) : ?>
    <?php foreach ($buy as $item) : ?>
        <div class="modal fade" id="detailModal<?= $item['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $item['id'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="modalLabel<?= $item['id'] ?>">
                            <i class="fas fa-shopping-cart"></i> Detail Transaksi #<?= $item['id'] ?>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Info Transaksi -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-primary">Informasi Transaksi</h6>
                                <p class="mb-1"><strong>ID Transaksi:</strong> <?= $item['id'] ?></p>
                                <p class="mb-1"><strong>Waktu:</strong> <?= date('d F Y, H:i', strtotime($item['created_at'])) ?></p>
                                <p class="mb-1"><strong>Status:</strong>
                                    <?= $item['status'] == "1"
                                        ? '<span class="badge bg-success">Sudah Diterima</span>'
                                        : '<span class="badge bg-warning text-dark">Belum Diterima</span>' ?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-primary">Informasi Pengiriman</h6>
                                <p class="mb-1"><strong>Alamat:</strong></p>
                                <p class="mb-1"><?= esc($item['alamat']) ?></p>
                                <p class="mb-1"><strong>Ongkir:</strong> <?= number_to_currency($item['ongkir'], 'IDR') ?></p>
                            </div>
                        </div>

                        <hr>

                        <!-- Detail Produk -->
                        <h6 class="text-primary mb-3">Detail Produk</h6>
                        <?php if (isset($product[$item['id']]) && !empty($product[$item['id']])): ?>
                            <div class="table-responsive">
                                <table class="table table-bordered table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $subtotal = 0;
                                        foreach ($product[$item['id']] as $p): 
                                            $subtotalProduk = $p['harga'] * $p['jumlah'];
                                            $subtotal += $subtotalProduk;
                                        ?>
                                            <tr>
                                                <td><?= esc($p['nama']) ?></td>
                                                <td><?= number_to_currency($p['harga'], 'IDR') ?></td>
                                                <td><?= $p['jumlah'] ?></td>
                                                <td><?= number_to_currency($subtotalProduk, 'IDR') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot class="table-secondary">
                                        <tr>
                                            <th colspan="3" class="text-end">Subtotal:</th>
                                            <th><?= number_to_currency($subtotal, 'IDR') ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="3" class="text-end">Ongkir:</th>
                                            <th><?= number_to_currency($item['ongkir'], 'IDR') ?></th>
                                        </tr>
                                        <tr class="table-primary">
                                            <th colspan="3" class="text-end">Total Bayar:</th>
                                            <th><?= number_to_currency($item['total_harga'], 'IDR') ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-warning">
                                <i class="fas fa-exclamation-triangle"></i> Detail produk tidak tersedia.
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="modal-footer">
                        <?php if ($item['status'] != "1") : ?>
                            <form action="<?= base_url('admin/order/diterima/' . $item['id']) ?>" method="post" onsubmit="return confirm('Apakah barang sudah diterima?');" class="d-inline">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-check"></i> Tandai Diterima
                                </button>
                            </form>
                        <?php endif; ?>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times"></i> Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- Custom CSS untuk Modal -->
<style>
    .modal-lg {
        max-width: 900px;
    }
    
    .table-responsive {
        max-height: 400px;
        overflow-y: auto;
    }
    
    .badge {
        font-size: 0.875em;
    }
    
    .modal-header.bg-primary {
        border-bottom: 2px solid #0d6efd;
    }
    
    .table th {
        font-weight: 600;
    }
    
    .table-primary th {
        background-color: #cfe2ff !important;
        color: #084298 !important;
    }
    
    .alert {
        border: none;
        border-radius: 8px;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
</style>

<!-- Script untuk memastikan modal berfungsi -->
<!-- Script untuk memastikan modal berfungsi dengan benar -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Pastikan semua modal dapat dibuka
    const modalTriggers = document.querySelectorAll('[data-bs-toggle="modal"]');
    modalTriggers.forEach(function(trigger) {
        trigger.addEventListener('click', function() {
            const targetModal = document.querySelector(this.getAttribute('data-bs-target'));
            if (targetModal) {
                const modal = new bootstrap.Modal(targetModal);
                modal.show();
            }
        });
    });
    
    // Handle modal close events
    document.querySelectorAll('.modal').forEach(function(modalElement) {
        modalElement.addEventListener('hidden.bs.modal', function() {
            // Pastikan backdrop dihapus
            const backdrops = document.querySelectorAll('.modal-backdrop');
            backdrops.forEach(function(backdrop) {
                backdrop.remove();
            });
            
            // Reset body overflow
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            
            // Hapus class modal-open dari body
            document.body.classList.remove('modal-open');
        });
    });
    
    // Auto-close modal setelah submit form
    const forms = document.querySelectorAll('.modal form');
    forms.forEach(function(form) {
        form.addEventListener('submit', function() {
            const modal = bootstrap.Modal.getInstance(this.closest('.modal'));
            if (modal) {
                setTimeout(function() {
                    modal.hide();
                    
                    // Force cleanup setelah form submit
                    setTimeout(function() {
                        const backdrops = document.querySelectorAll('.modal-backdrop');
                        backdrops.forEach(function(backdrop) {
                            backdrop.remove();
                        });
                        document.body.style.overflow = '';
                        document.body.classList.remove('modal-open');
                    }, 100);
                }, 1000);
            }
        });
    });
    
    // Handle ESC key dan click outside
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const openModals = document.querySelectorAll('.modal.show');
            openModals.forEach(function(modal) {
                const bsModal = bootstrap.Modal.getInstance(modal);
                if (bsModal) {
                    bsModal.hide();
                }
            });
        }
    });
});

// Fungsi untuk force cleanup manual jika masih ada masalah
function forceCloseModal() {
    // Tutup semua modal yang terbuka
    const openModals = document.querySelectorAll('.modal.show');
    openModals.forEach(function(modal) {
        const bsModal = bootstrap.Modal.getInstance(modal);
        if (bsModal) {
            bsModal.hide();
        }
    });
    
    // Hapus semua backdrop
    const backdrops = document.querySelectorAll('.modal-backdrop');
    backdrops.forEach(function(backdrop) {
        backdrop.remove();
    });
    
    // Reset body styles
    document.body.style.overflow = '';
    document.body.style.paddingRight = '';
    document.body.classList.remove('modal-open');
}
</script>

<?= $this->endSection() ?>