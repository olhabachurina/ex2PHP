<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);

    $filename = 'users.txt';
    if (file_exists($filename)) {
        $users = file($filename, FILE_IGNORE_NEW_LINES);
        $authenticated = false;

        foreach ($users as $user) {
            list($storedLogin, $storedPasswordHash) = explode(': ', $user);
            if ($storedLogin === $login && password_verify($password, $storedPasswordHash)) {
                $_SESSION['authenticated'] = true; // Устанавливаем авторизацию
                $_SESSION['username'] = $login; // Сохраняем имя пользователя
                header('Location: showUsers.php'); // Перенаправляем на список пользователей
                exit;
            }
        }

        echo '<p class="error">Неверный логин или пароль.</p>';
    } else {
        echo '<p class="error">Файл пользователей не найден.</p>';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('fon.jpg'), linear-gradient(to bottom right, #8e44ad, #3498db); /* Фоновая картинка и градиент */
            background-size: cover, cover; /* Растягиваем картинку и градиент */
            background-position: center center; /* Центрируем картинку */
            background-attachment: fixed; /* Фиксируем фон */
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #fda085;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
        }

        .error {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

<form action="login.php" method="POST">
    <h2>Авторизация</h2>
    <input type="text" name="login" placeholder="Введите логин" required><br>
    <input type="password" name="password" placeholder="Введите пароль" required><br>
    <input type="submit" value="Войти">
</form>

</body>
</html>