<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></small></h1>

    <div class="row">
        <div class="col-lg">
            <?php if (session()->has('danger')) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= session('danger') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->has('success')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session('success') ?>
                </div>
            <?php endif; ?>
            <?php if (session()->has('danger')) : ?>
            <?php endif; ?>

            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahModal">Tambah Dokumen</button>
            <div class="card shadow border-left-primary mb-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tabelKasus">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jenis Dokumen</th>
                                    <th scope="col">Nama Dokumen</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($riwayat as $d) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $d->dokumen_nama; ?></td>
                                        <td><?= $d->riwayatdokumen_nama; ?></td>
                                        <td>
                                            <?php if ($d->checked == 'N') : ?>
                                                <span class="text-warning">Sedang Dalam Proses Pengecekan</span>
                                            <?php elseif ($d->checked == 'Y' && $d->is_valid == 'N') : ?>
                                                <span class="text-danger">Data anda belum valid :</span><br>
                                                <span><?= $d->keterangan ?></span>
                                            <?php else : ?>
                                                <span class="text-success">Validated</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>

                                            <?php if ($d->checked == 'Y') : ?>
                                                <a href="javascript:;" class="badge bg-primary text-light" data-toggle="modal" data-target="#editModal<?= $d->riwayatdokumen_id ?>" data-id="<?= $d->riwayatdokumen_id ?>" data-nama="<?= $d->riwayatdokumen_nama ?>">Edit</a>
                                                <!-- <a href="<?= base_url($controller . '/editdokumen/' . $d->riwayatdokumen_id) ?>" class="badge bg-primary text-light">Edit</a> -->
                                            <?php endif ?>
                                            <a href="<?= base_url('assets/file/' . $d->riwayatdokumen_file) ?>" data-id="<?= $d->riwayatdokumen_id ?>" class="badge badge-info" target="_blank">Lihat File</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editModal<?= $d->riwayatdokumen_id ?>" tabindex="-1" role="dialog" aria-labelledby="editNamaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel">Edit Dokumen</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url($controller . '/updatedokumen/' . $d->riwayatdokumen_id); ?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                    <input type="hidden" name="pegawai_id" id="pegawai_id" value="<?= $pegawai->pegawai_id ?>" required>
                                                    <div class="modal-body">
                                                        <div class="form-group mb-4">
                                                            <label for="dokumen_id">Jenis dokumen</label>
                                                            <select name="dokumen_id" id="dokumen_id" class="form-control" required>
                                                                <option value="<?= $d->dokumen_id ?>"><?= $d->dokumen_nama ?></option>
                                                                <?php
                                                                foreach ($jenisdokumen as $value) :
                                                                ?>
                                                                    <option value="<?= $value->dokumen_id ?>"><?= $value->dokumen_nama ?></option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['dokumen_id'])) : ?>
                                                                    <?= session('errors')['dokumen_id'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="riwayatdokumen_nama">Nama Dokumen</label>
                                                            <input type="text" class="form-control <?= (isset(session('errors')['riwayatdokumen_nama'])) ? 'is-invalid' : '' ?>" id="riwayatdokumen_nama" name="riwayatdokumen_nama" value="<?= $d->riwayatdokumen_nama ?>" required>
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['riwayatdokumen_nama'])) : ?>
                                                                    <?= session('errors')['riwayatdokumen_nama'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="riwayatdokumen_file">File dokumen</label>
                                                            <div>
                                                                <p><?= $d->riwayatdokumen_file ?></p>
                                                                <a href="<?= base_url('assets/file/' . $d->riwayatdokumen_file) ?>" data-id="<?= $d->riwayatdokumen_id ?>" class="badge badge-info" target="_blank">Lihat file</a>
                                                                <!-- <img src="<?= base_url('assets/file/' . $d->riwayatdokumen_file) ?>" width="100" height="100" alt="File Dokumen : <?= $d->riwayatdokumen_file ?>"> -->
                                                            </div>
                                                            <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="riwayatdokumen_file" name="riwayatdokumen_file" value="<?= old('riwayatdokumen_file') ?>">
                                                            <div class="invalid-feedback">
                                                                <?php if (session()->has('error') == true) : ?>
                                                                    <?= session('error') ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="deleteModal<?= $d->riwayatdokumen_id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel">Hapus Data Dokumen?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('riwayat/deletedokumen/' . $d->riwayatdokumen_id); ?>" method="post">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                    <input type="hidden" name="riwayatdokumen_id" value="<?= $d->riwayatdokumen_id ?>" id="kodeitemhapus">
                                                    <div class="modal-body">
                                                        Klik tombol hapus untuk menghapus data, atau tombol batal untuk membatalkan.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                    $i++;
                                endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->


<!-- End of Main Content -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Tambah Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url($controller . '/insertdokumen'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" name="pegawai_id" id="pegawai_id" value="<?= $pegawai->pegawai_id ?>">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="dokumen_id">Jenis dokumen</label>
                        <select name="dokumen_id" id="dokumen_id" class="form-control" required>
                            <option value="">- Pilih jenis dokumen -</option>
                            <?php
                            foreach ($jenisdokumen as $value) :
                            ?>
                                <option value="<?= $value->dokumen_id ?>"><?= $value->dokumen_nama ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['dokumen_id'])) : ?>
                                <?= session('errors')['dokumen_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatdokumen_nama">Nama Dokumen</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['riwayatdokumen_nama'])) ? 'is-invalid' : '' ?>" id="riwayatdokumen_nama" name="riwayatdokumen_nama" value="<?= old('riwayatdokumen_nama') ?>">
                        <div class="invalid-feedback" required>
                            <?php if (isset(session('errors')['riwayatdokumen_nama'])) : ?>
                                <?= session('errors')['riwayatdokumen_nama'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatdokumen_file">File dokumen</label>
                        <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="riwayatdokumen_file" name="riwayatdokumen_file" value="<?= old('riwayatdokumen_file') ?>" required>
                        <div class="invalid-feedback">
                            <?php if (session()->has('error') == true) : ?>
                                <?= session('error') ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?= $this->endSection(); ?>