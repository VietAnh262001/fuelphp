<section class="content">
    <div class="page-wrapper search-page-wrapper">
        <h2 class="title">User</h2>
        <hr>
        <div class="content-page">
            <h2>Danh sách Users</h2>
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->username ?></td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->group === 100 ? 'admin' : 'user' ?></td>
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
</section>