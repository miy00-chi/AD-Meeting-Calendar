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

$table = $argv[1] ?? 'all';

switch ($table) {
    case 'users':
        echo "Seeding users…\n";
        $data = require DUMMIES_PATH . '/users.staticData.php';
        $stmt = $pdo->prepare("INSERT INTO users (username, role, first_name, middle_name, last_name, password) VALUES (:username, :role, :fn, :mn, :ln, :pw)");

        foreach ($data as $u) {
            $stmt->execute([
                ':username' => $u['username'],
                ':role'     => $u['role'],
                ':fn'       => $u['first_name'],
                ':mn'       => $u['middle_name'] ?? null,
                ':ln'       => $u['last_name'],
                ':pw'       => password_hash($u['password'], PASSWORD_DEFAULT),
            ]);
        }
        echo "Users seeded.\n";
        break;

    case 'meetings':
        echo "Seeding meetings…\n";
        $data = require DUMMIES_PATH . '/meetings.staticData.php';

        // Fetch user IDs by username
        $userStmt = $pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt = $pdo->prepare("INSERT INTO meetings (title, description, meeting_date, start_time, end_time, created_by) VALUES (:title, :description, :meeting_date, :start_time, :end_time, :created_by)");

        foreach ($data as $m) {
            $userStmt->execute([':username' => $m['created_by']]);
            $userId = $userStmt->fetchColumn();

            if (!$userId) {
                echo "User not found: {$m['created_by']}\n";
                continue;
            }

            $m['start_time'] = date('H:i:s', strtotime($m['scheduled_at']));
            $m['end_time']   = date('H:i:s', strtotime($m['scheduled_at']) + 3600);

            $stmt->execute([
                ':title'        => $m['title'],
                ':description'  => $m['description'],
                ':meeting_date' => $m['meeting_date'],
                ':start_time'   => $m['start_time'],
                ':end_time'     => $m['end_time'],
                ':created_by'   => $userId,
            ]);
        }
        echo "Meetings seeded.\n";
        break;

    case 'all':
        $argv[1] = 'users';         require __FILE__;
        $argv[1] = 'meetings';      require __FILE__;
        break;

    default:
        echo "No seeder found for `{$table}`. Skipping.\n";
}
