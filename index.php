<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Меню</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('fon.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8); /* Полупрозрачный белый фон */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Легкая тень для объема */
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            animation: fadeIn 1s ease-in-out;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin: 10px 0;
        }

        a {
            padding: 10px 20px;
            background-color: rgba(139, 69, 19, 0.8); /* Прозрачный коричневый фон для кнопок */
            border: 1px solid #333;
            border-radius: 5px;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.2s;
            display: inline-block;
        }

        a:hover {
            background-color: rgba(160, 82, 45, 0.8); /* Светло-коричневый фон при наведении */
            transform: scale(1.05); /* Легкое увеличение при наведении */
        }

        a:active {
            transform: scale(0.95); /* Легкий эффект нажатия */
        }

        p {
            margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.7); /* Прозрачный белый фон для текста */
            padding: 10px;
            border-radius: 10px;
        }

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
        <li><a href="addUser.php">Add</a></li>
        <li><a href="showUsers.php">Show</a></li>
    </ul>

    <?php
    // Подсчёт количества пользователей в файле users.txt
    $filename = 'users.txt';
    $userCount = 0;  // Инициализируем переменную $userCount

    if (file_exists($filename)) {
        $users = file($filename, FILE_IGNORE_NEW_LINES);
        $userCount = count($users); // Подсчитываем количество пользователей
    }
    ?>

    <p>Текущее количество пользователей: <?php echo $userCount; ?></p>
</div>

</body>
</html>