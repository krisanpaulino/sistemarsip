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
                    <form action="<?= base_url($controller . '/savepelatihan'); ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="hidden" name="pegawai_id" value="<?= $pegawai->pegawai_id ?>">
                        <input type="hidden" name="riwayatpelatihan_id" value="<?= $riwayat->riwayatpelatihan_id ?>">
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
                            <label for="riwayatpelatihan_namakegiatan">Nama Kegiatan</label>
                            <input type="text" class="form-control <?= (isset(session('errors')['riwayatpelatihan_namakegiatan'])) ? 'is-invalid' : '' ?>" id="riwayatpelatihan_namakegiatan" name="riwayatpelatihan_namakegiatan" value="<?= old('riwayatpelatihan_namakegiatan', $riwayat->riwayatpelatihan_namakegiatan) ?>">
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
                                    <input type="number" class="form-control <?= (isset(session('errors')['riwayatpelatihan_jumlahjam'])) ? 'is-invalid' : '' ?>" id="riwayatpelatihan_jumlahjam" name="riwayatpelatihan_jumlahjam" value="<?= old('riwayatpelatihan_jumlahjam', $riwayat->riwayatpelatihan_jumlahjam) ?>">
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
                            <input type="date" class="form-control <?= (isset(session('errors')['riwayatpelatihan_tanggalmulai'])) ? 'is-invalid' : '' ?>" id="riwayatpelatihan_tanggalmulai" name="riwayatpelatihan_tanggalmulai" value="<?= old('riwayatpelatihan_tanggalmulai', $riwayat->riwayatpelatihan_tanggalmulai) ?>">
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['riwayatpelatihan_tanggalmulai'])) : ?>
                                    <?= session('errors')['riwayatpelatihan_tanggalmulai'] ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="riwayatpelatihan_tanggalselesai">Tanggal Selesai</label>
                            <input type="date" class="form-control <?= (isset(session('errors')['riwayatpelatihan_tanggalselesai'])) ? 'is-invalid' : '' ?>" id="riwayatpelatihan_tanggalselesai" name="riwayatpelatihan_tanggalselesai" value="<?= old('riwayatpelatihan_tanggalselesai', $riwayat->riwayatpelatihan_tanggalselesai) ?>">
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
                            <?php if ($riwayat->riwayatpelatihan_filesk != null) : ?>
                                <a href="<?= base_url('assets/file/' . $riwayat->riwayatpelatihan_filesk) ?>" class="text-primary" target="_blank">Lihat File</a>
                            <?php endif ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button> <a href="<?= base_url($controller . '/pelatihan') ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>