<?= $this->extend('admin/template/layout'); ?>

<?= $this->Section('style'); ?>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<?= $this->endSection(); ?>

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





            <a href="<?= base_url('data-produk/tambah');?>" class="btn btn-primary btn-sm mb-2">
            <i class="fas fa-plus"></i> Tambah Data</a>

            <!-- Alert berhasil Tambah Produk -->
            <div class="swal" data-swal="<?= session('success') ?>"></div>

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
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalHapus<?= $produk->id_produk ?>"> <i class="fas fa-trash-alt"></i> </button>


                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<?php foreach($data_produk as $produk): ?>
<div class="modal fade" id="modalHapus<?= $produk->id_produk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="exampleModalLabel">Hapus Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('data-produk/delete-produk'.$produk->id_produk) ?>" method="post">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="DELETE">

            <p>Produk : <?= $produk->nama_produk; ?></p>
            <p>Data Yang di Hapus Tidak Dapat Dikembalikan!</p>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
        </div>
        </form>
      </div>

    </div>
  </div>
</div>
<?php endforeach; ?>


<?= $this->endSection(); ?>

<?= $this->Section('script'); ?>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const swal = $('.swal').data('swal');

        if (swal) {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text : swal,
                showConfirmButton: false,
                timer: 2500,
            })
        }

    </script>
<?= $this->endSection(); ?>