<?php
require_once 'auth.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';
    $birthday = $_POST['birthday'] ?? '';

    if (empty($login) || empty($password) || empty($birthday)) {
        $error = 'Заполните все поля!';
    } elseif (existsUser($login)) {
        $error = 'Этот логин уже занят';
    } else {
        if (registerUser($login, $password, $birthday)) {
            $success = 'Регистрация успешна! Теперь вы можете <a href="login.php">войти</a>.';
        } else {
            $error = 'Ошибка при регистрации';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
    <div class="container">
        <h2>Регистрация</h2>
        <?php if ($error): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if ($success): ?>
            <p style="color: green;"><?= $success ?></p>
        <?php else: ?>
            <form method="POST">
                <label>Логин: <input type="text" name="login" required></label><br>
                <label>Пароль: <input type="password" name="password" required></label><br>
                <label>Дата рождения: <input type="date" name="birthday" required></label><br>
                <button type="submit">Зарегистрироваться</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>