<?= $this->extend('layoutadmin'); ?>
<?= $this->section('main'); ?>
<div class="row float-center">
    <div class="col-md-6 col-md-offset-3">
        <div class="widget">
            <header class="widget-header">
                <h4 class="widget-title">Form User</h4>
            </header><!-- .widget-header -->
            <hr class="widget-separator">
            <div class="widget-body">
                <div class="m-b-lg">
                    <small>
                        Input data user melalui form di bawah ini!
                    </small>
                </div>
                <form action="<?= base_url('admin/user/register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group mb-4">
                        <label for="user_tipe">Tipe User</label>
                        <select class="form-control <?= (isset(session('errors')['user_tipe'])) ? 'is-invalid' : '' ?>" id="user_tipe" name="user_tipe">
                            <option value="">Pilih Tipe User</option>
                            <option value="admin">Admin</option>
                            <option value="operator">Pegawai</option>
                        </select>
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['user_tipe'])) : ?>
                                <?= session('errors')['user_tipe'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="username">Username</label>
                        <input type="text" class="form-control <?= (isset(session('errors')['username'])) ? 'is-invalid' : '' ?>" id="username" name="username" value="<?= old('username') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['username'])) : ?>
                                <?= session('errors')['username'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="user_password">Password</label>
                        <input type="password" class="form-control <?= (isset(session('errors')['user_password'])) ? 'is-invalid' : '' ?>" id="user_password" name="user_password" value="<?= old('user_password') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['user_password'])) : ?>
                                <?= session('errors')['user_password'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control <?= (isset(session('errors')['password_confirmation'])) ? 'is-invalid' : '' ?>" id="password_confirmation" name="password_confirmation" value="<?= old('password_confirmation') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['password_confirmation'])) : ?>
                                <?= session('errors')['password_confirmation'] ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div id="op-form" class="form-group mb-4">

                    </div>
                    <button type="submit" class="btn btn-primary btn-md">Submit</button>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div><!-- .row -->
<?= $this->endSection(); ?>
<?= $this->section('scripts'); ?>
<script>
    $("#user_tipe").on('change', function() {
        var tipe = this.value
        console.log(tipe);
        if (tipe == 'operator') {

            $("<label>Nama Pegawai<label/>")
                .appendTo("#op-form");
            $("<input type='text' value='' />")
                // .attr("id", "")
                .attr("name", "operator_nama")
                .attr("class", "form-control")
                .attr("style", "margin-bottom: 20px")
                .appendTo("#op-form");
            $("<label>NIP Pegawai<label/>").appendTo("#op-form");
            $("<input type='text' value='' />")
                // .attr("id", "")
                .attr("name", "operator_nip")
                .attr("class", "form-control")
                .attr("style", "margin-bottom: 20px")
                .appendTo("#op-form");
            // $("<select class='form-control' name='unit_id' id='unit_id'></select>").appendTo("#op-form");
            var unit = jQuery.parseJSON('<?= json_encode($unit) ?>')
            $("<label>Pilih Unit<label/>")
                .attr("class", "mb-4")
                .appendTo("#op-form");
            $("<select></select>")
                .attr("id", "unit_id")
                .attr("name", "unit_id")
                .attr("class", "form-control mb-4")
                .appendTo("#op-form");

            $.each(unit, function(i, item) {
                $('#unit_id').append(new Option(item.unit_nama, item.unit_id));
            });
        } else {
            $('#op-form').empty();
        }
    });
</script>
<?= $this->endSection(); ?>