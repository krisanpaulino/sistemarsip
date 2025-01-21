<?= $this->extend('layout' . user()->user_tipe); ?>
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
                        Ganti password pada form di bawah ini!
                    </small>
                </div>
                <form action="<?= base_url('ganti-password') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-group mb-4">
                        <label for="user_password">Password Sekarang</label>
                        <input type="password" class="form-control <?= (isset(session('errors')['current_password'])) ? 'is-invalid' : '' ?>" id="current_password" name="current_password" value="<?= old('current_password') ?>">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['current_password'])) : ?>
                                <?= session('errors')['current_password'] ?>
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
                        <input type="password" class="form-control <?= (isset(session('errors')['password_confirmation'])) ? 'is-invalid' : '' ?>" id="password_confirmation" name="password_confirmation">
                        <div class="invalid-feedback">
                            <?php if (isset(session('errors')['password_confirmation'])) : ?>
                                <?= session('errors')['password_confirmation'] ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md">Ganti Password</button>
                </form>
            </div>
        </div><!-- .widget-body -->
    </div><!-- .widget -->
</div><!-- END column -->
</div><!-- .row -->
<?= $this->endSection(); ?>