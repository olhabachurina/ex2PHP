<?php
session_start();

// Проверка авторизации
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header('Location: login.php');
    exit;
}

$filename = 'users.txt';
$successMessage = '';
$errorMessage = '';

// Удаление пользователя
if (isset($_GET['delete'])) {
    $indexToDelete = (int)$_GET['delete'];

    if (file_exists($filename)) {
        $users = file($filename, FILE_IGNORE_NEW_LINES);

        if (isset($users[$indexToDelete])) {
            // Удаляем пользователя из массива
            unset($users[$indexToDelete]);
            // Перезаписываем файл
            file_put_contents($filename, implode(PHP_EOL, $users) . PHP_EOL);
            $successMessage = "Пользователь успешно удалён.";
        } else {
            $errorMessage = "Пользователь не найден.";
        }
    } else {
        $errorMessage = "Файл с пользователями не найден.";
    }
}

// Редактирование пользователя аналогично можно сделать через обработку формы, и тоже оставить пользователя на той же странице
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список зарегистрированных пользователей</title>
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
            flex-direction: column;
        }

        h1 {
            font-size: 2.5em;
            font-weight: bold;
            color: #FFA500;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            animation: glow 2s infinite alternate;
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

        .table-container {
            background: none;
            padding: 20px;
            width: 80%;
            max-width: 1000px;
            animation: slideIn 1s ease-in-out;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
            transition: background-color 0.3s;
        }

        th {
            background-color: #fda085;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover td {
            background-color: #f6d365;
        }

        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            transition: transform 0.3s;
        }

        img:hover {
            transform: scale(1.2);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        .edit, .delete, .menu {
            padding: 10px 15px;
            background-color: #fda085;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
        }

        .edit:hover, .menu:hover {
            background-color: #f6d365;
            transform: scale(1.05);
        }

        .delete {
            background-color: #ff6b6b;
        }

        .delete:hover {
            background-color: #ff4b4b;
            transform: scale(1.05);
        }

        .menu-container {
            display: flex;
            justify-content: flex-end;
            width: 100%;
            max-width: 1000px;
            margin-bottom: 20px;
            z-index: 2;
        }

        .notification {
            padding: 15px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .notification.error {
            background-color: #f44336;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>
</head>
<body>

<h1>Список зарегистрированных пользователей</h1>

<!-- Кнопка для возврата в меню -->
<div class="menu-container">
    <button class="menu" onclick="window.location.href = '/Exercise2/index.php';">Вернуться в меню</button>
</div>

<div class="table-container">

    <!-- Сообщение об успехе или ошибке -->
    <?php if ($successMessage): ?>
        <div class="notification"><?php echo $successMessage; ?></div>
    <?php elseif ($errorMessage): ?>
        <div class="notification error"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <?php
    if (file_exists($filename)) {
        $users = file($filename, FILE_IGNORE_NEW_LINES);
        if (count($users) > 0) {
            echo '<table>';
            echo '<tr><th>Логин</th><th>Пароль (хэш)</th><th>Email</th><th>Аватар</th><th>Действия</th></tr>';
            foreach ($users as $index => $user) {
                $userDetails = explode(': ', $user);

                echo '<tr>';
                echo '<td>' . htmlspecialchars($userDetails[0]) . '</td>';
                echo '<td>' . htmlspecialchars($userDetails[1]) . '</td>';
                echo '<td>' . htmlspecialchars($userDetails[2]) . '</td>';

                if (isset($userDetails[3])) {
                    echo '<td><img src="' . htmlspecialchars($userDetails[3]) . '" alt="Avatar"></td>';
                } else {
                    echo '<td>Нет аватарки</td>';
                }

                // Добавляем действия "Редактировать" и "Удалить"
                echo '<td class="actions">';
                echo '<a class="edit" href="editUser.php?index=' . $index . '">Редактировать</a>';
                echo '<a class="delete" href="?delete=' . $index . '" onclick="return confirm(\'Вы уверены, что хотите удалить этого пользователя?\')">Удалить</a>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>Нет зарегистрированных пользователей.</p>';
        }
    } else {
        echo '<p>Файл с пользователями не найден.</p>';
    }
    ?>
</div>

</body>
</html>
