<?= $this->extend('layout' . user()->user_tipe); ?>

<?= $this->section('main'); ?>
<div class="row">

    <div class="col-md-4">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Form Jenis</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Input data Jenis Arsip melalui form di bawah ini!
                    </small>
                </div>
                <form action="<?= base_url('admin/master/savejenis') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group mb-4">
                        <label for="jenis_nama">Nama jenis</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['jenis_nama'])) ? 'is-invalid' : '' ?>" id="jenis_nama" name="jenis_nama" value="<?= old('jenis_nama') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['jenis_nama'])) : ?>
                                <?= session('errors')['jenis_nama'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
    <div class="col-md-8">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Data Unit</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Data Jenis Arsip.
                    </small>
                    <div class="table-responsive">
                        <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Nama Jenis Arsip</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($jenis as $row) : ?>
                                    <tr>
                                        <td><?= $row->jenis_nama ?></td>
                                        <td>
                                            <button href="#" data-toggle="modal" data-target="#hapus" data-id="<?= $row->jenis_id ?>" class="btn btn-danger btn-xs">Hapus</button>
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
            <form action="<?= base_url('admin/master/deletejenis') ?>" method="post">
                <div class="modal-body">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" id="kodeitem" class="d-flex d-none">
                    <h5>Anda yakin ingin menghapus data jenis arsip?</h5>
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