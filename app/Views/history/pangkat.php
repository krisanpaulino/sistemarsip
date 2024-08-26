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

            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahModal">Tambah Riwayat Pangkat</button>
            <div class="card shadow border-left-primary mb-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tabelKasus">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Golongan</th>
                                    <th scope="col">Pangkat</th>
                                    <th scope="col">TMT Pangkat</th>
                                    <th scope="col">Tgl Kenaikan Berikutnya</th>
                                    <th scope="col">File SK</th>
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
                                        <td><?= $r->golongan_nama; ?>
                                            <?php
                                            if ($r->aktif == 'Y' && $r->is_valid == 'Y') {
                                            ?>
                                                <a href="javascript:;" class="badge bg-success text-light">Aktif</a>
                                            <?php
                                            }
                                            ?>
                                            <?php
                                            if ($r->checked == 'Y' && $r->is_valid == 'N') {
                                            ?>
                                                <a href="javascript:;" class="badge bg-danger text-light">Ditolak</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $r->pangkat_nama; ?></td>
                                        <td><?= $r->riwayatpangkat_tmtpangkat; ?></td>
                                        <td><?= $r->riwayatpangkat_tanggalberikutnya; ?></td>
                                        <td><a href="<?= base_url('assets/file/' . $r->riwayatpangkat_filesk) ?>" target="_blank">File SK</a></td>
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
                                                <a href="<?= base_url($controller . '/editpangkat/' . $r->riwayatpangkat_id) ?>" class="badge bg-primary text-light">Edit</a>
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
                <h5 class="modal-title" id="deleteUserModalLabel">Tambah Riwayat Pangkat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url($controller . '/savepangkat'); ?>" enctype="multipart/form-data" method="post">
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
                        <label for="golongan_id">Golongan/Pangkat</label>
                        <select type="text" class="custom-select <?= (isset(session('errors')['golongan_id'])) ? 'is-invalid' : '' ?>" name="golongan_id" required>
                            <option value="">==Pilih Golongan==</option>
                            <?php foreach ($golongan as $j) : ?>
                                <option value="<?= $j->golongan_id ?>" <?= ($j->golongan_id == old('golongan_id')) ? 'selected' : '' ?>><?= $j->golongan_nama ?>/<?= $j->pangkat_nama ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['golongan_id'])) : ?>
                                <?= session('errors')['golongan_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="riwayatpangkat_tmtpangkat">TMT Pangkat</label>
                        <input type="date" class="form-control <?= (isset(session('errors')['riwayatpangkat_tmtpangkat'])) ? 'is-invalid' : '' ?>" id="riwayatpangkat_tmtpangkat" name="riwayatpangkat_tmtpangkat" value="<?= old('riwayatpangkat_tmtpangkat') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatpangkat_tmtpangkat'])) : ?>
                                <?= session('errors')['riwayatpangkat_tmtpangkat'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="riwayatpangkat_tanggalberikutnya">Tanggal Kenaikan Berikutnya</label>
                        <input type="date" class="form-control <?= (isset(session('errors')['riwayatpangkat_tanggalberikutnya'])) ? 'is-invalid' : '' ?>" id="riwayatpangkat_tanggalberikutnya" name="riwayatpangkat_tanggalberikutnya" value="<?= old('riwayatpangkat_tanggalberikutnya') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatpangkat_tanggalberikutnya'])) : ?>
                                <?= session('errors')['riwayatpangkat_tanggalberikutnya'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <label for="file">File SK (.pdf)</label>
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
                <h5 class="modal-title" id="deleteUserModalLabel">Hapus Data Riwayat Pangkat?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url($controller . '/deletepangkat'); ?>" method="post">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" name="riwayatpangkat_id" id="kodeitemhapus">
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