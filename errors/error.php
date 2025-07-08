<?php
$pageTitle = 'Error';
ob_start();
?>
<h2>Error Occurred</h2>
<p><?= $_SESSION['error'] ?? 'Something went wrong.' ?></p>
<?php
$content = ob_get_clean();
include LAYOUTS_PATH . '/main.layout.php';
