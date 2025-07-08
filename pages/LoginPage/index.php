<?php
require_once '../bootstrap.php';
require_once UTILS_PATH . '/auth.util.php';
?>
<form action="/handlers/auth.handler.php" method="POST">
    <input type="text" name="username" placeholder="Username" required />
    <input type="password" name="password" placeholder="Password" required />
    <button type="submit">Login</button>
</form>
