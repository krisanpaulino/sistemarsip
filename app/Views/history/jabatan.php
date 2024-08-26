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
                                    <th scope="col">Jabatan</th>
                                    <th scope="col">Unit kerja</th>
                                    <th scope="col">Dari</th>
                                    <th scope="col">Hingga</th>
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
                                            <?= $d->jabatan_nama; ?>
                                            <?php
                                            if ($d->aktif == 'Y') {
                                            ?>
                                                <a href="javascript:;" class="badge bg-success text-light">Aktif</a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $d->unitkerja_nama; ?></td>
                                        <td><?= $d->riwayatjabatan_tmtawal; ?></td>
                                        <td><?= $d->riwayatjabatan_tmtakhir; ?></td>
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
                                                <a href="javascript:;" class="badge bg-primary text-light" data-toggle="modal" data-target="#editModal<?= $d->riwayatjabatan_id ?>" data-id="<?= $d->riwayatjabatan_id ?>">Edit</a>
                                            <?php endif ?>

                                            <a href="<?= base_url('assets/file/' . $d->riwayatjabatan_filesk) ?>" class="badge badge-info" style="width:50px" target="_blank">File</a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editModal<?= $d->riwayatjabatan_id ?>" tabindex="-1" role="dialog" aria-labelledby="editNamaModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel">Edit Dokumen</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url($controller . '/updatejabatan/' . $d->riwayatjabatan_id); ?>" method="post" enctype="multipart/form-data">
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
                                                            <label for="jabatan_id">Jabatan</label>
                                                            <select name="jabatan_id" id="jabatan_id" class="form-control" required>
                                                                <option value="<?= $d->jabatan_id ?>"><?= $d->jabatan_nama ?></option>
                                                                <?php
                                                                foreach ($jabatan as $value) :
                                                                ?>
                                                                    <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['jabatan_id'])) : ?>
                                                                    <?= session('errors')['jabatan_id'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="unitkerja_id">Unit kerja</label>
                                                            <select name="unitkerja_id" id="unitkerja_id" class="form-control" required>
                                                                <option value="<?= $d->unitkerja_id ?>"><?= $d->unitkerja_nama ?></option>
                                                                <?php
                                                                foreach ($unitkerja as $value) :
                                                                ?>
                                                                    <option value="<?= $value->unitkerja_id ?>"><?= $value->unitkerja_nama ?></option>
                                                                <?php
                                                                endforeach;
                                                                ?>
                                                            </select>
                                                            <div class="invalid-feedback">
                                                                <?php if (isset(session('errors')['unitkerja_id'])) : ?>
                                                                    <?= session('errors')['unitkerja_id'] ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <label for="riwayatjabatan_tmtawal">Terhitung mulai tanggal</label>
                                                                    <input type="date" class="form-control <?= (isset(session('errors')['riwayatjabatan_tmtawal'])) ? 'is-invalid' : '' ?>" id="riwayatjabatan_tmtawal" name="riwayatjabatan_tmtawal" value="<?= $d->riwayatjabatan_tmtawal ?>" required>
                                                                    <div class="invalid-feedback">
                                                                        <?php if (isset(session('errors')['riwayatjabatan_tmtawal'])) : ?>
                                                                            <?= session('errors')['riwayatjabatan_tmtawal'] ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <label for="riwayatjabatan_tmtakhir">Hingga tanggal</label>
                                                                    <input type="date" class="form-control <?= (isset(session('errors')['riwayatjabatan_tmtakhir'])) ? 'is-invalid' : '' ?>" id="riwayatjabatan_tmtakhir" name="riwayatjabatan_tmtakhir" value="<?= $d->riwayatjabatan_tmtakhir ?>" required>
                                                                    <div class="invalid-feedback">
                                                                        <?php if (isset(session('errors')['riwayatjabatan_tmtakhir'])) : ?>
                                                                            <?= session('errors')['riwayatjabatan_tmtakhir'] ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-4">
                                                            <label for="riwayatjabatan_filesk">File SK</label>
                                                            <div>
                                                                <a href="<?= base_url('assets/file/' . $d->riwayatjabatan_filesk) ?>" class="badge badge-info" target="_blank">Lihat file</a>
                                                            </div>
                                                            <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="riwayatjabatan_filesk" name="riwayatjabatan_filesk" value="<?= old('riwayatjabatan_filesk') ?>">
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
                                    <div class="modal fade" id="deleteModal<?= $d->riwayatjabatan_id ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteUserModalLabel">Hapus Data Dokumen?</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url($controller . '/deletejabatan/' . $d->riwayatjabatan_id); ?>" method="post">
                                                    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                                                    <input type="hidden" name="riwayatjabatan_id" value="<?= $d->riwayatjabatan_id ?>" id="kodeitemhapus">
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
            <form action="<?= base_url($controller . '/insertjabatan'); ?>" method="post" enctype="multipart/form-data">
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
                        <label for="jabatan_id">Jabatan</label>
                        <select name="jabatan_id" id="jabatan_id" class="form-control" required>
                            <option value="">- Pilih jabatan -</option>
                            <?php
                            foreach ($jabatan as $value) :
                            ?>
                                <option value="<?= $value->jabatan_id ?>"><?= $value->jabatan_nama ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['jabatan_id'])) : ?>
                                <?= session('errors')['jabatan_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="unitkerja_id">Unit kerja</label>
                        <select name="unitkerja_id" id="unitkerja_id" class="form-control" required>
                            <option value="">- Pilih unit kerja -</option>
                            <?php
                            foreach ($unitkerja as $value) :
                            ?>
                                <option value="<?= $value->unitkerja_id ?>"><?= $value->unitkerja_nama ?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['unitkerja_id'])) : ?>
                                <?= session('errors')['unitkerja_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="riwayatjabatan_tmtawal">Terhitung mulai tanggal</label>
                                <input type="date" class="form-control <?= (isset(session('errors')['riwayatjabatan_tmtawal'])) ? 'is-invalid' : '' ?>" id="riwayatjabatan_tmtawal" name="riwayatjabatan_tmtawal" required>
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['riwayatjabatan_tmtawal'])) : ?>
                                        <?= session('errors')['riwayatjabatan_tmtawal'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label for="riwayatjabatan_tmtakhir">Hingga tanggal</label>
                                <input type="date" class="form-control <?= (isset(session('errors')['riwayatjabatan_tmtakhir'])) ? 'is-invalid' : '' ?>" id="riwayatjabatan_tmtakhir" name="riwayatjabatan_tmtakhir" required>
                                <div class="invalid-feedback">
                                    <?php if (isset(session('errors')['riwayatjabatan_tmtakhir'])) : ?>
                                        <?= session('errors')['riwayatjabatan_tmtakhir'] ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="riwayatjabatan_filesk">File SK</label>
                        <input type="file" class="form-control <?= (session()->has('error') == true) ? 'is-invalid' : '' ?>" id="riwayatjabatan_filesk" name="riwayatjabatan_filesk" value="<?= old('riwayatjabatan_filesk') ?>" required>
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