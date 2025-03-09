<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?= isset($title) ? $title : 'THK Holdings Viet Nam Hanoi' ?></title>

    <?php echo Asset::css('bootstrap.css'); ?>
    <?php echo Asset::css('admin/app.css'); ?>
    <?php echo Asset::css('admin/common.css'); ?>
    <?php echo Asset::css('admin/side-menu.css'); ?>
    <?php if (isset($custom_css)) echo Asset::css($custom_css); ?>
    <?php echo Asset::js('jquery.min.js'); ?>
    <?php echo Asset::js('admin/app.js'); ?>
    <?php if (isset($js)) echo Asset::js($js); ?>
</head>
<body>
<?= View::forge('admin/includes/side_menu'); ?>
<?= isset($content) ? $content : "" ?>
</body>
</html>
