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
                        <form action="<?= base_url() . '/kategori/update/' . model('KategoriModel')->encId($kategori['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="Nama" class="form-label">Nama Kategori</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control <?= $val->hasError('nama') ? "is-invalid" : '' ?>" name="nama" value="<?= old('nama') ?? $kategori['nama'] ?>" id="Nama" placeholder="Masukkan Nama">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('nama') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Deskripsi" class="form-label">Deskripsi</label>
                                        <textarea class="form-control <?= $val->hasError('deskripsi') ? "is-invalid" : '' ?>" name="deskripsi" id="Deskripsi"><?= old('deskripsi') ?? $kategori['deskripsi'] ?></textarea>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('deskripsi') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!--  -->
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