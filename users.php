<?php
// users.php (пароли в открытом виде)
$users = [
    'john' => [
        'password' => 'password', // Пароль открытым текстом
        'birthday' => '1990-05-15'
    ],
    'jane' => [
        'password' => 'password', // Пароль открытым текстом
        'birthday' => '1985-12-20'
    ]
];

// Функция добавления пользователя
function addUser(string $login, string $password, string $birthday, array &$users): bool {
    if (isset($users[$login])) {
        return false;
    }
    $users[$login] = [
        'password' => $password,
        'birthday' => $birthday
    ];
    return true;
}