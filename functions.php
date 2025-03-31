<?php
// functions.php
require_once 'users.php';

function getUsersList(): array {
    global $users;
    return $users;
}

function existsUser(string $login, array $users): bool {
    return isset($users[$login]);
}

// Проверка пароля БЕЗ хеширования
function checkPassword(string $login, string $password, array $users): bool {
    return isset($users[$login]) && ($users[$login]['password'] === $password);
}

function getCurrentUser(): ?string {
    return $_SESSION['user'] ?? null;
}

function loginUser(string $login): void {
    $_SESSION['user'] = $login;
    $_SESSION['login_time'] = time();
}

function logoutUser(): void {
    session_unset();
    session_destroy();
}

function getUserBirthday(string $login, array $users): ?string {
    return $users[$login]['birthday'] ?? null;
}