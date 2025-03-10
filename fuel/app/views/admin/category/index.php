<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Categories</h2>
        <hr>
        <div class="content-page">
            <?= View::forge('admin/includes/title_notification') ?>
            <form class="bg-gray" method="get" action="<?= Uri::create('admin/category/index/') ?>">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3 col-12">
                        <label for="search-name" class="mb-1">Name</label>
                        <input class="form-control border-radius-none" type="text" name="name" value="<?= $search['name'] ?? '' ?>" id="search-name">
                    </div>
                    <div class="col-md-1 col-12 text-center d-flex">
                        <button class="btn btn-primary mr-4 px-3" type="submit">Search</button>
                        <a href="/admin/category/index" class="btn btn-secondary px-3">Reset</a>
                    </div>
                </div>
            </form>
            <h2>List Categories</h2>
            <div class="d-flex justify-content-end mb-3">
                <a class="btn btn-success px-4" href="<?= Uri::create('admin/category/create') ?>">Create</a>
            </div>
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
                    <?php if (!empty($categories)): ?>
                        <?php
                        $index = ($data_pagination['first_item'] ?? 1);
                        foreach ($categories as $category): ?>
                            <tr>
                                <td><?= $index ?></td>
                                <td><a href="<?= Uri::create('admin/category/edit/' . $category->id) ?>"><?= $category->name ?></a></td>
                                <td><?= $category->note ?></td>
                                <td class="text-center">
                                    <a class="btn btn-danger btn-delete" data-url="<?= Uri::create('admin/category/delete/' . $category->id) ?>" href="#">Delete</a>
                                </td>
                            </tr>
                        <?php
                            $index++;
                            endforeach;
                        ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">No data available</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?= View::forge('admin/includes/pagination', $data_pagination); ?>
        </div>
    </div>
    <?= View::forge('admin/includes/modal_confirm', ['id' => 'modal-delete-category']); ?>
</section>