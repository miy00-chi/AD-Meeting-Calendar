<?php
chdir(__DIR__ . '/..');

require_once 'vendor/autoload.php';
require_once 'bootstrap.php';
require_once UTILS_PATH . '/envSetter.util.php';

// DB connection setup
$host = $pgConfig['host'];
$port = $pgConfig['port'];
$username = $pgConfig['user'];
$password = $pgConfig['pass'];
$dbname = $pgConfig['db'];

$dsn = "pgsql:host={$host};port={$port};dbname={$dbname}";
$pdo = new PDO($dsn, $username, $password, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
]);

// Dropping old tables
echo "Dropping old tables…\n";
foreach ([
  'projects',
  'users',
] as $table) {
  $pdo->exec("DROP TABLE IF EXISTS {$table} CASCADE;");
}

// Applying schema
echo "Applying schema from database/users.model.sql…\n";
$sql = file_get_contents('database/users.model.sql');

if ($sql === false) {
    throw new RuntimeException("Could not read database/users.model.sql");
} else {
    echo "Creation Success from the database/users.model.sql\n";
}

$pdo->exec($sql);
