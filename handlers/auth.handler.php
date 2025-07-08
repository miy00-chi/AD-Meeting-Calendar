<?php
require_once '../bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (login($pdo, $username, $password)) {
        header('Location: /pages/index.php');
        exit;
    } else {
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: /pages/login.php');
        exit;
    }
}
?>
