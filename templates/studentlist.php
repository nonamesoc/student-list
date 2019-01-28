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
        <form action="">
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
                <th><a href="<?=$linker->sort('name')?>">Имя</a></th>
                <th><a href="<?=$linker->sort('surname')?>">Фамилия</a></th>
                <th><a href="<?=$linker->sort('group_number')?>">Номер группы</a></th>
                <th><a href="<?=$linker->sort('points')?>">Баллов</a></th>
            </tr>
            <?php foreach($studentList as $student): ?>
            <tr>
                <td><?=htmlspecialchars($student->name)?></td>
                <td><?=htmlspecialchars($student->surname)?></td>
                <td><?=htmlspecialchars($student->group_number)?></td>
                <td><?=htmlspecialchars($student->points)?></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php if($pager->getTotalPages() >1) {
            for ($i = 1; $i <= $pager->getTotalPages(); $i++):?>
                <a href="<?=$linker->page($i)?>"><?=$i?></a>
            <?php endfor;
        }?>
    </div>
</body>
</html>
