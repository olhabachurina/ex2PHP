<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить пользователя</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('fon.jpg'); /* Фоновая картинка */
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        h1 {
            font-size: 2.5em;
            font-weight: bold;
            color: #FFA500;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5); /* Добавляем тень для заголовка */
            animation: glow 2s infinite alternate; /* Анимация подсветки */
            margin-bottom: 20px;
            z-index: 2;
        }

        @keyframes glow {
            from {
                text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5), 0 0 10px #FFA500, 0 0 20px #FFA500, 0 0 30px #FFA500;
            }
            to {
                text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5), 0 0 20px #FF8C00, 0 0 30px #FF8C00, 0 0 40px #FF8C00;
            }
        }

        form {
            background: rgba(255, 255, 255, 0.7); /* Полупрозрачный фон для читабельности */
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            animation: slideDown 1s ease-in-out;
            width: 400px;
            text-align: center;
        }

        input[type="text"], input[type="password"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.85); /* Легкая прозрачность для полей ввода */
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #fda085;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: white;
            transition: background-color 0.3s, transform 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #f6d365;
            transform: scale(1.05); /* Легкое увеличение при наведении */
        }

        input[type="submit"]:active {
            transform: scale(0.95); /* Легкий эффект нажатия */
        }

        .error {
            color: red;
            font-weight: bold;
            animation: shake 0.5s;
        }

        .avatar-selection {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 10px;
        }

        .avatar-selection label img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .avatar-selection label img:hover {
            transform: scale(1.2); /* Увеличение при наведении */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Тень при наведении */
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideDown {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            50% { transform: translateX(5px); }
            75% { transform: translateX(-5px); }
        }

        p.success {
            color: green;
            font-weight: bold;
        }

    </style>
</head>
<body>

<h1>Добавить пользователя</h1>

<form action="addUser.php" method="POST">
    <label for="login">Логин (должен содержать минимум 3 символа):</label><br>
    <input type="text" id="login" name="login" required><br><br>

    <label for="password">Пароль (длина минимум 6 символов):</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label>Выберите аватарку:</label>
    <div class="avatar-selection">
        <label for="image">
            <input type="radio" id="image" name="avatar" value="image.jpg" required>
            <img src="image.jpg" alt="Image">
        </label>

        <label for="image1">
            <input type="radio" id="image1" name="avatar" value="image1.jpg" required>
            <img src="image1.jpg" alt="Image 1">
        </label>

        <label for="image2">
            <input type="radio" id="image2" name="avatar" value="image2.jpg" required>
            <img src="image2.jpg" alt="Image 2">
        </label>

        <label for="image3">
            <input type="radio" id="image3" name="avatar" value="image3.jpg" required>
            <img src="image3.jpg" alt="Image 3">
        </label>

        <label for="image4">
            <input type="radio" id="image4" name="avatar" value="image4.jpg" required>
            <img src="image4.jpg" alt="Image 4">
        </label>

        <label for="image5">
            <input type="radio" id="image5" name="avatar" value="image5.jpg" required>
            <img src="image5.jpg" alt="Image 5">
        </label>

        <label for="image6">
            <input type="radio" id="image6" name="avatar" value="image6.jpg" required>
            <img src="image6.jpg" alt="Image 6">
        </label>

        <label for="image7">
            <input type="radio" id="image7" name="avatar" value="image7.jpg" required>
            <img src="image7.jpg" alt="Image 7">
        </label>

        <label for="image8">
            <input type="radio" id="image8" name="avatar" value="image8.jpg" required>
            <img src="image8.jpg" alt="Image 8">
        </label>
    </div>
    <br><br>

    <input type="submit" value="Зарегистрировать">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $avatar = $_POST['avatar'];

    // Валидация данных
    $errors = [];

    // Валидация логина
    if (strlen($login) < 3) {
        $errors[] = "Логин должен содержать минимум 3 символа.";
    }

    if (!preg_match('/^[a-zA-Z0-9]+$/', $login)) {
        $errors[] = "Логин может содержать только буквы и цифры.";
    }

    // Валидация пароля
    if (strlen($password) < 6) {
        $errors[] = "Пароль должен содержать минимум 6 символов.";
    }

    // Валидация email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Неверный формат email.";
    }

    // Если есть ошибки, выводим их
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p class='error'>$error</p>";
        }
    } else {
        // Хэшируем пароль
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Функция для записи пользователя в файл
        function addUser($userData) {
            $filename = 'users.txt';
            $handle = fopen($filename, 'a');
            fwrite($handle, implode(': ', $userData) . PHP_EOL);
            fclose($handle);
        }

        $filename = 'users.txt';
        if (file_exists($filename)) {
            $users = file($filename, FILE_IGNORE_NEW_LINES);
        } else {
            $users = [];
        }

        $exists = false;
        foreach ($users as $user) {
            $userDetails = explode(': ', $user);
            if ($userDetails[0] === $login) {
                $exists = true;
                break;
            }
        }

        if ($exists) {
            echo "<p class='error'>Пользователь с логином $login уже существует!</p>";
        } else {
            // Добавляем пользователя с хэшированным паролем
            addUser([$login, $hashedPassword, $email, $avatar]);
            echo "<p class='success'>Пользователь $login успешно зарегистрирован!</p>";
        }
    }
}
?>

</body>
</html>