<?= $this->extend('layout' . user()->user_tipe); ?>

<?= $this->section('cssplugins'); ?>

<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Form Pinjam</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Izin arsip melalui form di bawah ini!
                    </small>
                </div>
                <div class="table-responsive mt-2">
                    <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nomor Arsip</th>
                                <th>Jenis Arsip</th>
                                <th>Perihal Arsip</th>
                                <th>Tanggal Arsip</th>
                                <th>Unit Asal Arsip</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($arsip as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row->arsip_nomor ?></td>
                                    <td><?= $row->jenis_nama ?></td>
                                    <td><?= $row->arsip_perihal ?></td>
                                    <td><?= $row->arsip_tanggalarsip ?></td>
                                    <td><?= $row->unit_nama ?></td>

                                    <td>
                                        <button type="button" data-toggle="modal" data-target="#pinjam<?= $row->arsip_id ?>" class="btn btn-warning btn-xs">Minta akses</button>
                                        <div class="modal fade in" id="pinjam<?= $row->arsip_id ?>" tabindex="-1" role="dialog">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Keterangan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="<?= base_url(user()->user_tipe . '/pinjam') ?>" method="post">
                                                        <div class="modal-body">
                                                            <?= csrf_field() ?>
                                                            <input type="hidden" name="id" value="<?= $row->arsip_id ?>" class="d-flex d-none">
                                                            <div class="form-group mb-4">
                                                                <label for="keterangan">Keterangan</label>
                                                                <input type="text" class="form-control d-block <?= (isset(session('errors')['keterangan'])) ? 'is-invalid' : '' ?>" id="keterangan" name="keterangan" value="<?= old('keterangan') ?>">
                                                                <div class="invalid-feedback">
                                                                    <?php if (isset(session('errors')['keterangan'])) : ?>
                                                                        <?= session('errors')['keterangan'] ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-primary">Minta Izin Akses</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <button type="submit" class="btn btn-primary btn-md">Simpan</button>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div><!-- .row -->

<?= $this->endSection(); ?>