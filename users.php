<?php
// users.php (пароли в открытом виде)
$users = [
    'john' => [
        'password' => '5f4dcc3b5aa765d61d8327deb882cf99', // Пароль открытым текстом
        'birthday' => '1990-05-15'
    ],
    'jane' => [
        'password' => '5f4dcc3b5aa765d61d8327deb882cf99', // Пароль открытым текстом
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