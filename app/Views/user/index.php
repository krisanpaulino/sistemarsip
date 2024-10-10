<?= $this->extend('layoutadmin') ?>

<?= $this->section('cssplugins'); ?>

<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Data User</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Daftar user aktif.
                    </small>
                </div>
                <div class="text-left m-b-lg">
                    <a href="<?= base_url(user()->user_tipe . '/user/signup') ?>" class="btn btn-outline btn-primary"><i class="fa fa-plus"></i></a>
                </div>
                <div class="table-responsive mt-2">
                    <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Tipe</th>
                                <th>Nama (Pegawai)</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($user as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row->username ?></td>
                                    <td><?= ($row->user_tipe == 'operator') ? 'pegawai' : $row->user_tipe ?></td>
                                    <td><?= $row->operator_nama ?></td>
                                    <td><?= $row->unit_nama ?></td>

                                    <td>
                                        <form action="<?= base_url('admin/user/delete') ?>" method="post">
                                            <input type="hidden" name="id" value="<?= $row->user_id ?>" class="d-none">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="badge bg-danger border">Nonaktifkan</button>
                                        </form>
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