<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h3><?= isset($konsumen) ? 'Edit Konsumen' : 'Tambah Konsumen' ?></h3>

<form action="<?= isset($konsumen) ? base_url('admin/konsumen/update/' . $konsumen['id']) : base_url('admin/konsumen/store') ?>" method="post">
    <?= csrf_field() ?>
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required
               value="<?= isset($konsumen) ? esc($konsumen['username']) : old('username') ?>">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required
               value="<?= isset($konsumen) ? esc($konsumen['email']) : old('email') ?>">
    </div>
    

    <div class="mb-3">
        <label><?= isset($konsumen) ? 'Ganti Password (opsional)' : 'Password' ?></label>
        <input type="password" name="password" class="form-control" <?= isset($konsumen) ? '' : 'required' ?>>
    </div>


    <button type="submit" class="btn btn-primary"><?= isset($konsumen) ? 'Update' : 'Simpan' ?></button>
    <a href="<?= base_url('admin/konsumen') ?>" class="btn btn-secondary">Batal</a>
</form>

<?= $this->endSection() ?>
