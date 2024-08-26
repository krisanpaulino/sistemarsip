<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

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

            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahModal">Tambah Riwayat Pelatihan</button>
            <div class="card shadow border-left-primary mb-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tabelKasus">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Pelatihan</th>
                                    <th scope="col">Jumlah Jam</th>
                                    <th scope="col">Tanggal Mulai</th>
                                    <th scope="col">Tanggal Selesai</th>
                                    <th scope="col">File Sertifikat</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($riwayat as $r) : ?>
                                    <tr>
                                        <th scope="row"><?= $i; ?></th>
                                        <td><?= $r->riwayatpelatihan_namakegiatan; ?></td>
                                        <td><?= $r->riwayatpelatihan_jumlahjam; ?></td>
                                        <td><?= $r->riwayatpelatihan_tanggalmulai; ?></td>
                                        <td><?= $r->riwayatpelatihan_tanggalselesai; ?></td>
                                        <td><a href="<?= base_url('assets/file/' . $r->riwayatpelatihan_filesk) ?>" target="_blank">File Sertifikat</a></td>
                                        <td>
                                            <?php if ($r->checked == 'N') : ?>
                                                <span class="text-warning">Sedang Dalam Proses Pengecekan</span>
                                            <?php elseif ($r->checked == 'Y' && $r->is_valid == 'N') : ?>
                                                <span class="text-danger">Data anda belum valid :</span><br>
                                                <span><?= $r->keterangan ?></span>
                                            <?php else : ?>
                                                <span class="text-success">Validated</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($r->checked == 'Y') : ?>
                                                <a href="<?= base_url($controller . '/editpendidikan/' . $r->riwayatpendidikan_id) ?>" class="badge bg-primary text-light">Edit</a>
                                            <?php endif ?>

                                        </td>
                                    </tr>
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
                <h5 class="modal-title" id="deleteUserModalLabel">Tambah Riwayat Pelatihan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url($controller . '/savepelatihan'); ?>" enctype="multipart/form-data" method="post">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" name="pegawai_id" value="<?= $pegawai->pegawai_id ?>">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label for="urutan">Urutan</label>
                        <input type="number" class="form-control <?= (isset(session('errors')['urutan'])) ? 'is-invalid' : '' ?>" id="urutan" name="urutan" value="<?= old('urutan') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['urutan'])) : ?>
                                <?= session('errors')['urutan'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatpelatihan_namakegiatan">Nama Kegiatan</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['riwayatpelatihan_namakegiatan'])) ? 'is-invalid' : '' ?>" id="riwayatpelatihan_namakegiatan" name="riwayatpelatihan_namakegiatan" value="<?= old('riwayatpelatihan_namakegiatan') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatpelatihan_namakegiatan'])) : ?>
                                <?= session('errors')['riwayatpelatihan_namakegiatan'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatpelatihan_jumlahjam">Jumlah Jam</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="number" class="form-control <?= (isset(session('errors')['riwayatpelatihan_jumlahjam'])) ? 'is-invalid' : '' ?>" id="riwayatpelatihan_jumlahjam" name="riwayatpelatihan_jumlahjam" value="<?= old('riwayatpelatihan_jumlahjam') ?>">
                            </div>
                            <div class="col-6">Jam</div>
                        </div>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatpelatihan_jumlahjam'])) : ?>
                                <?= session('errors')['riwayatpelatihan_jumlahjam'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="riwayatpelatihan_tanggalmulai">Tanggal Mulai</label>
                        <input type="date" class="form-control <?= (isset(session('errors')['riwayatpelatihan_tanggalmulai'])) ? 'is-invalid' : '' ?>" id="riwayatpelatihan_tanggalmulai" name="riwayatpelatihan_tanggalmulai" value="<?= old('riwayatpelatihan_tanggalmulai') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatpelatihan_tanggalmulai'])) : ?>
                                <?= session('errors')['riwayatpelatihan_tanggalmulai'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatpelatihan_tanggalselesai">Tanggal Selesai</label>
                        <input type="date" class="form-control <?= (isset(session('errors')['riwayatpelatihan_tanggalselesai'])) ? 'is-invalid' : '' ?>" id="riwayatpelatihan_tanggalselesai" name="riwayatpelatihan_tanggalselesai" value="<?= old('riwayatpelatihan_tanggalselesai') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatpelatihan_tanggalselesai'])) : ?>
                                <?= session('errors')['riwayatpelatihan_tanggalselesai'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="file">File Sertifikat (.pdf)</label>
                        <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="file" name="file" value="<?= old('file') ?>">
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
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteUserModalLabel">Hapus Data Pelatihan?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url($controller . '/deletepelatihan'); ?>" method="post">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" name="riwayatpelatihan_id" id="kodeitemhapus">
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
<?= $this->endSection(); ?>