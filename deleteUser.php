<?php
$filename = 'users.txt';

if (isset($_GET['index']) && file_exists($filename)) {
    $index = (int)$_GET['index'];
    $users = file($filename, FILE_IGNORE_NEW_LINES);

    if (isset($users[$index])) {
        // Удаляем пользователя из массива
        unset($users[$index]);

        // Перезаписываем файл, убирая пустые строки
        if (!empty($users)) {
            file_put_contents($filename, implode(PHP_EOL, $users) . PHP_EOL);
        } else {
            // Если пользователей не осталось, очищаем файл
            file_put_contents($filename, '');
        }

        echo '<p>Пользователь успешно удалён.</p>';
    } else {
        echo '<p>Пользователь не найден.</p>';
    }
} else {
    echo '<p>Файл с пользователями не найден.</p>';
}

echo '<p><a href="showUsers.php">Вернуться к списку пользователей</a></p>';
?>