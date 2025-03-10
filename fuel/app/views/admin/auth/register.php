<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('admin/auth.css'); ?>
    <?php echo Asset::css('admin/common.css'); ?>
    <?php echo Asset::js('jquery.min.js'); ?>
    <?php echo Asset::js('admin/app.js'); ?>
</head>
<body>
<div class="login-container">
    <h3 class="text-center">Register</h3>
    <?= View::forge('admin/includes/title_notification') ?>
    <form method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control <?= !empty($errors['email']) ? 'border-error' : '' ?>" value="<?= Input::post('email', '') ?>" name="email" id="email" placeholder="Enter email">
            <?php if (!empty($errors['email'])): ?>
                <p class="text-error"><?= $errors['email'] ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="username" class="form-label">User name</label>
            <input type="text" value="<?= Input::post('username', '') ?>" class="form-control <?= !empty($errors['username']) ? 'border-error' : '' ?>" name="username" id="username" placeholder="Enter user name">
            <?php if (!empty($errors['username'])): ?>
                <p class="text-error"><?= $errors['username'] ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" value="<?= Input::post('password', '') ?>" class="form-control <?= !empty($errors['password']) ? 'border-error' : '' ?>" name="password" id="password" placeholder="Enter password">
            <?php if (!empty($errors['password'])): ?>
                <p class="text-error"><?= $errors['password'] ?></p>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label for="confirm-password" class="form-label">Password</label>
            <input type="password" value="<?= Input::post('confirm_password', '') ?>" class="form-control <?= !empty($errors['confirm_password']) ? 'border-error' : '' ?>" name="confirm_password" id="confirm-password" placeholder="Enter confirm password">
            <?php if (!empty($errors['confirm_password'])): ?>
                <p class="text-error"><?= $errors['confirm_password'] ?></p>
            <?php endif; ?>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary px-4">Register</button>
        </div>
    </form>
</div>
</body>
</html>
