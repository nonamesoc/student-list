<?php
/**
 * Created by PhpStorm.
 * User: Noname
 * Date: 05.01.2019
 * Time: 16:57
 */
if (empty($_COOKIE['token'] )) {
    $token = bin2hex(openssl_random_pseudo_bytes(32));
    setcookie("token", $token, time()+3600);
} else {
    $token = $_COOKIE['token'];
    setcookie("token", $token, time()+3600);
}

require_once('..\app\Validator.php');
require_once('..\app\Student.php');
$validator = new Validator();
$student = new Student();

//Если (мы редактируем сущность, а не создаем новую) {
//    $values = загруженные из БД значения;
//}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try{
        if (empty($_COOKIE['token']) || $_COOKIE['token']!= $token) {
            throw new Exception('Запрос с другого сайта');
        }
    }
    catch (Exception $e){
        echo 'Ошибка: ' .$e->getMessage();
        exit();
    }
    $student->fillForm($_POST);
//    foreach ($student as $key =>&$val){
//
//    }
    $errors = $validator->validate($student);
//
//    if (!$errors) {
//    Если (мы редактируем сущность) {
//        Обновляем запись в БД;
//        } иначе {
//        Вставляем новую запись в БД;
//        }
//        $postDbGateway->save($post);
//        redirect('/success');
//        return;
//    }
}
//Выводим форму($values, $errors);
include '..\templates\register.php';
