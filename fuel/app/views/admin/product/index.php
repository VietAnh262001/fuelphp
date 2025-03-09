<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Products</h2>
        <hr>
        <div class="content-page">
            <?= View::forge('admin/includes/title_notification') ?>
            <form class="bg-gray" method="get">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="<?= $search['name'] ?? '' ?>" placeholder="Enter product name">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Category</label>
                        <select name="category_id" class="form-control">
                            <option value="">-- Select Category --</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category->id ?>" <?= ($search['category_id'] ?? '') == $category->id ? 'selected' : '' ?>><?= $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="">-- All --</option>
                            <option value="1" <?= ($search['status'] ?? '') === '1' ? 'selected' : '' ?>>Active</option>
                            <option value="0" <?= ($search['status'] ?? '') === '0' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Price Min</label>
                        <input type="number" name="price_min" class="form-control" value="<?= $search['price_min'] ?? '' ?>" placeholder="Min price">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Price Max</label>
                        <input type="number" name="price_max" class="form-control" value="<?= $search['price_max'] ?? '' ?>" placeholder="Max price">
                    </div>
                </div>

                <div class="d-flex justify-content-end p-3">
                    <button type="submit" class="btn btn-primary me-2">Search</button>
                    <a href="/admin/product/index" class="btn btn-secondary">Reset</a>
                </div>
            </form>
            <h2>Danh sách Products</h2>
            <a class="btn btn-secondary" href="<?= Uri::create('admin/product/create') ?>">Create</a>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= $product->id ?></td>
                        <td><?= $product->name ?></td>
                        <td><?= $product->category->name ?></td>
                        <td>
                            <?php if (!empty($product->image)): ?>
                                <img src="/uploads/<?= $product->image ?>" width="80" height="80" alt="">
                            <?php endif; ?>
                        </td>
                        <td><?= number_format($product->price, 2) ?></td>
                        <td><?= $product->status
                                ? '<span class="text-success">Active</span>'
                                : '<span class="text-danger">Inactive</span>' ?>
                        </td>
                        <td><?= $product->note ?></td>
                        <td>
                            <a class="btn btn-primary" href="<?= Uri::create('admin/product/edit/' . $product->id) ?>">Edit</a>
                            <a class="btn btn-danger btn-delete" data-url="<?= Uri::create('admin/product/delete/' . $product->id) ?>" href="#">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?= View::forge('admin/includes/pagination', [
                'total' => $total,
                'first_item' => $first_item,
                'last_item' => $last_item,
                'pagination' => $pagination,
            ]); ?>
        </div>
    </div>
    <?= View::forge('admin/includes/modal_confirm', ['id' => 'modal-delete-product']); ?>
</section>