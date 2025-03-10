<?php use Fuel\Core\Uri; ?>

<div class="admin-menu">
    <div class="menu-block">
        <h3 class="title">Admin</h3>
        <ul>
            <li class="<?= in_array(Uri::segment(2), ['dashboard']) ? 'active' : '' ?>">
                <a class="link" href="<?= Uri::create('admin/dashboard') ?>">Dashboard</a>
            </li>
            <li class="<?= in_array(Uri::segment(2), ['user']) ? 'active' : '' ?>">
                <a class="link" href="<?= Uri::create('admin/user/index') ?>">Users</a>
            </li>
            <li class="<?= in_array(Uri::segment(2), ['category']) ? 'active' : '' ?>">
                <a class="link" href="<?= Uri::create('admin/category/index') ?>">Categories</a>
            </li>
            <li class="<?= in_array(Uri::segment(2), ['product']) ? 'active' : '' ?>">
                <a class="link" href="<?= Uri::create('admin/product/index') ?>">Products</a>
            </li>
        </ul>
    </div>
</div>
