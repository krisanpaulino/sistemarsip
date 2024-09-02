<?= $this->extend('layout'); ?>

<?= $this->section('cssplugins'); ?>

<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Form Jenis</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Input data Arsip melalui form di bawah ini!
                    </small>
                </div>
                <form action="<?= base_url(user()->user_tipe . '/arsip/save') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="id" value="<?= $arsip->arsip_id ?>" class="d-flex d-none">
                    <div class="form-group mb-4">
                        <label for="jenis_id">Jenis Arsip</label>
                        <select type="text" class="form-control <?= (isset(session('errors')['jenis_id'])) ? 'is-invalid' : '' ?>" id="jenis_id" name="jenis_id" data-plugin="select2" ata-options="{ placeholder: 'Pilih jenis arsip', allowClear: true }">
                            <?php foreach ($jenis as $row) : ?>
                                <option value="<?= $row->jenis_id ?>" <?= (old('jenis_id', $arsip->jenis_id) == $row->jenis_id) ? 'selected' : '' ?>><?= $row->jenis_nama ?></option>
                            <?php endforeach ?>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['jenis_id'])) : ?>
                                <?= session('errors')['jenis_id'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php if (user()->user_tipe == 'admin') : ?>
                        <div class="form-group mb-4">
                            <label for="unit_id">Unit</label> <br>
                            <select type="text" class="form-control <?= (isset(session('errors')['unit_id'])) ? 'is-invalid' : '' ?>" id="unit_id" name="unit_id" data-plugin="select2" ata-options="{ placeholder: 'Pilih unit', allowClear: true }">
                                <?php foreach ($unit as $row) : ?>
                                    <option value="<?= $row->unit_id ?>" <?= (old('unit_id', $arsip->unit_id) == $row->unit_id) ? 'selected' : '' ?>><?= $row->unit_nama ?></option>
                                <?php endforeach ?>
                            </select>
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['unit_id'])) : ?>
                                    <?= session('errors')['unit_id'] ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="form-group mb-4">
                        <label for="arsip_nomor">Nomor Arsip</label> <br>
                        <input type="text" class="form-control <?= (isset(session('errors')['arsip_nomor'])) ? 'is-invalid' : '' ?>" id="arsip_nomor" name="arsip_nomor" value="<?= old('arsip_nomor', $arsip->arsip_nomor) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['arsip_nomor'])) : ?>
                                <?= session('errors')['arsip_nomor'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="arsip_tanggalarsip">Tanggal Arsip</label>
                        <div class='input-group date' id='datetimepicker4' data-plugin="datetimepicker" data-options="{ viewMode: 'years', format: 'YYYY-MM-DD' }">
                            <input type="text" class="form-control <?= (isset(session('errors')['arsip_tanggalarsip'])) ? 'is-invalid' : '' ?>" id="arsip_tanggalarsip" name="arsip_tanggalarsip" value="<?= old('arsip_tanggalarsip', $arsip->tanggal_arsip) ?>">
                            <span class="input-group-addon bg-info text-white">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['arsip_tanggalarsip'])) : ?>
                                <?= session('errors')['arsip_tanggalarsip'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="file">File</label>
                        <input type="file" class="form-control <?= (isset(session('errors')['file'])) ? 'is-invalid' : '' ?>" id="file" name="file">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['file'])) : ?>
                                <?= session('errors')['file'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div>
</div><!-- .row -->

<?= $this->endSection(); ?>