<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Edit Product</h2>
        <hr>
        <div class="content-page">
            <?= View::forge('admin/includes/title_notification') ?>
            <form method="post" enctype="multipart/form-data" class="w-50 p-3">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" value="<?= Input::post('name', $product->name) ?>" class="form-control <?= !empty($errors['name']) ? 'border-error' : '' ?>" name="name" id="name" placeholder="Name">
                    <?php if (!empty($errors['name'])): ?>
                        <p class="text-error"><?= $errors['name'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control <?= !empty($errors['category_id']) ? 'border-error' : '' ?>" name="category_id" id="category">
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $category): ?>
                            <option <?= $category->id == Input::post('category_id', $product->category_id) ? 'selected' : '' ?> value="<?= $category->id ?>"><?= $category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php if (!empty($errors['category_id'])): ?>
                        <p class="text-error"><?= $errors['category_id'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="text" value="<?= Input::post('price', $product->price) ?>" class="form-control <?= !empty($errors['price']) ? 'border-error' : '' ?>" name="price" id="price" placeholder="Price">
                    <?php if (!empty($errors['price'])): ?>
                        <p class="text-error"><?= $errors['price'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <div id="preview-image" <?= !empty($product->image) ? '' : 'style="display: none;"' ?>>
                        <img src="/uploads/<?= $product->image ?>" alt="Preview Image" width="200" height="200" class="mb-3">
                    </div>
                    <button class="btn btn-secondary btn-image">Change image</button>
                    <input type="file" class="form-control image" accept="image/jpeg,image/png" hidden name="image">
                    <?php if (!empty($errors['image'])): ?>
                        <p class="text-error"><?= $errors['image'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option value="1" <?= Input::post('status', $product->status ?? 1) == 1 ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= Input::post('status', $product->status ?? 1) == 0 ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea type="text" class="form-control <?= !empty($errors['note']) ? 'border-error' : '' ?>" name="note" id="note" placeholder="Note"><?= Input::post('note', $product->note) ?></textarea>
                    <?php if (!empty($errors['note'])): ?>
                        <p class="text-error"><?= $errors['note'] ?></p>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary px-4">Update</button>
                </div>
            </form>
        </div>
    </div>
</section>
