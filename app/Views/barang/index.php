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

                        <a href="<?= base_url() . '/' . service('uri')->getSegment(1) . '/new' ?>">
                            <button type="button" class="btn btn-primary btn-sm mb-3">Tambah</button>
                        </a>

                        <table id="barangTb" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Barang</th>
                                    <th>Kategori</th>
                                    <th>Gambar</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Beli</th>
                                    <th>Harga Jual</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $key => $row) : ?>
                                    <tr>
                                        <td><?= $key + 1 ?></td>
                                        <td><?= $row['kode'] ?></td>
                                        <td><?= $row['nama_kategori'] ?></td>
                                        <td>
                                            <img src="<?= $row['file'] != '' ? base_url() . '/cms/img/barang/' . $row['file'] : base_url() . '/cms/img/barang/default.png' ?>"" class=" img-50 img-style me-1">
                                        </td>
                                        <td>
                                            <?= $row['nama'] ?>
                                        </td>
                                        <td><?= $row['harga_beli'] ?></td>
                                        <td><?= $row['harga_jual'] ?></td>
                                        <td>
                                            <a href="<?= base_url() . '/barang/edit/' . model('BarangModel')->encId($row['id']) ?>">
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
                                                        <form action="<?= base_url() . '/barang/delete/' . model('BarangModel')->encId($row['id']) ?>" method="post">
                                                            <div class="modal-body">
                                                                <span><b>Kode barang :</b> <?= $row['kode'] ?></span> <br>
                                                                <span><b>Nama barang :</b> <?= $row['nama'] ?></span> <br>
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
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>