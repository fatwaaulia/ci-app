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
                        <form action="<?= base_url() . '/stok/update/' . model('StokModel')->encId($stok['id']) ?>" method="post" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="id_barang" class="form-label">Nama Barang</label><span class="text-danger">*</span>
                                        <select class="form-select <?= $val->hasError('id_barang') ? "is-invalid" : '' ?>" name="id_barang" id="select_box1">
                                            <option value="" selected>pilih barang</option>
                                            <?php foreach ($barang  as $barang) : ?>
                                                <option value="<?= $barang['id'] ?>" <?php
                                                                                        if (!old('id_barang')) {
                                                                                            if ($stok['id_barang'] == $barang['id']) echo 'selected';
                                                                                        } else {
                                                                                            if (old('id_barang') == $barang['id']) echo 'selected';
                                                                                        }
                                                                                        ?>><?= $barang['nama'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('id_barang') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="supplier" class="form-label">Supplier</label><span class="text-danger">*</span>
                                        <select class="form-select <?= $val->hasError('id_supplier') ? "is-invalid" : '' ?>" name="id_supplier[]" multiple id="select_box2">
                                            <option value="" selected>pilih supplier</option>
                                            <?php foreach ($supplier  as $supplier) : ?>
                                                <option value="<?= $supplier['id'] ?>" <?php
                                                                                        if (!old('id_supplier')) {
                                                                                            $supplierArray = explode(',', $stok['id_supplier']);
                                                                                            foreach ($supplierArray as $value) {
                                                                                                if ($value == $supplier['id']) echo 'selected';
                                                                                            }
                                                                                        } else {
                                                                                            $supplierString = substr(implode(',', old('id_supplier')), 1);
                                                                                            $supplierArray = explode(',', $supplierString);
                                                                                            foreach ($supplierArray as $value) {
                                                                                                if ($value == $supplier['id']) echo 'selected';
                                                                                            }
                                                                                        }
                                                                                        ?>><?= $supplier['nama'] ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('id_supplier') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok</label><span class="text-danger">*</span>
                                        <input type="text" class="form-control <?= $val->hasError('stok') ? "is-invalid" : '' ?>" name="stok" value="<?= old('stok') ?? $stok['stok'] ?>" id="stok" placeholder="masukkan stok">
                                        <div class="invalid-feedback">
                                            <?= $val->getError('stok') ?>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="satuan" class="form-label">Satuan</label><span class="text-danger">*</span>
                                        <select class="form-select <?= $val->hasError('satuan') ? "is-invalid" : '' ?>" name="satuan" id="satuan" aria-label="Default select example">
                                            <?php foreach (model('StokModel')->listSatuan() as $satuan) : ?>
                                                <option value="<?= $satuan ?>" <?php
                                                                                if (!old('satuan')) {
                                                                                    if ($stok['satuan'] == $satuan) echo 'selected';
                                                                                } else {
                                                                                    if (old('satuan') == $satuan) echo 'selected';
                                                                                }
                                                                                ?>><?= $satuan ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= $val->getError('satuan') ?>
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