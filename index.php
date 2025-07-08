<?php
require_once '../bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';

if (!isLoggedIn()) {
    header('Location: /pages/login.php');
    exit;
}

$pageTitle = 'Dashboard';
ob_start();
?>
<h1>Welcome, <?= htmlspecialchars(getLoggedUser()['first_name']) ?>!</h1>
<?php
$content = ob_get_clean();
include LAYOUTS_PATH . '/main.layout.php';
