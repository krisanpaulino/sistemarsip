<?= $this->extend('layout' . user()->user_tipe); ?>

<?= $this->section('main'); ?>
<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title"><?= $title ?></h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg row">
                    <!-- <small>
                        Data Arsip
                    </small> -->
                    <div class="m-b-lg col-md-6 row">
                        <form action="<?= base_url(user()->user_tipe . '/laporan/bulanan') ?>" class="col-md-6" method="post">
                            <?= csrf_field() ?>
                            <div class="form-group">
                                <label for="datetimepicker4">Pilih Tahun dan Bulan </label>
                                <div class='input-group date' id='datetimepicker4' data-plugin="datetimepicker" data-options="{viewMode: 'years', format: 'YYYY-MM', defaultDate: '<?= $tanggal ?>'}">
                                    <input type='text' name='tanggal' class="form-control" />
                                    <span class="input-group-addon bg-info text-white">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-outline btn-primary"><i class="fa fa-search"></i> Filter</button>
                        </form>

                    </div>
                    <div class="col-md-12">
                        <div class="table-responsive mt-2">
                            <table id="default-datatable" data-plugin="DataTable" class="table table-striped" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nomor</th>
                                        <th>Perihal</th>
                                        <th>Jenis Arsip</th>
                                        <th>Tanggal Arsip</th>
                                        <th>Tanggal Upload</th>
                                        <?php if (user()->user_tipe == 'admin') ?>
                                        <th>Unit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1;
                                    foreach ($laporan as $row) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $row->arsip_nomor ?></td>
                                            <td><?= $row->arsip_perihal ?></td>
                                            <td><?= $row->jenis_nama ?></td>
                                            <td><?= $row->arsip_tanggalarsip ?></td>
                                            <td><?= $row->arsip_tanggalrekam ?></td>
                                            <?php if (user()->user_tipe == 'admin') ?>
                                            <td><?= $row->unit_nama ?></td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <form action="<?= base_url(user()->user_tipe . '/laporan/cetakbulanan') ?>" class="col-md-6" method="post">
                        <input type="hidden" name="tanggal" value="<?= $tanggal ?>" class="d-none">
                        <button type="submit" class="btn btn-outline btn-success"><i class="fa fa-print"></i> Cetak</button>
                    </form>
                </div>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div><!-- .row -->


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