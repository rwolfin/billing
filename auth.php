<?php
session_start();

define('USERS_FILE', __DIR__ . '/data/users.json');

function getUsersList()
{
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $json = file_get_contents(USERS_FILE);
    return json_decode($json, true);
}

function existsUser($login)
{
    $users = getUsersList();
    return isset($users[$login]);
}

function checkPassword($login, $password)
{
    $users = getUsersList();
    return isset($users[$login]) && password_verify($password, $users[$login]['password']);
}

function getCurrentUser()
{
    return $_SESSION['user'] ?? null;
}

function loginUser($login)
{
    $_SESSION['user'] = $login;
    $_SESSION['login_time'] = time();
}

function registerUser($login, $password, $birthday)
{
    if (existsUser($login)) {
        return false;
    }
    $users = getUsersList();
    $users[$login] = [
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'birthday' => $birthday
    ];
    file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
    return true;
}

function logoutUser()
{
    session_destroy();
    header('Location: index.php');
    exit;
}
?>