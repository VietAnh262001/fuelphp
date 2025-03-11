<?php

use Fuel\Core\Uri;

?>

<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Dashboard</h2>
        <hr>
        <div style="margin-left: 277px">
            <?= View::forge('admin/includes/title_notification') ?>
        </div>
        <h3 class="title mb-3">Welcome <?= $username ?></h3>
        <a class="btn btn-secondary" href="<?= Uri::create('admin/user/change_password') ?>">Change password</a>
        <a class="btn btn-danger" href="<?= Uri::create('admin/auth/logout') ?>">Logout</a>
    </div>
</section>