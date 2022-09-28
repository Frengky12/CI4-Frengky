<?= $this->extend('admin/template/layout'); ?>

<?= $this->Section('style'); ?>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<?= $this->endSection(); ?>


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
            <div class="swal" data-swal="<?= session('failed') ?>"></div>

            <form action="<?= base_url('data-produk/tambah-produk'); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                                    <div class="rows mb-3">
                                        <label for="nama_produk"><b>Nama Produk</b></label>
                                        <input type="text" name="nama_produk" id="nama_produk" class="form-control <?= $validation->hasError('nama_produk') ? 'is-invalid' : null ?>" value="<?= old('nama_produk') ?>">

                                        <?php if($validation->hasError('nama_produk')): ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('nama_produk'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>


                <div class="rows mb-3">
                    <label for="deskripsi"><b>Deskripsi</b></label>
                    <textarea type="text" name="deskripsi" id="deskripsi" cols="30" rows="10" class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : null ?>" value="<?= old('deskripsi') ?>"><?= old('deskripsi'); ?></textarea>

                    <?php if($validation->hasError('deskripsi')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('deskripsi'); ?>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="mb-3">
                    <label for="foto_produk"><b>Foto Produk</b></label>
                    <div class="custom-file">
                            <input type="file" class="custom-file-input <?= $validation->hasError('foto_produk') ? 'is-invalid' : null ?>" value="<?= old('foto_produk') ?>" name="foto_produk" id="foto_produk" onchange="previewImg()">
                            <label class="custom-file-label" for="foto_produk">Pilih foto...</label>
                            <small class="float-right">(Format jpg, jpeg, png, Max 2 MB)</small>
                    </div>
                    <?php if($validation->hasError('foto_produk')): ?>
                        <div class="invalid-feedback">
                            <?= $validation->getError('foto_produk'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="mt-1">
                        <img src="" alt="" class="img-thumbnail img-preview" width="100px">
                    </div>
                </div>

                <div class="justify-content-end d-flex">
                    <button type="submit" class="btn btn-primary btn-sm">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>

<?= $this->Section('script'); ?>
<script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

<script>
    // CKEDITOR.replace( 'deskripsi' );
</script>
<script>
    function previewImg() {
        const gambar = document.querySelector('#foto_produk');
        const gambarLabel = document.querySelector('.custom-file-label');
        const imgPreview = document.querySelector('.img-preview');

        gambarLabel.textContent = gambar.files[0].name;

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const swal = $('.swal').data('swal');
        if (swal) {
            Swal.fire({
                icon: 'warning',
                title: 'Gagal',
                text : swal, 
                showConfirmButton: false,
                timer: 2000
            })
        }
    </script>

<?= $this->endSection(); ?>