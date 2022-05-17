<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="cap"><strong>Form</strong> Edit <?= service('uri')->getSegment(1) ?></h5>
            </div>
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?= session()->getFlashdata('successMessage') ?>
        </div>
    </div>
</div>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url() . '/barang/update/' . model('UserModel')->encId($barang['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="<?= $barang['file'] != '' ? base_url() . '/cms/img/barang/' . $barang['file'] : base_url() . '/cms/img/barang/default.png' ?>" class="img-100 img-style rounded-circle" alt="<?= $barang['nama'] ?>" id="imgView">
                                            </div>
                                            <div class="col-md-9">
                                                <input type="file" class="img-preview <?= $val->hasError('file') ? "is-invalid" : '' ?>" name="file" accept=".jpg, .jpeg, .png" id="formFile">
                                                <div class="invalid-feedback">
                                                    <?= $val->getError('file') ?>
                                                </div>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-danger btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#deletePhoto">
                                                    <i class="bi bi-x-circle"></i> Hapus Gambar
                                                </button> <br>
                                                <!-- Modal -->
                                                <div class="modal fade" id="deletePhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <b>HAPUS GAMBAR BARANG ?</b>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                                <a href="<?= base_url() . '/BarangController/deleteFile/' . model('BarangModel')->encId($barang['id']) ?>" class="btn btn-danger btn-sm">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama" class="form-label">Nama Barang</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" value="<?= old('nama') ?? $barang['nama'] ?>" id="Nama" placeholder="masukkan nama">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('nama') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_kategori" class="form-label">Kategori</label><span class="text-danger">*</span>
                                        <select class="form-select <?= $val->hasError('id_kategori') ? "is-invalid" : '' ?>" name="id_kategori" id="select_box1">
                                            <option value="" selected>pilih kategori</option>
                                            <?php foreach ($kategori  as $kategori) : ?>
                                                <option value="<?= $kategori['id'] ?>" <?php
                                                                                        if (!old('id_barang')) {
                                                                                            if ($barang['id_kategori'] == $kategori['id']) echo 'selected';
                                                                                        } else {
                                                                                            if (old('id_kategori') == $kategori['id']) echo 'selected';
                                                                                        }
                                                                                        ?>><?= $kategori['nama'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('id_kategori') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_beli" class="form-label">Harga Beli</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control <?= $val->hasError('harga_beli') ? "is-invalid" : '' ?>" name="harga_beli" value="<?= old('harga_beli') ?? $barang['harga_beli'] ?>" id="harga_beli" placeholder="masukkan harga beli">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('harga_beli') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="harga_jual" class="form-label">Harga Jual</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control <?= $val->hasError('harga_jual') ? "is-invalid" : '' ?>" name="harga_jual" value="<?= old('harga_jual') ?? $barang['harga_jual'] ?>" id="harga_jual" placeholder="masukkan harga jual">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('harga_jual') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="Deskripsi" class="form-label">Deskripsi</label>
                                        <textarea class="form-control <?= $val->hasError('deskripsi') ? "is-invalid" : '' ?>" name="deskripsi" id="Deskripsi" rows="15"><?= old('deskripsi') ?? $barang['deskripsi'] ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('deskripsi') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>