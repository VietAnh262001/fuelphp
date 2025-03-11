<?php

use Fuel\Core\Input;

?>
<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Change password</h2>
        <hr>
        <div class="content-page">
            <?= View::forge('admin/includes/title_notification') ?>
            <form method="post" class="w-50 p-3">
                <div class="mb-3">
                    <label for="old-password" class="form-label">Old password</label>
                    <input type="password" class="form-control <?= !empty($errors['old_password']) ? 'border-error' : '' ?>"
                           value=""
                           name="old_password" id="old-password" placeholder="Old password">
                    <?php if (!empty($errors['old_password'])): ?>
                        <p class="text-error"><?= $errors['old_password'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="new-password" class="form-label">New password</label>
                    <input type="password" class="form-control <?= !empty($errors['new_password']) ? 'border-error' : '' ?>"
                           value=""
                           name="new_password" id="new-password" placeholder="New password">
                    <?php if (!empty($errors['new_password'])): ?>
                        <p class="text-error"><?= $errors['new_password'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="confirm-password" class="form-label">Confirm password</label>
                    <input type="password" class="form-control <?= !empty($errors['confirm_password']) ? 'border-error' : '' ?>"
                           value=""
                           name="confirm_password" id="confirm-password" placeholder="Confirm password">
                    <?php if (!empty($errors['confirm_password'])): ?>
                        <p class="text-error"><?= $errors['confirm_password'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-4">Change</button>
                </div>
            </form>
        </div>
    </div>
</section>