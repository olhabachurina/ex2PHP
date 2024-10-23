<?php
$filename = 'users.txt';
$login = $password = $email = $avatar = '';
$successMessage = ''; // Переменная для сообщения об успешном обновлении
$errorMessage = ''; // Переменная для сообщения об ошибке

if (isset($_GET['index']) && file_exists($filename)) {
    $index = (int)$_GET['index'];
    $users = file($filename, FILE_IGNORE_NEW_LINES);

    if (isset($users[$index])) {
        // Получаем данные пользователя
        $userDetails = explode(': ', $users[$index]);
        $login = $userDetails[0];
        $password = $userDetails[1]; // Хэш пароля
        $email = $userDetails[2];
        $avatar = isset($userDetails[3]) ? $userDetails[3] : '';
    } else {
        $errorMessage = 'Пользователь не найден.';
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newLogin = trim($_POST['login']);
        $newPassword = trim($_POST['password']);
        $newEmail = trim($_POST['email']);
        $newAvatar = $_POST['avatar'];

        // Если пароль не был введён, сохраняем старый хэш
        if (empty($newPassword)) {
            $hashedPassword = $password; // Сохраняем старый хэш пароля
        } else {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT); // Хэшируем новый пароль
        }

        // Обновляем данные пользователя в массиве
        $users[$index] = implode(': ', [$newLogin, $hashedPassword, $newEmail, $newAvatar]);

        // Перезаписываем файл с обновленными данными
        file_put_contents($filename, implode(PHP_EOL, $users) . PHP_EOL);

        // Сообщение об успешном обновлении
        $successMessage = 'Пользователь успешно обновлен.';
    }
} else {
    $errorMessage = 'Файл с пользователями не найден.';
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактировать пользователя</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(120deg, #f6d365, #fda085);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            color: #333;
            margin: 0;
        }

        form {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="password"], input[type="email"] {
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
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #f6d365;
        }

        .avatar-selection img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        .notification {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            color: white;
            background-color: #4CAF50; /* Зеленый фон для успешного сообщения */
        }

        .notification.error {
            background-color: #f44336; /* Красный фон для ошибки */
        }
    </style>

    <!-- Скрипт для перенаправления через 3 секунды -->
    <?php if ($successMessage): ?>
        <script>
            setTimeout(function() {
                window.location.href = '/Exercise2/showUsers.php';
            }, 3000); // Перенаправление через 3 секунды
        </script>
    <?php endif; ?>
</head>
<body>

<h1>Редактировать пользователя</h1>

<!-- Сообщения об успешном обновлении или ошибке -->
<?php if ($successMessage): ?>
    <div class="notification"><?php echo $successMessage; ?></div>
<?php elseif ($errorMessage): ?>
    <div class="notification error"><?php echo $errorMessage; ?></div>
<?php endif; ?>

<form action="editUser.php?index=<?php echo $index; ?>" method="POST">
    <label for="login">Логин:</label><br>
    <input type="text" id="login" name="login" value="<?php echo htmlspecialchars($login); ?>" required><br><br>

    <label for="password">Новый пароль (оставьте пустым, если не нужно менять):</label><br>
    <input type="password" id="password" name="password"><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required><br><br>

    <label>Выберите аватарку:</label><br>

    <div class="avatar-selection">
        <input type="radio" id="image" name="avatar" value="image.jpg" <?php echo ($avatar === 'image.jpg') ? 'checked' : ''; ?> required>
        <label for="image"><img src="image.jpg" alt="Image"></label><br>

        <input type="radio" id="image1" name="avatar" value="image1.jpg" <?php echo ($avatar === 'image1.jpg') ? 'checked' : ''; ?> required>
        <label for="image1"><img src="image1.jpg" alt="Image 1"></label><br>

        <input type="radio" id="image2" name="avatar" value="image2.jpg" <?php echo ($avatar === 'image2.jpg') ? 'checked' : ''; ?> required>
        <label for="image2"><img src="image2.jpg" alt="Image 2"></label><br>

        <input type="radio" id="image3" name="avatar" value="image3.jpg" <?php echo ($avatar === 'image3.jpg') ? 'checked' : ''; ?> required>
        <label for="image3"><img src="image3.jpg" alt="Image 3"></label><br>

        <input type="radio" id="image4" name="avatar" value="image4.jpg" <?php echo ($avatar === 'image4.jpg') ? 'checked' : ''; ?> required>
        <label for="image4"><img src="image4.jpg" alt="Image 4"></label><br>

        <input type="radio" id="image5" name="avatar" value="image5.jpg" <?php echo ($avatar === 'image5.jpg') ? 'checked' : ''; ?> required>
        <label for="image5"><img src="image5.jpg" alt="Image 5"></label><br>

        <input type="radio" id="image6" name="avatar" value="image6.jpg" <?php echo ($avatar === 'image6.jpg') ? 'checked' : ''; ?> required>
        <label for="image6"><img src="image6.jpg" alt="Image 6"></label><br>

        <input type="radio" id="image7" name="avatar" value="image7.jpg" <?php echo ($avatar === 'image7.jpg') ? 'checked' : ''; ?> required>
        <label for="image7"><img src="image7.jpg" alt="Image 7"></label><br>

        <input type="radio" id="image8" name="avatar" value="image8.jpg" <?php echo ($avatar === 'image8.jpg') ? 'checked' : ''; ?> required>
        <label for="image8"><img src="image8.jpg" alt="Image 8"></label><br>
    </div>

    <input type="submit" value="Сохранить изменения">
</form>

</body>
</html>