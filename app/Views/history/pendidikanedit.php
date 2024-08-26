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

            <div class="card shadow border-left-primary mb-12">
                <div class="card-body">
                    <form action="<?= base_url($controller . '/savependidikan'); ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="hidden" name="pegawai_id" value="<?= $pegawai->pegawai_id ?>">
                        <input type="hidden" name="riwayatpendidikan_id" value="<?= $riwayat->riwayatpendidikan_id ?>">
                        <div class="form-group mb-4">
                            <label for="urutan">Urutan</label>
                            <input type="number" class="form-control <?= (isset(session('errors')['urutan'])) ? 'is-invalid' : '' ?>" id="urutan" name="urutan" value="<?= old('urutan', $riwayat->urutan) ?>">
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
                                    <option value="<?= $p->pendidikanterakhir_id ?>" <?= ($p->pendidikanterakhir_id = old('pendidikanterakhir_id', $riwayat->pendidikanterakhir_id)) ? 'selected' : '' ?>><?= $p->pendidikanterakhir_nama ?></option>
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
                            <input type="text" class="form-control <?= (isset(session('errors')['riwayatpendidikan_namasekolah'])) ? 'is-invalid' : '' ?>" id="riwayatpendidikan_namasekolah" name="riwayatpendidikan_namasekolah" value="<?= old('riwayatpendidikan_namasekolah', $riwayat->riwayatpendidikan_namasekolah) ?>">
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['riwayatpendidikan_namasekolah'])) : ?>
                                    <?= session('errors')['riwayatpendidikan_namasekolah'] ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="riwayatpendidikan_tahunmasuk">Tahun Masuk</label>
                            <input type="number" class="form-control <?= (isset(session('errors')['riwayatpendidikan_tahunmasuk'])) ? 'is-invalid' : '' ?>" id="riwayatpendidikan_tahunmasuk" name="riwayatpendidikan_tahunmasuk" value="<?= old('riwayatpendidikan_tahunmasuk', $riwayat->riwayatpendidikan_tahunmasuk) ?>">
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['riwayatpendidikan_tahunmasuk'])) : ?>
                                    <?= session('errors')['riwayatpendidikan_tahunmasuk'] ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="riwayatpendidikan_tahunlulus">Tahun Lulus</label>
                            <input type="number" class="form-control <?= (isset(session('errors')['riwayatpendidikan_tahunlulus'])) ? 'is-invalid' : '' ?>" id="riwayatpendidikan_tahunlulus" name="riwayatpendidikan_tahunlulus" value="<?= old('riwayatpendidikan_tahunlulus', $riwayat->riwayatpendidikan_tahunlulus) ?>">
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
                            <?php if ($riwayat->riwayatpendidikan_filesk != null) : ?>
                                <a href="<?= base_url('assets/file/' . $riwayat->riwayatpendidikan_filesk) ?>" class="text-primary" target="_blank">Lihat File</a>
                            <?php endif ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button> <a href="<?= base_url($controller . '/pendidikan/') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>