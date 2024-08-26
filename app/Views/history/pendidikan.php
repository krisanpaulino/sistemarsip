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

            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahModal">Tambah Riwayat Pendidikan</button>
            <div class="card shadow border-left-primary mb-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tabelKasus">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Tingkat Pendidikan</th>
                                    <th scope="col">Nama Sekolah</th>
                                    <th scope="col">Tahun Masuk</th>
                                    <th scope="col">Tahun Lulus</th>
                                    <th scope="col">File Ijazah</th>
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
                                        <td><?= $r->pendidikanterakhir_nama; ?>
                                            <?php
                                            if ($r->aktif == 'Y') {
                                            ?>
                                                <a href="javascript:;" class="badge bg-success text-light">Aktif</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $r->riwayatpendidikan_namasekolah; ?></td>
                                        <td><?= $r->riwayatpendidikan_tahunmasuk; ?></td>
                                        <td><?= $r->riwayatpendidikan_tahunlulus; ?></td>
                                        <td><a href="<?= base_url('assets/file/' . $r->riwayatpendidikan_filesk) ?>" target="_blank">File Ijazah</a></td>
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
                <h5 class="modal-title" id="deleteUserModalLabel">Tambah Riwayat Pendidikan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url($controller . '/savependidikan'); ?>" enctype="multipart/form-data" method="post">
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
                        <label for="pendidikanterakhir_id">Tingkat Pendidikan</label>
                        <select type="text" class="form-control <?= (isset(session('errors')['pendidikanterakhir_id'])) ? 'is-invalid' : '' ?>" id="pendidikanterakhir_id" name="pendidikanterakhir_id">
                            <option value="">== Pilih Tingkat Pendidikan ==</option>
                            <?php foreach ($pendidikan as $p) : ?>
                                <option value="<?= $p->pendidikanterakhir_id ?>" <?= ($p->pendidikanterakhir_id = old('pendidikanterakhir_id')) ? 'selected' : '' ?>><?= $p->pendidikanterakhir_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['pendidikanterakhir_id'])) : ?>
                                <?= session('errors')['pendidikanterakhir_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatpendidikan_namasekolah">Nama Sekolah</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['riwayatpendidikan_namasekolah'])) ? 'is-invalid' : '' ?>" id="riwayatpendidikan_namasekolah" name="riwayatpendidikan_namasekolah" value="<?= old('riwayatpendidikan_namasekolah') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatpendidikan_namasekolah'])) : ?>
                                <?= session('errors')['riwayatpendidikan_namasekolah'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="riwayatpendidikan_tahunmasuk">Tahun Masuk</label>
                        <input type="number" class="form-control <?= (isset(session('errors')['riwayatpendidikan_tahunmasuk'])) ? 'is-invalid' : '' ?>" id="riwayatpendidikan_tahunmasuk" name="riwayatpendidikan_tahunmasuk" value="<?= old('riwayatpendidikan_tahunmasuk') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatpendidikan_tahunmasuk'])) : ?>
                                <?= session('errors')['riwayatpendidikan_tahunmasuk'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="riwayatpendidikan_tahunlulus">Tahun Lulus</label>
                        <input type="number" class="form-control <?= (isset(session('errors')['riwayatpendidikan_tahunlulus'])) ? 'is-invalid' : '' ?>" id="riwayatpendidikan_tahunlulus" name="riwayatpendidikan_tahunlulus" value="<?= old('riwayatpendidikan_tahunlulus') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatpendidikan_tahunlulus'])) : ?>
                                <?= session('errors')['riwayatpendidikan_tahunlulus'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="file">File Ijazah (.pdf)</label>
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
                <h5 class="modal-title" id="deleteUserModalLabel">Hapus Data Riwayat Pendidikan?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('riwayat/deletependidikan'); ?>" method="post">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" name="riwayatpendidikan_id" id="kodeitemhapus">
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