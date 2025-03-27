<?php

   function getUsersList() {
    $users = json_decode(file_get_contents('users.json'), true);
    return $users ?? [];
}

    function existsUser($login) {
        $users = getUsersList();
        return isset($users[$login]);
    }
    
    function checkPassword($login, $password) {
        $users = getUsersList();
        if (existsUser($login)) {
            return password_verify($password, $users[$login]['password']);
        }
        return false;
    }

    function getCurrentUser() {
        return $_SESSION['user'] ?? null;
    }

?>