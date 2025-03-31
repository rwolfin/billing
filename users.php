<?php
// users.php
$users = [
    'john' => [
        'password' => '$2y$10$W4l/zYq/5UO.6xZQDkzBwO.qC0v8k3o7U1eJjZ0dLmN7J1sK5bLm', // Хеш для "password"
        'birthday' => '1990-05-15'
    ],
    'jane' => [
        'password' => '$2y$10$W4l/zYq/5UO.6xZQDkzBwO.qC0v8k3o7U1eJjZ0dLmN7J1sK5bLm', // Хеш для "password"
        'birthday' => '1985-12-20'
    ]
];

// Функция для добавления пользователя
function addUser(string $login, string $password, string $birthday, array &$users): bool {
    if (isset($users[$login])) {
        return false; // Пользователь уже существует
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $users[$login] = [
        'password' => $hashedPassword,
        'birthday' => $birthday
    ];

    return true;
}