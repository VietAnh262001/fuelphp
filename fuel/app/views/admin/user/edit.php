<?php

use Fuel\Core\Input;

?>
<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Edit User</h2>
        <hr>
        <div class="content-page">
            <?= View::forge('admin/includes/title_notification') ?>
            <form method="post" class="w-50 p-3">
                <div class="mb-3">
                    <label for="name" class="form-label">User Name</label>
                    <input type="text" disabled value="<?= $user->username ?>" class="form-control" id="name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" disabled value="<?= $user->email ?>" class="form-control" id="email">
                </div>
                <div class="mb-3">
                    <label for="group" class="form-label">Status</label>
                    <select class="form-control" name="group" id="group">
                        <?php foreach (Model_Admin_User::get_groups() as $key => $value): ?>
                            <option value="<?= $key ?>" <?= $user->group == $key ? 'selected' : '' ?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-4 mr-4">Edit</button>
                    <a href="<?= Uri::create('admin/user/reset_password/' . $user->id) ?>" type="button" class="btn btn-secondary px-4">Reset password</a>
                </div>
            </form>
        </div>
    </div>
</section>