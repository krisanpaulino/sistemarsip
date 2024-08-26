<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?> | <small><?= $nama; ?></small></h1>

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

            <button class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambahModal">Tambah riwayat</button>
            <div class="card shadow border-left-primary mb-12">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover" id="tabelKasus">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Pangkat</th>
                                    <th scope="col">Mulai tanggal</th>
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
                                        <td>
                                            <?= $d->pangkat_nama; ?>
                                            <?php
                                            if ($d->aktif == 'Y') {
                                            ?>
                                                <a href="javascript:;" class="badge bg-success text-light">Aktif</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $d->riwayatinpassing_tmtpangkat; ?></td>
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
                                                <a href="javascript:;" class="badge bg-primary text-light" data-toggle="modal" data-target="#editModal<?= $d->riwayatinpassing_id ?>" data-id="<?= $d->riwayatinpassing_id ?>">Edit</a>
                                            <?php endif ?>
                                            <a href="<?= base_url('assets/file/' . $d->riwayatinpassing_filesk) ?>" class="badge badge-info" style="width:50px" target="_blank">File SK</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editModal<?= $d->riwayatinpassing_id ?>" tabindex="-1" role="dialog" aria-labelledby="editNamaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel">Edit riwayat</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url($controller . '/updateinpassing/' . $d->riwayatinpassing_id); ?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                    <input type="hidden" name="pegawai_id" id="pegawai_id" value="<?= $pegawai_id ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group mb-4">
                                                            <label for="urutan">Urutan</label>
                                                            <input type="text" class="form-control <?= (isset(session('errors')['urutan'])) ? 'is-invalid' : '' ?>" id="urutan" name="urutan" value="<?= old('urutan', $d->urutan) ?>">
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['urutan'])) : ?>
                                                                    <?= session('errors')['urutan'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="golongan_id">Golongan</label>
                                                            <select name="golongan_id" id="golongan_id" class="form-control" required>
                                                                <option value="<?= $d->golongan_id ?>"><?= $d->pangkat_nama ?></option>
                                                                <?php
                                                                foreach ($golongan as $value) :
                                                                ?>
                                                                    <option value="<?= $value->golongan_id ?>"><?= $value->golongan_nama ?> - <?= $value->pangkat_nama ?></option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['golongan_id'])) : ?>
                                                                    <?= session('errors')['golongan_id'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="riwayatinpassing_tmtpangkat">Terhitung mulai tanggal</label>
                                                            <input type="date" class="form-control <?= (isset(session('errors')['riwayatinpassing_tmtpangkat'])) ? 'is-invalid' : '' ?>" id="riwayatinpassing_tmtpangkat" name="riwayatinpassing_tmtpangkat" value="<?= $d->riwayatinpassing_tmtpangkat ?>" required>
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['riwayatinpassing_tmtpangkat'])) : ?>
                                                                    <?= session('errors')['riwayatinpassing_tmtpangkat'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="riwayatinpassing_filesk">File SK</label>
                                                            <div>
                                                                <!-- <p><?= $d->riwayatinpassing_filesk ?></p> -->
                                                                <a href="<?= base_url('assets/file/' . $d->riwayatinpassing_filesk) ?>" class="badge badge-info" target="_blank">Lihat file</a>
                                                            </div>
                                                            <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="riwayatinpassing_filesk" name="riwayatinpassing_filesk" value="<?= old('riwayatinpassing_filesk') ?>">
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
                                    <div class="modal fade" id="deleteModal<?= $d->riwayatinpassing_id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel">Hapus Data Dokumen?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('riwayat/deleteinpassing/' . $d->riwayatinpassing_id); ?>" method="post">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                    <input type="hidden" name="riwayatinpassing_id" value="<?= $d->riwayatinpassing_id ?>" id="kodeitemhapus">
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
            <form action="<?= base_url($controller . '/insertinpassing'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" name="pegawai_id" id="pegawai_id" value="<?= $pegawai_id ?>">
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <div class="form-group mb-4">
                            <label for="urutan">Urutan</label>
                            <input type="number" class="form-control <?= (isset(session('errors')['urutan'])) ? 'is-invalid' : '' ?>" id="urutan" name="urutan" value="<?= old('urutan') ?>">
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['urutan'])) : ?>
                                    <?= session('errors')['urutan'] ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <label for="golongan_id">Golongan</label>
                        <select name="golongan_id" id="golongan_id" class="form-control" required>
                            <option value="">- Pilih golongan -</option>
                            <?php
                            foreach ($golongan as $value) :
                            ?>
                                <option value="<?= $value->golongan_id ?>"><?= $value->golongan_nama ?> - <?= $value->pangkat_nama ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['golongan_id'])) : ?>
                                <?= session('errors')['golongan_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatinpassing_tmtpangkat">Terhitung mulai tanggal</label>
                        <input type="date" class="form-control <?= (isset(session('errors')['riwayatinpassing_tmtpangkat'])) ? 'is-invalid' : '' ?>" id="riwayatinpassing_tmtpangkat" name="riwayatinpassing_tmtpangkat" value="<?= old('riwayatinpassing_tmtpangkat') ?>" required>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatinpassing_tmtpangkat'])) : ?>
                                <?= session('errors')['riwayatinpassing_tmtpangkat'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatinpassing_filesk">File SK</label>
                        <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="riwayatinpassing_filesk" name="riwayatinpassing_filesk" value="<?= old('riwayatinpassing_filesk') ?>" required>
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