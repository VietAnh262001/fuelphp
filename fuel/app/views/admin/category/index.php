<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Categories</h2>
        <hr>
        <form class="bg-gray" method="get">
            <div class="row g-3 align-items-end">
                <div class="col-md-3 col-12">
                    <label for="search-name" class="mb-1">Name</label>
                    <input class="form-control border-radius-none" type="text" name="search_name" value="<?= @$search_name ?>" id="search-name">
                </div>

                <div class="col-md-1 col-12 text-center">
                    <button class="btn btn-primary w-100" type="submit">検索</button>
                </div>
            </div>
        </form>
        <div class="content-page">
            <h2>Danh sách Categories</h2>
            <a class="btn btn-secondary" href="<?= Uri::create('admin/category/create') ?>">Create</a>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Note</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?= $category->id ?></td>
                        <td><?= $category->name ?></td>
                        <td><?= $category->note ?></td>
                        <td>
                            <a class="btn btn-primary" href="<?= Uri::create('admin/category/edit/' . $category->id) ?>">Edit</a>
                            <a class="btn btn-danger btn-delete" data-url="<?= Uri::create('admin/category/delete/' . $category->id) ?>" href="#">Delete</a>
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
    <?= View::forge('admin/includes/modal_confirm', ['modalId' => 'modal-delete-category']); ?>
</section>