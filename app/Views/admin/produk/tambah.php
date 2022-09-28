<?= $this->extend('admin/template/layout'); ?>
<?= $this->Section('content'); ?>

<div class="container-fluid">
    <div class="card shadow ml-0 mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 text-primary">
                <i class="fas fa-plus me-1"></i>
                Form Tambah Produk
            </h5>
        </div>
        <div class="card-body">
            <form action="">
                <div class="rows mb-2">
                    <label for="nama_produk"><b>Nama Produk</b></label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control">
                </div>
                <div class="rows mb-2">
                    <label for="deskripsi"><b>Deskripsi</b></label>
                    <input type="text" name="deskripsi" id="deskripsi" class="form-control">
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>