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
                    <form action="<?= base_url($controller . '/savepangkat'); ?>" enctype="multipart/form-data" method="post">
                        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                        <input type="hidden" name="pegawai_id" value="<?= $pegawai->pegawai_id ?>">
                        <input type="hidden" name="riwayatpangkat_id" value="<?= $riwayat->riwayatpangkat_id ?>">
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
                            <label for="riwayatpangkat_tmtpangkat">TMT Pangkat</label>
                            <input type="date" class="form-control <?= (isset(session('errors')['riwayatpangkat_tmtpangkat'])) ? 'is-invalid' : '' ?>" id="riwayatpangkat_tmtpangkat" name="riwayatpangkat_tmtpangkat" value="<?= old('riwayatpangkat_tmtpangkat', $riwayat->riwayatpangkat_tmtpangkat) ?>">
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['riwayatpangkat_tmtpangkat'])) : ?>
                                    <?= session('errors')['riwayatpangkat_tmtpangkat'] ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="golongan_id">Golongan/Pangkat</label>
                            <select type="text" class="custom-select <?= (isset(session('errors')['golongan_id'])) ? 'is-invalid' : '' ?>" name="golongan_id" required>
                                <option value="">==Pilih Golongan/Pangkat==</option>
                                <?php foreach ($golongan as $j) : ?>
                                    <option value="<?= $j->golongan_id ?>" <?= ($j->golongan_id == old('golongan_id', $j->golongan_id)) ? 'selected' : '' ?>><?= $j->golongan_nama ?>/<?= $j->pangkat_nama ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['golongan_id'])) : ?>
                                    <?= session('errors')['golongan_id'] ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="file">Ganti File SK(.pdf)</label>
                            <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="file" name="file" value="<?= old('file') ?>">
                            <div class="invalid-feedback">
                                <?php if (session()->has('error') == true) : ?>
                                    <?= session('error') ?>
                                <?php endif; ?>
                            </div>
                            <?php if ($riwayat->riwayatpangkat_filesk != null) : ?>
                                <a href="<?= base_url('assets/file/' . $riwayat->riwayatpangkat_filesk) ?>" class="text-primary" target="_blank">Lihat File</a>
                            <?php endif ?>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button> <a href="<?= base_url($controller . '/pangkat/' . $pegawai->pegawai_id) ?>" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

<?= $this->endSection(); ?>