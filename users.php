<?php
// users.php (пароли в MD5)
$users = [
    'john' => [
        'password' => 'cc8711fc84bf0f94c1408f9e4fccff65' // Пароль в MD5
    ],
    'jane' => [
        'password' => 'cc8711fc84bf0f94c1408f9e4fccff65' // Тут тоже пароль в MD5
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