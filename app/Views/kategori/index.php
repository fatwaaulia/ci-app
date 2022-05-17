<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h5 class="cap"><strong>Data</strong> <?= service('uri')->getSegment(1) ?></h5>
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

                        <a href="<?= base_url() . '/kategori/new' ?>">
                            <button type="button" class="btn btn-primary btn-sm mb-3">Tambah</button>
                        </a>

                        <table id="kategoriTb" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kategori</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kategori as $key => $row) { ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $row['nama'] ?></td>
                                        <td>
                                            <a href="<?= base_url() . '/kategori/edit/' . model('KategoriModel')->encId($row['id']) ?>">
                                                <button type="button" class="btn btn-primary btn-sm me-1 p-1 py-0 my-1"><i class="bi bi-pencil-square"></i></button>
                                            </a>
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-danger btn-sm p-1 py-0" data-bs-toggle="modal" data-bs-target="#delete<?= $row['id'] ?>">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="delete<?= $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus <?= service('uri')->getSegment(1) ?></h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="<?= base_url() . '/kategori/delete/' . model('KategoriModel')->encId($row['id']) ?>" method="post">
                                                            <div class="modal-body">
                                                                <span><b>Kategori :</b> <?= $row['nama'] ?></span> <br>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>