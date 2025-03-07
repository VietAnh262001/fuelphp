<?php

use Fuel\Core\Input;

?>
<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Edit Category</h2>
        <hr>
        <div class="content-page">
            <form method="post" class="w-50 p-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="<?= Input::post('name', $category->name) ?>"
                           class="form-control <?= !empty($errors['name']) ? 'border-error' : '' ?>" name="name" id="name" placeholder="Name">
                    <?php if (!empty($errors['name'])): ?>
                        <p class="text-error"><?= $errors['name'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea type="text" class="form-control <?= !empty($errors['note']) ? 'border-error' : '' ?>" name="note" id="note" placeholder="Note"><?= Input::post('note', $category->note) ?></textarea>
                    <?php if (!empty($errors['note'])): ?>
                        <p class="text-error"><?= $errors['note'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-4">Edit</button>
                </div>
            </form>
        </div>
    </div>
</section>