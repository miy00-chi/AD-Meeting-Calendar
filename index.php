<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
</head>
<body>
    <h1>Database Connection Status</h1>
    <?php
        include_once HANDLERS_PATH . '/mongodbChecker.handler.php';
        include_once HANDLERS_PATH . '/postgreChecker.handler.php';
    ?>
</body>
</html>
