<?php
/**
 * Created by PhpStorm.
 * User: Avatar
 * Date: 02.01.2019
 * Time: 18:36
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
</head>
<body>
    <div>
        <form action="register.php" method="post">
            <label for="name">Имя</label>
            <input type="text" name="name" id="name" value="<?=htmlspecialchars($student->name) ?>" required>
            <?=$errors['name']?>
            <br>
            <label for="surname">Фамилия</label>
            <input type="text" name="surname" id="surname" value="<?=htmlspecialchars($student->surname) ?>" required>
            <?=$errors['surname']?>
            <br>
            <p>Пол
            <input type="radio" name="gender" value="male" id="radio_male"<?=($student->gender == 'male') ?  'checked' : ''?> required><label for="radio_male">Мужчина</label><br>
            <input type="radio" name="gender" value="female" id="radio_female"<?=($student->gender == 'female') ?  'checked' : ''?> required><label for="radio_female">Женщина</label></p>
            <?=$errors['gender']?>
            <br>
            <label for="group_number">Номер группы</label>
            <input type="text" name="group_number" id="group_number" value="<?=htmlspecialchars($student->group_number) ?>" required>
            <?=$errors['group_number']?>
            <br>
            <label for="email">email</label>
            <input type="email" name="email" id="email" value="<?=htmlspecialchars($student->email) ?>" required>
            <?=$errors['email']?>
            <br>
            <label for="points">Вступительные баллы</label>
            <input type="number" name="points" id="points" value="<?=htmlspecialchars($student->points) ?>" required>
            <?=$errors['points']?>
            <br>
            <label for="birth_date">Год рождения</label>
            <input type="date" name="birth_date" id="birth_date" value="<?=htmlspecialchars($student->birth_date) ?>" min="1980-01-01" max="2002-12-31" required>
            <?=$errors['birth_date']?>
            <br>
            <p>Место проживания
            <input type="radio" name="residence" value="nonresident" id="radio_nonresident" <?=($student->residence == 'nonresident') ?  'checked' : ''?> required><label for="radio_nonresident">Иногородний</label><br>
            <input type="radio" name="residence" value="resident" id="radio_resident"<?=($student->residence == 'resident') ?  'checked' : ''?> required><label for="radio_resident">Местный</label></p>
            <?=$errors['residence']?>
            <br>
            <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES) ?>">
            <input type="submit" value="Отправить">
        </form>
    </div>
</body>
</html>
