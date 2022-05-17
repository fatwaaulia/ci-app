<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5><strong>Form</strong> Tambah Pengguna</h5>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url() . '/users/create' ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="<?= base_url() . '/cms/img/users/default.png' ?>" class="img-100 img-style rounded-circle" id="imgView">
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="center hor">
                                                    <input type="file" class="img-preview <?= $val->hasError('foto') ? "is-invalid" : '' ?>" name="foto" id="formFile">
                                                    <div class="invalid-feedback">
                                                        <?= $val->getError('foto') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama" class="form-label">Nama</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" value="<?= old('nama') ?>" id="Nama" placeholder="Masukkan Nama">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('nama') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Alamat" class="form-label">Alamat</label><span class="text-danger">*</span>
                                        <textarea type="text" class="form-control <?= $val->hasError('alamat') ? "is-invalid" : '' ?>" name="alamat" id="Alamat"><?= old('alamat') ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('alamat') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Deskripsi" class="form-label">Deskripsi</label>
                                        <textarea type="text" class="form-control <?= $val->hasError('deskripsi') ? "is-invalid" : '' ?>" name="deskripsi" id="Deskripsi"><?= old('deskripsi') ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('deskripsi') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="Telp" class="form-label">Telp</label><span class="text-danger">*</span>
                                        <input type="number" class="form-control <?= $val->hasError('telp') ? "is-invalid" : '' ?>" name="telp" value="<?= old('telp') ?>" id="Telp" placeholder="Masukkan Telp">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('telp') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Email" class="form-label">Email</label><span class="text-danger">*</span>
                                        <input type="email" class="form-control <?= $val->hasError('email') ? "is-invalid" : '' ?>" name="email" value="<?= old('email') ?>" id="Email" placeholder="name@example.com">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('email') ?>
                                        </div>
                                    </div>
                                    <div class="mb-2" style="position:relative">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" class="form-control <?= $val->hasError('password') ? "is-invalid" : '' ?>" name="password" value="<?= old('password') ?>" id="password" placeholder="Masukkan Password">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('password') ?>
                                        </div>
                                        <div onclick="password()">
                                            <i class="bi bi-eye fs-18" id="show_eye" style="position:absolute;right:12px;top:35px"></i>
                                            <i class="bi bi-eye-slash fs-18 d-none" id="hide_eye" style="position:absolute;right:12px;top:35px"></i>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control <?= $val->hasError('passconf') ? "is-invalid" : '' ?>" name="passconf" value="<?= old('passconf') ?>" placeholder="Konfirmasi Password">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('passconf') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">Tambahkan</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>