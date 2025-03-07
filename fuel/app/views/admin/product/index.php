<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Products</h2>
        <hr>
        <form class="bg-gray" method="get">
            <div class="row g-3 align-items-end">
                <div class="col-md-3 col-12">
                    <label for="search-name" class="mb-1">Name</label>
                    <input class="form-control border-radius-none" type="text" name="search_name" value="" id="search-name">
                </div>

                <div class="col-md-1 col-12 text-center">
                    <button class="btn btn-primary w-100" type="submit">検索</button>
                </div>
            </div>
        </form>
        <div class="content-page">
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
                        <td><?= $product->image ?></td>
                        <td><?= $product->price ?></td>
                        <td><?= $product->note ?></td>
                        <td>
                            <a class="btn btn-primary" href="<?= Uri::create('admin/product/edit/' . $product->id) ?>">Edit</a>
                            <a class="btn btn-danger" href="<?= Uri::create('admin/product/delete/' . $product->id) ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
<!--            --><?php //= View::forge('admin/includes/pagination', [
//                'total' => $total,
//                'first_item' => $first_item,
//                'last_item' => $last_item,
//                'pagination' => $pagination,
//            ]); ?>
        </div>
    </div>
</section>