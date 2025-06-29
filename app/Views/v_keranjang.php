<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

    <!-- Success Alert -->
    <?php if (session()->getFlashData('success')) { ?>
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                        <div>
                            <strong>Berhasil!</strong> <?= session()->getFlashData('success') ?>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Shopping Cart Content -->
    <div class="row">
        <div class="col-12">
            <?php if (!empty($items)) : ?>
                <!-- Cart Items Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-bottom-0 py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="bi bi-bag-check me-2 text-primary"></i>
                                Produk dalam Keranjang (<?= count($items) ?> item)
                            </h5>
                            <span class="badge bg-primary rounded-pill"><?= count($items) ?></span>
                        </div>
                    </div>
                    
                    <div class="card-body p-0">
                        <?php echo form_open('keranjang/edit', ['class' => 'needs-validation', 'novalidate' => '']) ?>
                        
                        <!-- Desktop Table View -->
                        <div class="table-responsive d-none d-lg-block">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="border-0 fw-semibold">
                                            <i class="bi bi-box me-1"></i>Produk
                                        </th>
                                        <th scope="col" class="border-0 fw-semibold text-center">
                                            <i class="bi bi-image me-1"></i>Foto
                                        </th>
                                        <th scope="col" class="border-0 fw-semibold text-end">
                                            <i class="bi bi-currency-dollar me-1"></i>Harga
                                        </th>
                                        <th scope="col" class="border-0 fw-semibold text-center">
                                            <i class="bi bi-123 me-1"></i>Jumlah
                                        </th>
                                        <th scope="col" class="border-0 fw-semibold text-end">
                                            <i class="bi bi-calculator me-1"></i>Subtotal
                                        </th>
                                        <th scope="col" class="border-0 fw-semibold text-center">
                                            <i class="bi bi-gear me-1"></i>Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    foreach ($items as $index => $item) :
                                    ?>
                                        <tr class="align-middle">
                                            <td class="border-0">
                                                <div class="fw-semibold text-dark"><?= esc($item['name']) ?></div>
                                            </td>
                                            <td class="border-0 text-center">
                                                <img src="<?= base_url('img/' . $item['options']['foto']) ?>" 
                                                     alt="<?= esc($item['name']) ?>" 
                                                     class="img-thumbnail rounded" 
                                                     style="width: 80px; height: 80px; object-fit: cover;">
                                            </td>
                                            <td class="border-0 text-end">
                                                <span class="fw-semibold text-success">
                                                    <?= number_to_currency($item['price'], 'IDR') ?>
                                                </span>
                                            </td>
                                            <td class="border-0 text-center">
                                                <div class="input-group input-group-sm" style="width: 120px; margin: 0 auto;">
                                                    <input type="number" 
                                                           min="1" 
                                                           max="999"
                                                           name="qty<?= $i++ ?>" 
                                                           class="form-control text-center border-primary" 
                                                           value="<?= $item['qty'] ?>"
                                                           required>
                                                </div>
                                            </td>
                                            <td class="border-0 text-end">
                                                <span class="fw-bold text-primary fs-6">
                                                    <?= number_to_currency($item['subtotal'], 'IDR') ?>
                                                </span>
                                            </td>
                                            <td class="border-0 text-center">
                                                <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" 
                                                   class="btn btn-outline-danger btn-sm"
                                                   onclick="return confirm('Yakin ingin menghapus produk ini dari keranjang?')"
                                                   data-bs-toggle="tooltip" 
                                                   title="Hapus dari keranjang">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Mobile Card View -->
                        <div class="d-block d-lg-none">
                            <?php
                            $i = 1;
                            foreach ($items as $index => $item) :
                            ?>
                                <div class="card border-0 border-bottom rounded-0 mb-3">
                                    <div class="card-body">
                                        <div class="row align-items-center">
                                            <div class="col-3">
                                                <img src="<?= base_url('img/' . $item['options']['foto']) ?>" 
                                                     alt="<?= esc($item['name']) ?>" 
                                                     class="img-fluid rounded">
                                            </div>
                                            <div class="col-9">
                                                <h6 class="card-title mb-1"><?= esc($item['name']) ?></h6>
                                                <p class="text-success fw-semibold mb-2"><?= number_to_currency($item['price'], 'IDR') ?></p>
                                                
                                                <div class="row align-items-center">
                                                    <div class="col-6">
                                                        <label class="form-label small">Jumlah:</label>
                                                        <input type="number" 
                                                               min="1" 
                                                               max="999"
                                                               name="qty<?= $i++ ?>" 
                                                               class="form-control form-control-sm" 
                                                               value="<?= $item['qty'] ?>">
                                                    </div>
                                                    <div class="col-6 text-end">
                                                        <small class="text-muted d-block">Subtotal:</small>
                                                        <span class="fw-bold text-primary"><?= number_to_currency($item['subtotal'], 'IDR') ?></span>
                                                    </div>
                                                </div>
                                                
                                                <div class="mt-2">
                                                    <a href="<?= base_url('keranjang/delete/' . $item['rowid']) ?>" 
                                                       class="btn btn-outline-danger btn-sm"
                                                       onclick="return confirm('Yakin ingin menghapus?')">
                                                        <i class="bi bi-trash me-1"></i>Hapus
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="row">
                    <div class="col-lg-8 col-md-7">
                        <!-- Action Buttons -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-arrow-clockwise me-2"></i>Perbarui Keranjang
                                    </button>
                                    <a class="btn btn-warning" href="<?= base_url('keranjang/clear') ?>"
                                       onclick="return confirm('Yakin ingin mengosongkan keranjang?')">
                                        <i class="bi bi-cart-x me-2"></i>Kosongkan Keranjang
                                    </a>
                                    <a class="btn btn-outline-secondary" href="<?= base_url() ?>">
                                        <i class="bi bi-arrow-left me-2"></i>Lanjut Belanja
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-5">
                        <!-- Total Summary -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-receipt me-2"></i>Ringkasan Pesanan
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <span class="text-muted">Total Item:</span>
                                    <span class="fw-semibold"><?= count($items) ?> produk</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center py-3">
                                    <span class="fs-5 fw-bold">Total Pembayaran:</span>
                                    <span class="fs-4 fw-bold text-primary"><?= number_to_currency($total, 'IDR') ?></span>
                                </div>
                                <div class="d-grid">
                                    <a class="btn btn-success btn-lg" href="<?= base_url('checkout') ?>">
                                        <i class="bi bi-credit-card me-2"></i>Selesai Belanja
                                    </a>
                                </div>
                                <small class="text-muted mt-2 d-block text-center">
                                    <i class="bi bi-shield-check me-1"></i>Pembayaran aman dan terpercaya
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php echo form_close() ?>

            <?php else : ?>
                <!-- Empty Cart State -->
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="bi bi-cart-x display-1 text-muted"></i>
                        </div>
                        <h3 class="text-muted mb-3">Keranjang Belanja Kosong</h3>
                        <p class="text-muted mb-4">
                            Anda belum menambahkan produk apapun ke dalam keranjang.<br>
                            Mari mulai berbelanja sekarang!
                        </p>
                        <a href="<?= base_url() ?>" class="btn btn-primary btn-lg">
                            <i class="bi bi-shop me-2"></i>Mulai Belanja
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Custom Styles - Tema Blangkon Tradisional -->
<style>
:root {
    /* Warna Blangkon Tradisional */
    --blangkon-emas: #D4AF37;      /* Emas cerah untuk aksen utama */
    --blangkon-coklat: #8B4513;    /* Coklat blangkon */
    --blangkon-merah: #DC143C;     /* Merah maroon tradisional */
    --blangkon-hijau: #228B22;     /* Hijau daun tradisional */
    --blangkon-biru: #4169E1;      /* Biru royal */
    --blangkon-krem: #F5F5DC;      /* Krem lembut */
    --blangkon-coklat-muda: #DEB887; /* Coklat muda */
}

body {
    background: linear-gradient(135deg, var(--blangkon-krem) 0%, #FFF8DC 100%);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.container-fluid {
    background: transparent;
}

/* Header Styling */
.h3.text-gray-800 {
    color: var(--blangkon-coklat) !important;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(139, 69, 19, 0.1);
}

.breadcrumb {
    background: linear-gradient(45deg, var(--blangkon-emas), #F0E68C);
    border-radius: 25px;
    padding: 8px 20px;
    box-shadow: 0 2px 10px rgba(212, 175, 55, 0.3);
}

.breadcrumb-item a {
    color: var(--blangkon-coklat);
    text-decoration: none;
    font-weight: 500;
}

.breadcrumb-item.active {
    color: var(--blangkon-coklat);
    font-weight: bold;
}

/* Alert Styling */
.alert-success {
    background: linear-gradient(135deg, var(--blangkon-hijau), #32CD32);
    color: white;
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(34, 139, 34, 0.3);
}

/* Card Styling */
.card {
    transition: all 0.3s ease;
    border-radius: 20px;
    box-shadow: 0 8px 25px rgba(139, 69, 19, 0.15);
    background: linear-gradient(135deg, #FFFFFF 0%, var(--blangkon-krem) 100%);
    border: 2px solid var(--blangkon-emas);
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(212, 175, 55, 0.25);
}

.card-header {
    background: linear-gradient(135deg, var(--blangkon-coklat), var(--blangkon-merah)) !important;
    color: white !important;
    border-radius: 18px 18px 0 0 !important;
    border-bottom: 3px solid var(--blangkon-emas);
    padding: 1rem 1.5rem;
}

.card-header.bg-primary {
    background: linear-gradient(135deg, var(--blangkon-biru), var(--blangkon-coklat)) !important;
}

/* Button Styling */
.btn-primary {
    background: linear-gradient(135deg, var(--blangkon-biru), var(--blangkon-coklat));
    border: 2px solid var(--blangkon-emas);
    color: white;
    font-weight: bold;
    border-radius: 25px;
    padding: 10px 25px;
    box-shadow: 0 4px 15px rgba(65, 105, 225, 0.3);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background: linear-gradient(135deg, var(--blangkon-coklat), var(--blangkon-biru));
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(65, 105, 225, 0.4);
}

.btn-success {
    background: linear-gradient(135deg, var(--blangkon-hijau), #228B22);
    border: 2px solid var(--blangkon-emas);
    color: white;
    font-weight: bold;
    border-radius: 25px;
    box-shadow: 0 4px 15px rgba(34, 139, 34, 0.3);
}

.btn-success:hover {
    background: linear-gradient(135deg, #228B22, var(--blangkon-hijau));
    transform: translateY(-2px);
}

.btn-warning {
    background: linear-gradient(135deg, var(--blangkon-emas), #FFD700);
    border: 2px solid var(--blangkon-coklat);
    color: var(--blangkon-coklat);
    font-weight: bold;
    border-radius: 25px;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}

.btn-warning:hover {
    background: linear-gradient(135deg, #FFD700, var(--blangkon-emas));
    color: var(--blangkon-coklat);
    transform: translateY(-2px);
}

.btn-outline-danger {
    border: 2px solid var(--blangkon-merah);
    color: var(--blangkon-merah);
    background: transparent;
    border-radius: 15px;
    font-weight: bold;
}

.btn-outline-danger:hover {
    background: var(--blangkon-merah);
    color: white;
    transform: scale(1.05);
}

.btn-outline-secondary {
    border: 2px solid var(--blangkon-coklat);
    color: var(--blangkon-coklat);
    background: transparent;
    border-radius: 25px;
    font-weight: bold;
}

.btn-outline-secondary:hover {
    background: var(--blangkon-coklat);
    color: white;
}

/* Table Styling */
.table-light {
    background: linear-gradient(135deg, var(--blangkon-coklat-muda), var(--blangkon-krem)) !important;
}

.table-light th {
    color: var(--blangkon-coklat);
    font-weight: bold;
    border: none;
    text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.5);
}

.table-hover tbody tr:hover {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(245, 245, 220, 0.3)) !important;
}

.table td {
    border-color: var(--blangkon-coklat-muda);
    padding: 1rem;
}

/* Badge Styling */
.badge.bg-primary {
    background: linear-gradient(135deg, var(--blangkon-emas), #FFD700) !important;
    color: var(--blangkon-coklat);
    font-weight: bold;
    padding: 8px 15px;
    font-size: 0.9rem;
}

/* Form Styling */
.form-control {
    border: 2px solid var(--blangkon-coklat-muda);
    border-radius: 15px;
    padding: 10px 15px;
    transition: all 0.3s ease;
}

.form-control:focus {
    border-color: var(--blangkon-emas);
    box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
    background: linear-gradient(135deg, #FFFFFF, var(--blangkon-krem));
}

.border-primary {
    border-color: var(--blangkon-emas) !important;
}

/* Image Styling */
.img-thumbnail {
    transition: transform 0.3s ease;
    border: 3px solid var(--blangkon-emas);
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
}

.img-thumbnail:hover {
    transform: scale(1.1) rotate(2deg);
    box-shadow: 0 8px 25px rgba(212, 175, 55, 0.5);
}

/* Text Colors */
.text-success {
    color: var(--blangkon-hijau) !important;
    font-weight: bold;
}

.text-primary {
    color: var(--blangkon-biru) !important;
    font-weight: bold;
}

.fw-bold.text-primary {
    color: var(--blangkon-coklat) !important;
    text-shadow: 1px 1px 2px rgba(139, 69, 19, 0.1);
}

/* Icon Colors */
.bi {
    color: var(--blangkon-emas);
}

.text-white .bi {
    color: white;
}

/* Empty State */
.display-1.text-muted {
    color: var(--blangkon-coklat-muda) !important;
    opacity: 0.7;
}

/* Special Effects */
.card-body {
    position: relative;
    overflow: hidden;
}

.card-body::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.05) 0%, transparent 70%);
    animation: shimmer 3s ease-in-out infinite;
    pointer-events: none;
}

@keyframes shimmer {
    0%, 100% { opacity: 0; }
    50% { opacity: 1; }
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .breadcrumb-wrapper {
        margin-top: 15px;
    }
    
    .d-flex.justify-content-between.align-items-center {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .card {
        margin-bottom: 1rem;
        border-radius: 15px;
    }
    
    .btn {
        margin-bottom: 10px;
        width: 100%;
        border-radius: 20px;
    }
}

/* Decorative Elements */
.container-fluid::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        radial-gradient(circle at 20% 20%, rgba(212, 175, 55, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(139, 69, 19, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 40% 60%, rgba(220, 20, 60, 0.03) 0%, transparent 50%);
    z-index: -1;
    pointer-events: none;
}
</style>

<!-- Custom Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Auto-update subtotal when quantity changes (optional enhancement)
    const qtyInputs = document.querySelectorAll('input[type="number"]');
    qtyInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Add visual feedback
            this.style.borderColor = '#28a745';
            setTimeout(() => {
                this.style.borderColor = '';
            }, 1000);
        });
    });
});
</script>

<?= $this->endSection() ?>