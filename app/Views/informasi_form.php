<?= $this->extend('layout' . user()->user_tipe); ?>

<?= $this->section('cssplugins'); ?>

<?= $this->endSection(); ?>

<?= $this->section('main'); ?>
<div class="row">

    <div class="col-md-12">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Form Informasi</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                </div>
                <form action="<?= base_url('admin/informasi/save') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="informasi_id" value="<?= $informasi->informasi_id ?>">
                    <div class="form-group mb-4">
                        <label for="informasi_judul">Judul/Topik</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['informasi_judul'])) ? 'is-invalid' : '' ?>" id="informasi_judul" name="informasi_judul" value="<?= old('informasi_judul', $informasi->informasi_judul) ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['informasi_judul'])) : ?>
                                <?= session('errors')['informasi_judul'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['informasi_isi'])) : ?>
                                <?= session('errors')['informasi_isi'] ?>
                            <?php endif; ?>
                        </div>
                        <textarea name="informasi_isi" class="m-0" data-plugin="summernote" data-options="{height: 250,  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['font', ['strikethrough', 'superscript', 'subscript']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]}"><?= $informasi->informasi_isi ?></textarea>

                    </div>
                    <div class="form-group">
                        <div class="form-group mb-4">
                            <label for="file">Dokumen/File</label>
                            <input type="file" class="form-control <?= (isset(session('errors')['file'])) ? 'is-invalid' : '' ?>" id="file" name="file" value="<?= old('file') ?>">
                            <div class="invalid-feedback">
                                <?php if (isset(session('errors')['file'])) : ?>
                                    <?= session('errors')['file'] ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                    </div>
                    <!-- .widget-body -->
            </div>

            </form>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div>
</div><!-- .row -->

<?= $this->endSection(); ?>