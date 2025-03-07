<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <?php echo Asset::css('bootstrap.css'); ?>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h3 class="text-center">Login</h3>
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">User name</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Enter user name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Enter password">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" value="1" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary px-4">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
