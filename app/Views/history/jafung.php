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
                                    <th scope="col">Jafung</th>
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
                                            <?= $d->jafung_nama; ?>
                                            <?php
                                            if ($d->aktif == 'Y') {
                                            ?>
                                                <a href="javascript:;" class="badge bg-success text-light">Aktif</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $d->riwayatjafung_tmtjafung; ?></td>
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
                                                <a href="javascript:;" class="badge bg-primary text-light" data-toggle="modal" data-target="#editModal<?= $d->riwayatjafung_id ?>" data-id="<?= $d->riwayatjafung_id ?>">Edit</a>
                                            <?php endif ?>
                                            <a href="<?= base_url('assets/file/' . $d->riwayatjafung_filesk) ?>" class="badge badge-info" style="width:50px" target="_blank">File SK</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editModal<?= $d->riwayatjafung_id ?>" tabindex="-1" role="dialog" aria-labelledby="editNamaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel">Edit riwayat</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url($controller . '/updatejafung/' . $d->riwayatjafung_id); ?>" method="post" enctype="multipart/form-data">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                    <input type="hidden" name="pegawai_id" id="pegawai_id" value="<?= $pegawai_id ?>">
                                                    <div class="modal-body">
                                                        <div class="form-group mb-4">
                                                            <label for="urutan">Urutan</label>
                                                            <input type="number" class="form-control <?= (isset(session('errors')['urutan'])) ? 'is-invalid' : '' ?>" id="urutan" name="urutan" value="<?= old('urutan', $d->urutan) ?>">
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['urutan'])) : ?>
                                                                    <?= session('errors')['urutan'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="jafung_id">jafung</label>
                                                            <select name="jafung_id" id="jafung_id" class="form-control" required>
                                                                <option value="<?= $d->jafung_id ?>"><?= $d->jafung_nama ?></option>
                                                                <?php
                                                                foreach ($jafung as $value) :
                                                                ?>
                                                                    <option value="<?= $value->jafung_id ?>"><?= $value->jafung_nama ?></option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['jafung_id'])) : ?>
                                                                    <?= session('errors')['jafung_id'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="riwayatjafung_tmtjafung">Terhitung mulai tanggal</label>
                                                            <input type="date" class="form-control <?= (isset(session('errors')['riwayatjafung_tmtjafung'])) ? 'is-invalid' : '' ?>" id="riwayatjafung_tmtjafung" name="riwayatjafung_tmtjafung" value="<?= $d->riwayatjafung_tmtjafung ?>" required>
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['riwayatjafung_tmtjafung'])) : ?>
                                                                    <?= session('errors')['riwayatjafung_tmtjafung'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="riwayatjafung_filesk">File SK</label>
                                                            <div>
                                                                <!-- <p><?= $d->riwayatjafung_filesk ?></p> -->
                                                                <a href="<?= base_url('assets/file/' . $d->riwayatjafung_filesk) ?>" class="badge badge-info" target="_blank">Lihat file</a>
                                                            </div>
                                                            <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="riwayatjafung_filesk" name="riwayatjafung_filesk" value="<?= old('riwayatjafung_filesk') ?>">
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
                                    <div class="modal fade" id="deleteModal<?= $d->riwayatjafung_id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel">Hapus Data Dokumen?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('riwayat/deletejafung/' . $d->riwayatjafung_id); ?>" method="post">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                    <input type="hidden" name="riwayatjafung_id" value="<?= $d->riwayatjafung_id ?>" id="kodeitemhapus">
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
            <form action="<?= base_url($controller . '/insertjafung'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <input type="hidden" name="pegawai_id" id="pegawai_id" value="<?= $pegawai_id ?>">
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
                        <label for="jafung_id">Jafung</label>
                        <select name="jafung_id" id="jafung_id" class="form-control" required>
                            <option value="">- Pilih jafung -</option>
                            <?php
                            foreach ($jafung as $value) :
                            ?>
                                <option value="<?= $value->jafung_id ?>"><?= $value->jafung_nama ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['jafung_id'])) : ?>
                                <?= session('errors')['jafung_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatjafung_tmtjafung">Terhitung mulai tanggal</label>
                        <input type="date" class="form-control <?= (isset(session('errors')['riwayatjafung_tmtjafung'])) ? 'is-invalid' : '' ?>" id="riwayatjafung_tmtjafung" name="riwayatjafung_tmtjafung" value="<?= old('riwayatjafung_tmtjafung') ?>" required>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['riwayatjafung_tmtjafung'])) : ?>
                                <?= session('errors')['riwayatjafung_tmtjafung'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatjafung_filesk">File SK</label>
                        <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="riwayatjafung_filesk" name="riwayatjafung_filesk" value="<?= old('riwayatjafung_filesk') ?>" required>
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