<?= $this->extend('layout'); ?>

<?= $this->section('main'); ?>
<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Data Arsip</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <div class="text-right m-b-lg">
                        <a href="<?= base_url(user()->user_tipe . '/arsip/tambah') ?>" class="btn btn-outline btn-primary"><i class="fa fa-plus"></i></a>
                    </div>
                    <!-- <small>
                        Data Arsip
                    </small> -->

                    <div class="table-responsive mt-2">
                        <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nomor</th>
                                    <th>Tanggal Arsip</th>
                                    <th>Jenis Arsip</th>
                                    <?php if (user()->user_tipe == 'admin') ?>
                                    <th>Unit</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($arsip as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row->arsip_nomor ?></td>
                                        <td><?= $row->arsip_tanggal ?></td>
                                        <td><?= $row->jenis_nama ?></td>
                                        <?php if (user()->user_tipe == 'admin') ?>
                                        <td><?= $row->unit_nama ?></td>

                                        <td>
                                            <button href="#" data-toggle="modal" data-target="#hapus" data-id="<?= $row->arsip_id ?>" class="btn btn-danger btn-xs">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div><!-- .row -->

<div class="modal fade in" id="hapus" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/arsip/deletearsip') ?>" method="post">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="kodeitem" class="d-flex d-none">
                    <h5>Anda yakin ingin menghapus data arsip?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    $('#hapus').on('show.bs.modal', function(event) {
        console.log('Here');
        var kode = $(event.relatedTarget).data('id');
        var nama = $(event.relatedTarget).data('nama');
        $(this).find('#kodeitem').attr("value", kode);
        // $(this).find('#namaitem').attr("value", nama);
    });
</script>
<?= $this->endSection(); ?>