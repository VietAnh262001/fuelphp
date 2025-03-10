<?php use Fuel\Core\Session;

if (Session::get_flash('success')): ?>
    <div class="alert alert-success alert-dismissible fs-25" role="alert">
        <?= Session::get_flash('success') ?>
        <button type="button" class="mt-1 btn-close" id="btn-close-alert" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (Session::get_flash('error')): ?>
    <div class="alert alert-danger alert-dismissible fs-25" role="alert">
        <?= Session::get_flash('error') ?>
        <button type="button" class="mt-1 btn-close" id="btn-close-alert" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
