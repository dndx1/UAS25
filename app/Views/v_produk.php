<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashData('success')): ?>
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashData('failed')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashData('failed') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
    Tambah Data
</button>

<a class="btn btn-success text-white" href="<?= base_url() ?>produk/download">
    Download Data
</a>

<table class="table datatable mt-3">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Harga Beli</th>
            <th>Jumlah</th>
            <th>Foto</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($product as $index => $produk): ?>
            <tr>
                <th><?= $index + 1 ?></th>
                <td><?= $produk['nama'] ?></td>
                <td><?= $produk['harga'] ?></td>
                <td><?= $produk['harga_beli'] ?></td>
                <td><?= $produk['jumlah'] ?></td>
                <td>
                    <?php if (!empty($produk['foto']) && file_exists("img/" . $produk['foto'])): ?>
                        <img src="<?= base_url("img/" . $produk['foto']) ?>" width="100px">
                    <?php endif; ?>
                </td>
                <td>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal-<?= $produk['id'] ?>">
                        Ubah
                    </button>
                    <a href="<?= base_url('produk/delete/' . $produk['id']) ?>" class="btn btn-danger" onclick="return confirm('Yakin hapus data ini ?')">
                        Hapus
                    </a>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal-<?= $produk['id'] ?>" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form action="<?= base_url('produk/edit/' . $produk['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-2">
                                    <label>Nama</label>
                                    <input type="text" name="nama" class="form-control" value="<?= $produk['nama'] ?>" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Harga</label>
                                    <input type="text" name="harga" class="form-control" value="<?= $produk['harga'] ?>" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Harga Beli</label>
                                    <input type="text" name="harga_beli" class="form-control" value="<?= $produk['harga_beli'] ?>" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Jumlah</label>
                                    <input type="text" name="jumlah" class="form-control" value="<?= $produk['jumlah'] ?>" required>
                                </div>
                                <div class="form-group mb-2">
                                    <img src="<?= base_url("img/" . $produk['foto']) ?>" width="100px">
                                </div>
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="check" name="check" value="1">
                                    <label class="form-check-label" for="check">
                                        Ceklis jika ingin mengganti foto
                                    </label>
                                </div>
                                <div class="form-group mb-2">
                                    <label>Foto</label>
                                    <input type="file" class="form-control" name="foto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="<?= base_url('produk') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-2">
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Harga</label>
                        <input type="text" name="harga" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Harga Beli</label>
                        <input type="text" name="harga_beli" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Jumlah</label>
                        <input type="text" name="jumlah" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label>Foto</label>
                        <input type="file" class="form-control" name="foto">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
