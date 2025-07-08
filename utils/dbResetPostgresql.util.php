<?php
chdir(__DIR__ . '/..');

require_once 'vendor/autoload.php';
require_once 'bootstrap.php';
require_once UTILS_PATH . '/envSetter.util.php';

// Adding database host and connecting
$host = $pgConfig['host'];
$port = $pgConfig['port'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];
$dbname = $pgConfig['db'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

$schemaFiles = [
    'database/users.model.sql',
    'database/meetings.model.sql',
    'database/meeting_users.model.sql',
    'database/tasks.model.sql'
];

//checker

foreach ($schemaFiles as $file) {
    // Just indicator it was working
    echo "Applying schema from {$file}...\n";
    
    $sql = file_get_contents($file);
    
    // Another indicator but for failed creation
    if ($sql === false) {
        throw new RuntimeException("Could not read {$file}");
    } else {
        echo "Creation Success from {$file}\n";
    }
    
    // If your model.sql contains a working command it will be executed
    $pdo->exec($sql);
}

//clean the tables
echo "Truncating tables…\n";
foreach (['meeting_users', 'tasks', 'meetings', 'users'] as $table) {
  $pdo->exec("TRUNCATE TABLE {$table} RESTART IDENTITY CASCADE;");
}

?>