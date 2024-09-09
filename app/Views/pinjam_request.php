<?= $this->extend('layout' . user()->user_tipe); ?>

<?= $this->section('cssplugins'); ?>

<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Permintaan Pinjam Arsip</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Terima atau tolak permintaan arsip.
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
                                <th>Unit Peminjam</th>
                                <th>Keterangan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($pinjam as $row) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $row->arsip_nomor ?></td>
                                    <td><?= $row->jenis_nama ?></td>
                                    <td><?= $row->arsip_tanggalarsip ?></td>
                                    <td><?= $row->arsip_perihal ?></td>
                                    <td><?= $row->unit_nama ?></td>
                                    <td><?= $row->unit_pinjam ?></td>
                                    <td><?= $row->pinjam_keterangan ?></td>

                                    <td>
                                        <button data-toggle="modal" data-id="<?= $row->pinjam_id ?>" data-target="#approve" data-name="approve" type="button" class="btn btn-warning btn-xs">Terima</button>
                                        <button data-toggle="modal" data-id="<?= $row->pinjam_id ?>" data-target="#tolak" data-name="tolak" class="btn btn-danger btn-xs">Tolak</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div><!-- .row -->
<div class="modal fade in" id="approve" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/pinjam/respon') ?>" method="post">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="kodeitem" class="d-flex d-none">
                    <input type="hidden" name="action" id="namaitem" class="d-flex d-none">
                    <h5>Masukkan tanggal batas akses</h5>
                    <input type="date" class="form-control" name="pinjam_tanggalsampai">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Terima</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade in" id="tolak" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tolak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/pinjam/respon') ?>" method="post">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="kodeitemtolak" class="d-flex d-none">
                    <input type="hidden" name="action" id="namaitemtolak" class="d-flex d-none">
                    <h5>Yakin tolak permintaan arsip?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    $('#approve').on('show.bs.modal', function(event) {
        var kode = $(event.relatedTarget).data('id');
        var nama = $(event.relatedTarget).data('name');
        $(this).find('#kodeitem').attr("value", kode);
        $(this).find('#namaitem').attr("value", nama);
    });
    $('#tolak').on('show.bs.modal', function(event) {
        var kode = $(event.relatedTarget).data('id');
        var nama = $(event.relatedTarget).data('name');
        $(this).find('#kodeitemtolak').attr("value", kode);
        $(this).find('#namaitemtolak').attr("value", nama);
    });
</script>
<?= $this->endSection(); ?>