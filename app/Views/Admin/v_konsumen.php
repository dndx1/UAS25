<?= $this->extend('layout') ?>
<?= $this->section('content') ?>

<h3>Daftar Konsumen</h3>
<a href="<?= base_url('admin/konsumen/create') ?>" class="btn btn-success mb-3">Tambah Konsumen</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Terdaftar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1; foreach ($konsumen as $row): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= esc($row['username']) ?></td>
                <td><?= esc($row['email']) ?></td>
                <td><?= date('d-m-Y', strtotime($row['created_at'])) ?></td>
                <td>
                    <a href="<?= base_url('admin/konsumen/edit/' . $row['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?= base_url('admin/konsumen/delete/' . $row['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus konsumen ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
