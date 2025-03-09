<?php

use Fuel\Core\Input;

?>
<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Create Category</h2>
        <hr>
        <div class="content-page">
            <?= View::forge('admin/includes/title_notification') ?>
            <form method="post" class="w-50 p-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control <?= !empty($errors['name']) ? 'border-error' : '' ?>"
                           value="<?= Input::post('name', '') ?>"
                           name="name" id="name" placeholder="Name">
                    <?php if (!empty($errors['name'])): ?>
                        <p class="text-error"><?= $errors['name'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea type="text" class="form-control <?= !empty($errors['note']) ? 'border-error' : '' ?>"
                              name="note" id="note" placeholder="Note"><?= Input::post('note', '') ?></textarea>
                    <?php if (!empty($errors['note'])): ?>
                        <p class="text-error"><?= $errors['note'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-4">Create</button>
                </div>
            </form>
        </div>
    </div>
</section>