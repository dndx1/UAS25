<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Header Section -->
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
                <h3 class="mb-3 mb-md-0">Daftar Konsumen</h3>
                <a href="<?= base_url('admin/konsumen/create') ?>" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i>Tambah Konsumen
                </a>
            </div>

            <!-- Table Section -->
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <!-- Desktop Table View -->
                    <div class="table-responsive d-none d-md-block">
                        <table class="table table-hover table-striped mb-0">
                            <thead class="table-dark">
                                <tr>
                                    <th scope="col" class="text-center" style="width: 60px;">No</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col" class="text-center">Terdaftar</th>
                                    <th scope="col" class="text-center" style="width: 150px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($konsumen as $row): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="fw-medium"><?= esc($row['username']) ?></td>
                                        <td><?= esc($row['email']) ?></td>
                                        <td class="text-center">
                                            <span class="badge bg-light text-dark">
                                                <?= date('d-m-Y', strtotime($row['created_at'])) ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="<?= base_url('admin/konsumen/edit/' . $row['id']) ?>" 
                                                   class="btn btn-sm btn-warning" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="<?= base_url('admin/konsumen/delete/' . $row['id']) ?>" 
                                                   class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Hapus konsumen ini?')" 
                                                   title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="d-block d-md-none">
                        <?php $no = 1; foreach ($konsumen as $row): ?>
                            <div class="card mb-3 mx-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start mb-2">
                                        <h6 class="card-title mb-0 fw-bold"><?= esc($row['username']) ?></h6>
                                        <span class="badge bg-primary">#<?= $no++ ?></span>
                                    </div>
                                    
                                    <div class="mb-2">
                                        <small class="text-muted">Email:</small><br>
                                        <span class="text-break"><?= esc($row['email']) ?></span>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <small class="text-muted">Terdaftar:</small><br>
                                        <span class="badge bg-light text-dark">
                                            <?= date('d-m-Y', strtotime($row['created_at'])) ?>
                                        </span>
                                    </div>
                                    
                                    <div class="d-grid gap-2 d-sm-flex">
                                        <a href="<?= base_url('admin/konsumen/edit/' . $row['id']) ?>" 
                                           class="btn btn-warning btn-sm flex-sm-fill">
                                            <i class="bi bi-pencil me-1"></i>Edit
                                        </a>
                                        <a href="<?= base_url('admin/konsumen/delete/' . $row['id']) ?>" 
                                           class="btn btn-danger btn-sm flex-sm-fill" 
                                           onclick="return confirm('Hapus konsumen ini?')">
                                            <i class="bi bi-trash me-1"></i>Hapus
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Empty State -->
                    <?php if (empty($konsumen)): ?>
                        <div class="text-center py-5">
                            <i class="bi bi-person-x display-1 text-muted"></i>
                            <h5 class="mt-3 text-muted">Tidak ada konsumen</h5>
                            <p class="text-muted">Belum ada konsumen yang terdaftar</p>
                            <a href="<?= base_url('admin/konsumen/create') ?>" class="btn btn-success">
                                <i class="bi bi-plus-circle me-2"></i>Tambah Konsumen Pertama
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Pagination (if needed) -->
            <?php if (isset($pager)): ?>
                <div class="d-flex justify-content-center mt-4">
                    <?= $pager->links() ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Custom CSS for additional styling -->
<!-- <style>
    .table-responsive {
        border-radius: 0.5rem;
    }
    
    .card {
        border: none;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .btn-group .btn {
        border-radius: 0.375rem;
    }
    
    .btn-group .btn:not(:last-child) {
        margin-right: 0.25rem;
    }
    
    @media (max-width: 576px) {
        .container-fluid {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        
        .card-body {
            padding: 1rem;
        }
    }
</style> -->

<?= $this->endSection() ?>