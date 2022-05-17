<body style="background-color:#f5f5f9">

    <section>
        <div class="container mt-4">
            <div class="row center-hor">
                <div class="col-lg-4">

                    <div class="card">
                        <div class="card-body">
                            <h4>Lupa password? 🔒</h4>
                            <p class="mb-2">Masukkan email kamu yang telah terdaftar</p>
                            <div style="min-height:45px">
                                <?= session()->getFlashdata('msgForgotPassword') ?>
                            </div>
                            <form action="<?= base_url() . '/AuthController/passwordResetVal' ?>" method="post">
                                <?= csrf_field(); ?>
                                <div class="mb-3">
                                    <input type="email" class="form-control <?= $val->hasError('email') ? "is-invalid" : '' ?>" name="email" value="<?= old('email') ?>" id="Nama" placeholder="Email">
                                    <div class="invalid-feedback">
                                        <?= $val->getError('email') ?>
                                    </div>
                                </div>
                                <div class="d-grid gap-2 mb-2">
                                    <button type="submit" class="btn btn-primary">Kirim link</button>
                                </div>
                                <div class="d-grid gap-2">
                                    <a href="<?= base_url() . '/login/auth' ?>" class="text-center fs-14">
                                        < Kembali</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>