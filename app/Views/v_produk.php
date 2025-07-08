<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="pagetitle">
    <h1>Manajemen Produk</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Produk</li>
        </ol>
    </nav>
</div>

<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Data Produk</h5>

                    <!-- Alert Messages -->
                    <?php if (session()->getFlashData('success')): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                            <?= session()->getFlashData('success') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashData('failed')): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            <?= session()->getFlashData('failed') ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <!-- Filter and Action Buttons -->
                    <div class="row mb-3">
                        <div class="col-md-6 col-lg-4 mb-2">
                            <form method="get" class="d-inline-block w-100">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-funnel"></i></span>
                                    <select name="kategori" class="form-select" onchange="this.form.submit()">
                                        <option value="">-- Semua Kategori --</option>
                                        <option value="Anak" <?= (request()->getGet('kategori') == 'Anak') ? 'selected' : '' ?>>Anak</option>
                                        <option value="Remaja" <?= (request()->getGet('kategori') == 'Remaja') ? 'selected' : '' ?>>Remaja</option>
                                        <option value="Dewasa" <?= (request()->getGet('kategori') == 'Dewasa') ? 'selected' : '' ?>>Dewasa</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-lg-8 mb-2">
                            <div class="d-flex flex-wrap gap-2 justify-content-md-end">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="bi bi-plus-circle me-1"></i>Tambah Data
                                </button>
                                <a class="btn btn-success" href="<?= base_url() ?>produk/download">
                                    <i class="bi bi-download me-1"></i>Download Data
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Table -->
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col" class="d-none d-md-table-cell">Harga Beli</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col" class="d-none d-lg-table-cell">Foto</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $kategoriFilter = request()->getGet('kategori');
                                $filteredProducts = array_filter($product, function ($item) use ($kategoriFilter) {
                                    return !$kategoriFilter || $item['kategori'] == $kategoriFilter;
                                });
                                ?>
                                <?php foreach ($filteredProducts as $index => $produk): ?>
                                    <tr>
                                        <th scope="row"><?= $index + 1 ?></th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!-- Mobile Photo (visible only on small screens) -->
                                                <div class="d-lg-none me-2">
                                                    <?php if (!empty($produk['foto']) && file_exists("img/" . $produk['foto'])): ?>
                                                        <img src="<?= base_url("img/" . $produk['foto']) ?>" class="rounded" width="40" height="40" style="object-fit: cover;">
                                                    <?php else: ?>
                                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                            <i class="bi bi-image text-muted"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div>
                                                    <div class="fw-bold"><?= $produk['nama'] ?></div>
                                                    <!-- Mobile additional info -->
                                                    <div class="d-md-none">
                                                        <small class="text-muted">Harga Beli: <?= number_format($produk['harga_beli'], 0, ',', '.') ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= $produk['kategori'] == 'Anak' ? 'info' : ($produk['kategori'] == 'Remaja' ? 'warning' : 'success') ?>">
                                                <?= $produk['kategori'] ?>
                                            </span>
                                        </td>
                                        <td class="fw-bold text-primary">Rp <?= number_format($produk['harga'], 0, ',', '.') ?></td>
                                        <td class="d-none d-md-table-cell">Rp <?= number_format($produk['harga_beli'], 0, ',', '.') ?></td>
                                        <td>
                                            <span class="badge bg-<?= $produk['jumlah'] > 10 ? 'success' : ($produk['jumlah'] > 5 ? 'warning' : 'danger') ?>">
                                                <?= $produk['jumlah'] ?>
                                            </span>
                                        </td>
                                        <td class="d-none d-lg-table-cell">
                                            <?php if (!empty($produk['foto']) && file_exists("img/" . $produk['foto'])): ?>
                                                <img src="<?= base_url("img/" . $produk['foto']) ?>" class="rounded" width="80" height="80" style="object-fit: cover;">
                                            <?php else: ?>
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                                                    <i class="bi bi-image text-muted"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id'] ?>" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <a href="<?= base_url('produk/delete/' . $produk['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus data ini ?')" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal -->
                                    <div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1" aria-labelledby="editModalLabel-<?= $produk['id'] ?>" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <form action="<?= base_url('produk/edit/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                                                    <?= csrf_field(); ?>
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel-<?= $produk['id'] ?>">
                                                            <i class="bi bi-pencil-square me-2"></i>Edit Data Produk
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Nama Produk</label>
                                                                    <input type="text" name="nama" class="form-control" value="<?= $produk['nama'] ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Kategori</label>
                                                                    <select name="kategori" class="form-select" required>
                                                                        <option value="Dewasa" <?= $produk['kategori'] == 'Dewasa' ? 'selected' : '' ?>>Dewasa</option>
                                                                        <option value="Anak" <?= $produk['kategori'] == 'Anak' ? 'selected' : '' ?>>Anak</option>
                                                                        <option value="Remaja" <?= $produk['kategori'] == 'Remaja' ? 'selected' : '' ?>>Remaja</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Harga Jual</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Rp</span>
                                                                        <input type="number" name="harga" class="form-control" value="<?= $produk['harga'] ?>" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label class="form-label">Harga Beli</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Rp</span>
                                                                        <input type="number" name="harga_beli" class="form-control" value="<?= $produk['harga_beli'] ?>" required>
                                                                    </div>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Jumlah Stock</label>
                                                                    <input type="number" name="jumlah" class="form-control" value="<?= $produk['jumlah'] ?>" required>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Foto Saat Ini</label>
                                                                    <div class="text-center">
                                                                        <?php if (!empty($produk['foto']) && file_exists("img/" . $produk['foto'])): ?>
                                                                            <img src="<?= base_url("img/" . $produk['foto']) ?>" class="img-thumbnail" width="150">
                                                                        <?php else: ?>
                                                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 150px; height: 150px;">
                                                                                <i class="bi bi-image text-muted fs-1"></i>
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-check mb-3">
                                                                    <input class="form-check-input" type="checkbox" id="check-<?= $produk['id'] ?>" name="check" value="1">
                                                                    <label class="form-check-label" for="check-<?= $produk['id'] ?>">
                                                                        Centang jika ingin mengganti foto
                                                                    </label>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label">Upload Foto Baru</label>
                                                                    <input type="file" class="form-control" name="foto" accept="image/*">
                                                                    <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB.</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                            <i class="bi bi-x-circle me-1"></i>Batal
                                                        </button>
                                                        <button type="submit" class="btn btn-primary">
                                                            <i class="bi bi-check-circle me-1"></i>Simpan Perubahan
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Data Produk
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Produk <span class="text-danger">*</span></label>
                                <input type="text" name="nama" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                                <select name="kategori" class="form-select" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Dewasa">Dewasa</option>
                                    <option value="Anak">Anak</option>
                                    <option value="Remaja">Remaja</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Harga Jual <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Harga Beli <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="harga_beli" class="form-control" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Jumlah Stock <span class="text-danger">*</span></label>
                                <input type="number" name="jumlah" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Foto Produk</label>
                                <input type="file" class="form-control" name="foto" accept="image/*">
                                <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB.</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-1"></i>Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>