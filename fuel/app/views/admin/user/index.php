<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">Users</h2>
        <hr>
        <div class="content-page">
            <?= View::forge('admin/includes/title_notification') ?>
            <form class="bg-gray" method="get" action="<?= Uri::create('admin/user/index/') ?>">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label">UserName</label>
                        <input type="text" name="username" class="form-control" value="<?= $search['username'] ?? '' ?>" placeholder="Enter username">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Email</label>
                        <input type="text" name="email" class="form-control" value="<?= $search['email'] ?? '' ?>" placeholder="Enter email">
                    </div>
                    <div class="col-md-1 col-12 text-center d-flex">
                        <button class="btn btn-primary mr-4 px-3" type="submit">Search</button>
                        <a href="/admin/user/index" class="btn btn-secondary px-3">Reset</a>
                    </div>
                </div>
            </form>
            <h2>List Users</h2>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php
                        $index = ($data_pagination['first_item'] ?? 1);
                        foreach ($users as $user):
                        ?>
                            <tr>
                                <td><?= $index ?></td>
                                <td><?= $user->username ?></td>
                                <td><?= $user->email ?></td>
                                <td><?= $user->group === 100 ? 'admin' : 'user' ?></td>
                                <td class="text-center">
                                    <a class="btn btn-info" href="<?= Uri::create('admin/user/edit/' . $user->id) ?>">Edit</a>
                                    <a class="btn btn-danger btn-delete" data-url="<?= Uri::create('admin/user/delete/' . $user->id) ?>" href="#">Delete</a>
                                </td>
                            </tr>
                        <?php
                            $index++;
                            endforeach;
                        ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted">No data available</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <?= View::forge('admin/includes/pagination', $data_pagination); ?>
        </div>
    </div>
    <?= View::forge('admin/includes/modal_confirm', ['id' => 'modal-delete-user']); ?>
</section>