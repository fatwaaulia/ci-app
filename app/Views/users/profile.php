<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5><strong>Pengaturan</strong> Profil</h5>
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
                        <form action="<?= base_url() . '/CMSController/updateProfile/' . model('UserModel')->encId($user['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="<?= $user['foto'] != '' ? base_url() . '/cms/img/users/' . $user['foto'] : base_url() . '/cms/img/users/default.png' ?>" class="img-100 img-style rounded-circle" alt="<?= $user['nama'] ?>" id="imgView">
                                            </div>
                                            <div class="col-md-9">
                                                <input type="file" class="img-preview <?= $val->hasError('foto') ? "is-invalid" : '' ?>" name="foto" accept=".jpg, .jpeg, .png" id="formFile">
                                                <div class="invalid-feedback">
                                                    <?= $val->getError('foto') ?>
                                                </div>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-outline-danger btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#deletePhoto">
                                                    <i class="bi bi-x-circle"></i> Hapus Foto
                                                </button> <br>
                                                <!-- Modal -->
                                                <div class="modal fade" id="deletePhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                                <b>HAPUS FOTO PROFIL ?</b>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                                <a href="<?= base_url() . '/CMSController/deletePhoto/' . model('UserModel')->encId($user['id']) ?>" class="btn btn-danger btn-sm">Hapus</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Nama" class="form-label">Nama</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" value="<?= old('nama') ?? $user['nama'] ?>" id="Nama" placeholder="Masukkan Nama">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('nama') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Alamat" class="form-label">Alamat</label><span class="text-danger">*</span>
                                        <textarea class="form-control <?= $val->hasError('alamat') ? "is-invalid" : '' ?>" name="alamat" id="Alamat"><?= old('alamat') ?? $user['alamat'] ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('alamat') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Deskripsi" class="form-label">Deskripsi</label><span class="text-danger">*</span>
                                        <textarea class="form-control <?= $val->hasError('deskripsi') ? "is-invalid" : '' ?>" name="deskripsi" id="Deskripsi"><?= old('deskripsi') ?? $user['deskripsi'] ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('deskripsi') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="Telp" class="form-label">Telp</label><span class="text-danger">*</span>
                                        <input type="number" class="form-control <?= $val->hasError('telp') ? "is-invalid" : '' ?>" name="telp" value="<?= old('telp') ?? $user['telp'] ?>" id="Telp" placeholder="Masukkan Telp">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('telp') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Email" class="form-label">Email</label><span class="text-danger">*</span>
                                        <input type="email" class="form-control" value="<?= $user['email'] ?>" id="Email" disabled>
                                    </div>
                                    <div class="mb-2">
                                        <label for="Password" class="form-label">Password</label> <?= session()->getFlashdata('messageFailed') ?>
                                        <input type="password" class="form-control" name="oldpass" value="<?= old('oldpass') ?>" id="Password" placeholder="Password Lama">
                                    </div>
                                    <div class="mb-2" style="position:relative">
                                        <input type="password" class="form-control <?= $val->hasError('password') ? "is-invalid" : '' ?>" name="password" value="<?= old('password') ?>" id="password" placeholder="Password Baru">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('password') ?>
                                        </div>
                                        <div onclick="password()">
                                            <i class="bi bi-eye fs-18" id="show_eye" style="position:absolute;right:12px;top:5px"></i>
                                            <i class="bi bi-eye-slash fs-18 d-none" id="hide_eye" style="position:absolute;right:12px;top:5px"></i>
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
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>

                    </div>
                </div>


            </div>
        </div>
    </div>
</section>