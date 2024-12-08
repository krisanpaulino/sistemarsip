<?= $this->extend('layoutfront'); ?>
<?= $this->section('content'); ?>
<div class="row text-center mb-4">
    <h1>Selamat Datang di Website Informasi BKD Kabupaten Sikka!</h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
</div>
<div class="row aligned-row">
    <div class="col-md-6 col-sm-6 widget p-md">
        <div class="">
            <h5>Visi</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. .</p>
        </div>
    </div>
    <!-- <div class="clearfix visible-lg"></div> -->
    <div class="col-md-6 col-sm-6">
        <div class="widget p-md">
            <h5>Misi</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. .</p>
            <p>Mauris massa facilisi nec odio ultricies sodales rutrum. Vel cras at convallis congue fames lacus gravida bibendum. Torquent sit torquent taciti mi purus tortor eleifend torquent. Euismod cubilia elementum tellus nostra efficitur duis. Facilisi metus eu imperdiet nulla magnis rutrum class primis. Suspendisse nibh aptent libero natoque magna primis. Imperdiet fusce suspendisse efficitur metus sodales habitasse.</p>
        </div>
    </div>
</div>
<div class="row">
    <h2>INFORMASI</h2>

    <?php foreach ($informasi as $row) : ?>
        <div class="col-12">
            <div class="widget p-md">
                <h4><?= $row->informasi_judul ?></h4>
                <small>
                    <?= $row->informasi_waktu ?>
                </small>
                <p><?= $row->informasi_isi ?></p>
                <?php if ($row->informasi_dokumen != null) : ?>
                    <hr>
                    <a href="<?= base_url('assets/files/' . $row->informasi_dokumen) ?>">Download file</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach ?>
    <?= $pager->links() ?>
</div>
<?= $this->endSection(); ?>