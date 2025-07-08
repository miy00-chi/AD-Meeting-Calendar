<?php
require_once '../bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';

logout();
header('Location: /pages/login.php');
exit;
