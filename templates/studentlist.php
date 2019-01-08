<?php
/**
 * Created by PhpStorm.
 * User: Avatar
 * Date: 02.01.2019
 * Time: 17:23
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Список абитуриентов</title>
</head>
<body>
    <div>
        <p>Список студентов</p>
        <form action="studentlist.php">
            <label for="search">
                Поиск :
                <input type="search" id="search" name="search">
            </label>
            <input type="submit" value="Найти">
        </form>
    </div>
    <div>
        <table>
            <tr>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Номер группы</th>
                <th>Баллов</th>
            </tr>
            <?php foreach($studentList as $student): ?>
            <tr>
                <td><?= $student->name ?></td>
                <td><?= $student->surname ?></td>
                <td><?= $student->group ?></td>
                <td><?= $student->points ?></td>
            </tr>
            <?php endforeach; ?>
            Пагинация
        </table>
    </div>
</body>
</html>
