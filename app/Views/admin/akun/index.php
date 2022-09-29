<?= $this->extend('admin/template/layout'); ?>

<?= $this->Section('content'); ?>

<div class="container-fluid">
    <div class="card shadow ml-0 mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 text-primary">
                <i class="fas fa-table me-1"></i>
                Data Akun
            </h5>
        </div>
        <div class="card-body">





            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead >
                        <th>No</th>
                        <th>Username</th></th>
                        <th>Email</th>
                        <th>Password</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach($data_akun as $akun): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $akun->username; ?></td>
                                <td><?= $akun->email; ?></td>
                                <td>******</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>