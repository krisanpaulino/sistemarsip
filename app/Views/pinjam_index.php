<?= $this->extend('layout' . user()->user_tipe); ?>

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
                    <?php if (user()->user_tipe == 'operator') : ?>
                        <div class="text-right m-b-lg">
                            <a href="<?= base_url(user()->user_tipe . '/pinjam/pinjam') ?>" class="btn btn-outline btn-primary"><i class="fa fa-plus"></i> Pinjam Arsip</a>
                        </div>
                    <?php endif; ?>
                    <!-- <small>
                        Data Arsip
                    </small> -->

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
                                    <?php if (user()->user_tipe == 'admin') ?>
                                    <th>Unit Peminjam</th>
                                    <th>Pinjam Sampai</th>
                                    <th>Action/Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($pinjam as $row) : ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><?= $row->arsip_nomor ?></td>
                                        <td><?= $row->jenis_nama ?></td>
                                        <td><?= $row->arsip_perihal ?></td>
                                        <td><?= $row->arsip_tanggalarsip ?></td>
                                        <td><?= $row->unit_asal ?></td>
                                        <?php if (user()->user_tipe == 'admin') ?>
                                        <td><?= $row->unit_nama ?></td>
                                        <td><?= $row->pinjam_sampai ?></td>

                                        <td>
                                            <?php if ($row->pinjam_approved != '1') : ?>
                                                <?php if ($row->pinjam_approved == 'unchecked'):  ?>
                                                    Sedang dikonfirmasi admin.
                                                <?php else : ?>
                                                    Ditolak.
                                                <?php endif; ?>

                                            <?php else : ?>
                                                <?php if (user()->user_tipe == 'operator' && strtotime($row->pinjam_sampai >= strtotime(date('Y-m-d'))) && $row->pinjam_approved == 1) : ?>
                                                    <form action="<?= base_url(user()->user_tipe . '/arsip/download') ?>" method="post">
                                                        <?= csrf_field() ?>
                                                        <input type="hidden" name="id" value="<?= $row->arsip_id ?>" class="d-flex d-none">
                                                        <button type="submit" class="btn btn-primary btn-xs">Download</button>
                                                    </form>
                                                <?php elseif ($row->pinjam_approved == 1) : ?>
                                                    Lewat batas pinjam.
                                                <?php elseif ($row->pinjam_approved == 0) : ?>
                                                    Ditolak
                                                <?php elseif ($row->pinjam_approved == 'checked') : ?>
                                                    Sedang diperiksa admin.
                                                <?php endif ?>

                                            <?php endif; ?>
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