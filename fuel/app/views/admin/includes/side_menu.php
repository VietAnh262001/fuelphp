<?php use Fuel\Core\Uri; ?>

<div class="admin-menu">
    <div class="menu-block">
        <h3 class="title">サイト管理</h3>
        <ul>
            <li class="<?= in_array(Uri::segment(2), ['dashboard']) ? 'active' : '' ?>">
                <a class="link" href="<?= Uri::create('admin/dashboard') ?>">ホテル検索</a>
            </li>
            <li class="<?= in_array(Uri::segment(2), ['category']) ? 'active' : '' ?>">
                <a class="link" href="<?= Uri::create('admin/category/index') ?>">ホテル追加</a>
            </li>
            <li class="<?= in_array(Uri::segment(2), ['product']) ? 'active' : '' ?>">
                <a class="link" href="<?= Uri::create('admin/product/index') ?>">予約情報検索</a>
            </li>
        </ul>
    </div>
</div>
