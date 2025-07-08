<?php
function isLoggedIn(): bool {
    return isset($_SESSION['user']);
}

function getLoggedUser() {
    return $_SESSION['user'] ?? null;
}

function login(PDO $pdo, string $username, string $password): bool {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        return true;
    }

    return false;
}

function logout(): void {
    session_destroy();
}
