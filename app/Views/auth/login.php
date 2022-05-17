<body style="background-color:#f5f5f9">

    <section>
        <div class="container mt-4">
            <div class="row center-hor">
                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-body">
                            <h4>Selamat datang!👋</h4>
                            <p class="mb-2">Silahkan masuk ke akun anda</p>
                            <div style="min-height:45px">
                                <?= session()->getFlashdata('msgLogin') ?>
                            </div>
                            <form action="<?= base_url() . '/AuthController/loginProccess' ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="mb-2">
                                    <input type="email" class="form-control <?= $val->hasError('email') ? "is-invalid" : '' ?>" name="email" value="<?= old('email') ?>" id="Nama" placeholder="Email">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('email') ?>
                                    </div>
                                </div>
                                <div class="mb-3" style="position:relative">
                                    <input type="password" class="form-control <?= $val->hasError('password') ? "is-invalid" : '' ?>" name="password" value="<?= old('password') ?>" id="password" placeholder="Password">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('password') ?>
                                    </div>
                                    <div onclick="password()">
                                        <i class="bi bi-eye fs-18" id="show_eye" style="position:absolute;right:12px;top:5px"></i>
                                        <i class="bi bi-eye-slash fs-18 d-none" id="hide_eye" style="position:absolute;right:12px;top:5px"></i>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check mb-0">
                                        <div class="text-end">
                                            <a href="<?= base_url() . '/forgot-password/auth' ?>" class="text-right fs-14">Lupa password?</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary">Masuk</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>