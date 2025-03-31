<?php
// functions.php
require_once 'users.php'; // Подключение данных пользователей

// Возвращает список всех пользователей
function getUsersList(): array {
    global $users;
    return $users;
}

// Проверяет существование пользователя
function existsUser(string $login, array $users): bool {
    return isset($users[$login]);
}

// Проверяет логин и пароль
function checkPassword(string $login, string $password, array $users): bool {
    if (existsUser($login, $users)) {
        return password_verify($password, $users[$login]['password']);
    }
    return false;
}

// Возвращает логин текущего пользователя
function getCurrentUser(): ?string {
    return $_SESSION['user'] ?? null;
}

// Авторизует пользователя
function loginUser(string $login): void {
    $_SESSION['user'] = $login;
    $_SESSION['login_time'] = time(); // Фиксируем время входа
}

// Выход пользователя
function logoutUser(): void {
    unset($_SESSION['user']);
    unset($_SESSION['login_time']);
    session_destroy();
}

// Возвращает дату рождения пользователя
function getUserBirthday(string $login, array $users): ?string {
    if (existsUser($login, $users) && isset($users[$login]['birthday'])) {
        return $users[$login]['birthday'];
    }
    return null;
}