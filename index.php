<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Меню</title>
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

        .container {
            background-color: rgba(255, 255, 255, 0.2); /* Прозрачный фон для контейнера */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3); /* Мягкая тень */
            text-align: center;
            backdrop-filter: blur(10px); /* Размытие фона позади контейнера */
            animation: fadeInContainer 1.5s ease forwards; /* Анимация плавного появления контейнера */
        }

        h1 {
            font-size: 3em;
            color: #fff;
            text-shadow: 0 0 15px rgba(255, 255, 255, 0.8); /* Светящееся заголовок */
            margin-bottom: 20px;
            animation: glow 2s infinite alternate; /* Пульсация текста */
        }

        ul {
            list-style-type: none;
            padding: 0;
            margin-bottom: 20px;
        }

        li {
            margin: 15px 0;
        }

        a {
            padding: 12px 25px;
            background-color: rgba(255, 255, 255, 0.15); /* Полупрозрачный фон для кнопки */
            border: 2px solid rgba(255, 255, 255, 0.7); /* Полупрозрачная рамка */
            border-radius: 10px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
            display: inline-block;
            font-size: 1.2em;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3); /* Мягкое свечение вокруг кнопки */
        }

        a:hover {
            background-color: rgba(255, 255, 255, 0.3); /* Ярче фон при наведении */
            transform: scale(1.1); /* Увеличение при наведении */
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.6); /* Усиление свечения */
        }

        a:active {
            transform: scale(0.95); /* Эффект нажатия */
        }

        p {
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.2); /* Прозрачный фон для текста */
            padding: 15px;
            border-radius: 10px;
            color: #fff;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.3); /* Светящееся обрамление текста */
        }

        /* Анимация для заголовка */
        @keyframes glow {
            from {
                text-shadow: 0 0 15px rgba(255, 255, 255, 0.8), 0 0 30px rgba(255, 255, 255, 0.6);
            }
            to {
                text-shadow: 0 0 25px rgba(255, 255, 255, 1), 0 0 40px rgba(255, 255, 255, 0.8);
            }
        }

        /* Анимация плавного появления контейнера */
        @keyframes fadeInContainer {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Плавное появление текста */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Меню</h1>
    <ul>
        <li><a href="addUser.php">Add User</a></li>
        <li><a href="showUsers.php">Show Users</a></li>
        <li><a href="login.php">Login</a></li> <!-- Пункт авторизации -->
    </ul>

    <?php
    $filename = 'users.txt';
    $userCount = 0;

    if (file_exists($filename)) {
        $users = file($filename, FILE_IGNORE_NEW_LINES);
        $userCount = count($users);
    }
    ?>

    <p>Текущее количество пользователей: <?php echo $userCount; ?></p>
</div>

</body>
</html>