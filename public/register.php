<?php
/**
 * Created by PhpStorm.
 * User: Noname
 * Date: 05.01.2019
 * Time: 16:57
 */
require_once('..\app\db.php');
require_once('..\app\Validator.php');
require_once('..\app\Student.php');
require_once('..\app\StudentsDataGateway.php');

if (empty($_COOKIE['token'] )) {
    $token = bin2hex(openssl_random_pseudo_bytes(32));
    setcookie("token", $token, time()+3600);
} else {
    $token = $_COOKIE['token'];
    setcookie("token", $token, time()+3600);
}


$validator = new Validator();
$student = new Student();
$StudentsDataGateway = new StudentsDataGateway($DB);

if (!empty($_COOKIE['id'])){
    $studentData = $StudentsDataGateway->findById($_COOKIE['id']);
    $student->fillForm($studentData);
}

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
    $errors = $validator->validate($student, $StudentsDataGateway, $_COOKIE['id']);

    if (!$errors) {
        if (!empty($_COOKIE['id'])){
            $StudentsDataGateway->updateStudent($student, $_COOKIE['id']);
            header('Location: http://studentlist.ru/index.php?notify=dataupdate');
            return;
        } else {
            $studentId = $StudentsDataGateway->addStudent($student);
            setcookie("id", $studentId, time()+3600);
            header('Location: http://studentlist.ru/index.php?notify=registered');
            return;
        }
    }
}
//Выводим форму($values, $errors);
include '..\templates\register.php';
