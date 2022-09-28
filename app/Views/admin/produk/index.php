<?= $this->extend('admin/template/layout'); ?>

<?= $this->Section('content'); ?>

<div class="container-fluid">
    <div class="card shadow ml-0 mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 text-primary">
                <i class="fas fa-table me-1"></i>
                Data produk
            </h5>
        </div>
        <div class="card-body">
            <!-- Alert berhasil Tambah Produk -->
                <?php if(session('success')) : ?>
                    <div class="alert alert-success" role="alert">
                        <?= session('success'); ?>
                     </div>
                <?php endif; ?>
                    <!-- Alert Gagal Tambah Kategori -->
                <?php if(session('failed')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= session('failed'); ?>
                    </div>
                <?php endif; ?>

            <a href="<?= base_url('data-produk/tambah');?>" class="btn btn-primary btn-sm mb-2">
            <i class="fas fa-plus"></i> Tambah Data</a>
            <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead >
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Foto Produk</th>
                        <th>Tanggal Ditambahkan</th>
                        <th class="text-center">Fungsi</th>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach($data_produk as $produk): ?>
                        <tr>
                            <td width="1%"><?= $no++; ?></td>
                            <td><?= $produk->nama_produk; ?></td>
                            <td><?= $produk->deskripsi; ?></td>
                            <td>
                                <img src="<?= base_url('sb2/img/produk/'.$produk->foto_produk); ?>" alt="Foto Produk" width="100px">
                            </td>
                            <td><?= date('d-m-Y H:i:s', strtotime($produk->tanggal_ditambahkan)); ?></td>
                            <td width="15%" class="text-center">
                                <a href="#" class="btn btn-secondary btn-sm mb-1" title="Detail"><i class="fas fa-eye"></i></a>
                                <a href="#" class="btn btn-success btn-sm mb-1" title="Edit"><i class="fas fa-user-edit"></i></a>
                                <button type="button" class="btn btn-danger btn-sm mb-1" title="Hapus" data-toggle="modal" data-target="#modalHapus"><i class="fas fa-trash-alt"></i></button>

                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>