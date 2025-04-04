<?php
session_start();
require_once 'functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    $birthday = $_POST['birthday'] ?? '';
    $users = getUsersList();

    if (checkPassword($login, $password, $users)) {
        // Сохраняем дату рождения в сессии
        $_SESSION['birthday'] = $birthday;

        loginUser($login);
        header('Location: index.php');
        exit;
    } else {
        $error = 'Неверный логин или пароль';
    }
}

if (getCurrentUser()) {
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Вход в личный кабинет</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <h2>Вход</h2>
        <?php if ($error): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <label>Логин: <input type="text" name="login" required></label><br>
            <label>Пароль: <input type="password" name="password" required></label><br>
            <label>Дата рождения: <input type="date" name="birthday" required></label><br>
            <button type="submit">Войти</button>
        </form>

        <?php
        $users = getUsersList();
        echo "<h3>Примеры для входа:</h3>";
        echo "<ul>";
        foreach ($users as $login => $data) {
            echo "<li>Логин: <strong>" . htmlspecialchars($login) . "</strong>, Пароль: <strong>Bm5ERX4edn</strong></li>";
        }
        echo "</ul>";
        ?>
    </div>
</div>
</body>
</html>
