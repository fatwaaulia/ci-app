<body style="background-color:#f5f5f9">

    <section>
        <div class="container mt-4">
            <div class="row center-hor">
                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-body">
                            <h4>Reset Password</h4>
                            <p class="mb-2">Masukkan password baru</p>
                            <div style="min-height:45px">
                                <?= session()->getFlashdata('msgLogin') ?>
                            </div>
                            <form action="<?= base_url() . '/AuthController/updatePassword/' . $token ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="mb-2" style="position:relative">
                                    <input type="password" class="form-control <?= $val->hasError('password') ? "is-invalid" : '' ?>" name="password" value="<?= old('password') ?>" id="password" placeholder="Masukkan Password">
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
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Reset</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>