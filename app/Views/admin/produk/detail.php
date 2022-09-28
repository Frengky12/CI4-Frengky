<?= $this->extend('admin/template/layout') ?>

<?= $this->Section('content'); ?>

<div class="container-fluid">
    <div class="card shadow ml-0 mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 text-primary">
                <i class="fas fa-table me-1"></i>
                 Detail Data Produk
            </h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <tr>
                        <th>Nama Produk </th>
                        <td>: <?= $data_produk->nama_produk; ?></td>
                    </tr>
                    <tr>
                        <th>Deskrpisi Produk </th>
                        <td>: <?= $data_produk->deskripsi; ?></td>
                    </tr>
                    <tr>
                        <th>Foto Produk </th>
                        <td>
                            : <img src="<?= base_url('sb2/img/produk/'.$data_produk->foto_produk) ?>" alt="Foto Produk">
                        </td>
                    </tr>
                    <tr>
                        <th>Tanggal Ditambahkan</th>
                        <td>: <?= date('d-m-Y H:i:s', strtotime($data_produk->tanggal_ditambahkan)); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Diupdate</th>
                        <td>: <?= date('d-m-Y H:i:s', strtotime($data_produk->tanggal_update)); ?></td>
                    </tr>
                </table>
                <div class="justify-content-end d-flex mt-3">
                    <a href="<?= base_url('data-produk') ?>" class="btn btn-secondary btn-sm">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>