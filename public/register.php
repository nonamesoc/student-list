<?php
/**
 * Created by PhpStorm.
 * User: Noname
 * Date: 05.01.2019
 * Time: 16:57
 */
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Database/db.php';
//use StudentList\Database\db;
use StudentList\Entities\Student;
use StudentList\Validation\StudentValidator;
use StudentList\Database\StudentsDataGateway;

if (empty($_COOKIE['token'] )) {
    $token = bin2hex(openssl_random_pseudo_bytes(32));
    setcookie("token", $token, time()+ 60*60*60,'/');
} else {
    $token = $_COOKIE['token'];
    setcookie("token", $token, time()+ 60*60*60,'/');
}


$validator = new StudentValidator();
$student = new Student();
$StudentsDataGateway = new StudentsDataGateway($db);

if ( !empty($_COOKIE['login']) && !empty($_COOKIE['password'])  ){

    $studentData = $StudentsDataGateway->findByEmail($_COOKIE['login']);

    if($studentData['password'] == $_COOKIE['password']){
        $student->fillForm($studentData);
    }
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try{
        if (empty($_POST['token']) || $_POST['token'] != $token ) {
            throw new Exception('Запрос с другого сайта');
        }
    }
    catch (Exception $e){
        echo 'Ошибка: ' .$e->getMessage();
        exit();
    }
    $student->fillForm($_POST);
    $errors = $validator->validate($student, $StudentsDataGateway, $_COOKIE['login']);

    if (!$errors) {

        if (!empty($_COOKIE['login'])){
            $StudentsDataGateway->updateStudent($student, $_COOKIE['login']);
            header('Location: /index.php?notify=dataupdate');
            return;
        } else {
            $student->password = generatePassword();
            setcookie('password', $student->password, time()+ 60*60*60*24*365, '/');
            setcookie('login', $student->email, time()+ 60*60*60*24*365, '/');
            $StudentsDataGateway->addStudent($student);
            header("Location: /index.php?notify=registered");
            return;
        }
    }
}

function generatePassword($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

include '..\templates\register.php';
