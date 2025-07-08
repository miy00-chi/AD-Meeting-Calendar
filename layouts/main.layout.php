<?php
require_once UTILS_PATH . '/auth.util.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?? 'Meeting App' ?></title>
</head>
<body>
<?php include COMPONENTS_PATH . '/navbar.component.php'; ?>
<div class="content">
    <?= $content ?? '' ?>
</div>
</body>
</html>
