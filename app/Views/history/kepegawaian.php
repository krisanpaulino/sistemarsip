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

            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahModal">Tambah Riwayat Kepegawaian</button>
            <div class="card shadow border-left-primary mb-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tabelKasus">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jenis Pegawai</th>
                                    <th scope="col">Nomor SK</th>
                                    <th scope="col">Tanggal SK</th>
                                    <th scope="col">File SK</th>
                                    <th scope="col">Golongan</th>
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
                                        <td><?= $r->jenispegawai_nama; ?>
                                            <?php
                                            if ($r->aktif == 'Y') {
                                            ?>
                                                <a href="javascript:;" class="badge bg-success text-light">Aktif</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $r->riwayatkepegawaian_nomorsk; ?></td>
                                        <td><?= $r->riwayatkepegawaian_tanggalsk; ?></td>
                                        <td><a href="<?= base_url('assets/file/' . $r->riwayatkepegawaian_id) ?>" target="_blank">File SK</a></td>
                                        <td><?= $r->golongan_nama; ?></td>
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
                                                <a href="<?= base_url($controller . '/editkepegawaian/' . $r->riwayatkepegawaian_id) ?>" class="badge bg-primary text-light">Edit</a>
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
                <h5 class="modal-title" id="deleteUserModalLabel">Tambah Riwayat Kepegawaian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url($controller . '/savekepegawaian'); ?>" enctype="multipart/form-data" method="post">
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
                        <label for="jenispegawai_id">Jenis Pegawai</label>
                        <select type="text" class="custom-select <?= (isset(session('errors')['jenispegawai_id'])) ? 'is-invalid' : '' ?>" name="jenispegawai_id" required>
                            <option value="">==Pilih Jenis Pegawai==</option>
                            <?php foreach ($jenispegawai as $j) : ?>
                                <option value="<?= $j->jenispegawai_id ?>" <?= ($j->jenispegawai_id == old('jenispegawai_id')) ? 'selected' : '' ?>><?= $j->jenispegawai_nama ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['jenispegawai_id'])) : ?>
                                <?= session('errors')['jenispegawai_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatkepegawaian_nomorsk">Nomor SK</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['riwayatkepegawaian_nomorsk'])) ? 'is-invalid' : '' ?>" id="riwayatkepegawaian_nomorsk" name="riwayatkepegawaian_nomorsk" value="<?= old('riwayatkepegawaian_nomorsk') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatkepegawaian_nomorsk'])) : ?>
                                <?= session('errors')['riwayatkepegawaian_nomorsk'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatkepegawaian_tanggalsk">Tanggal SK</label>
                        <input type="date" class="form-control <?= (isset(session('errors')['riwayatkepegawaian_tanggalsk'])) ? 'is-invalid' : '' ?>" id="riwayatkepegawaian_tanggalsk" name="riwayatkepegawaian_tanggalsk" value="<?= old('riwayatkepegawaian_tanggalsk') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatkepegawaian_tanggalsk'])) : ?>
                                <?= session('errors')['riwayatkepegawaian_tanggalsk'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="golongan_id">Golongan/Pangkat</label>
                        <select type="text" class="custom-select <?= (isset(session('errors')['golongan_id'])) ? 'is-invalid' : '' ?>" name="golongan_id" required>
                            <option value="">==Pilih Golongan==</option>
                            <?php foreach ($golongan as $j) : ?>
                                <option value="<?= $j->golongan_id ?>" <?= ($j->golongan_id == old('golongan_id')) ? 'selected' : '' ?>><?= $j->golongan_nama ?><?= $j->pangkat_nama ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['golongan_id'])) : ?>
                                <?= session('errors')['golongan_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="file">File SK</label>
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
                <h5 class="modal-title" id="deleteUserModalLabel">Hapus Data Riwayat Kepegawaian?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('riwayat/deletekepegawaian'); ?>" method="post">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" name="riwayatkepegawaian_id" id="kodeitemhapus">
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