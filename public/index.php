<?php
/**
 * Created by PhpStorm.
 * User: Avatar
 * Date: 03.01.2019
 * Time: 18:27
 */
if($_REQUEST['notify']=='registered'){
    echo 'Вы успешно зарегистрированы.';
}



// require the Faker autoloader
//require_once('../vendor/autoload.php');
require_once('..\app\db.php');
require_once('..\app\StudentsDataGateway.php');
//require_once('..\app\Student.php');
$StudentsDataGateway = new StudentsDataGateway($DB);

// use the factory to create a Faker\Generator instance
/*$faker = Faker\Factory::create('ru_RU');
$StudentsDataGateway = new StudentsDataGateway($DB);
$values = [];


for ($i = 0;$i<60;$i++) {
    $values['name'] = $faker->firstName;
    $values['surname'] = $faker->lastName;
    $values['group_number'] = $faker->bothify('???##');
    $values['gender'] = ($faker->boolean) ? 'male' : 'female';
    $values['email'] = $faker->email;
    $values['points'] = $faker->numberBetween($min = 100, $max = 400);
    $values['birth_date'] = $faker->dateTimeBetween($startDate = '-20 years', $endDate = '2001-01-22', $timezone = null)->format('Y-m-d');
    $values['residence'] = ($faker->boolean) ? 'resident' : 'nonresident';
    $student = new Student();
    $student->fillForm($values);
    $StudentsDataGateway->addStudent($student);
}
function spacer() {
    echo '<br />';
}*/
$studentList = [];

if(isset($_REQUEST['page']) && $_REQUEST['page']>0){
    $studentList = $StudentsDataGateway->getStudentList($_REQUEST['page']);
} else{
    $studentList = $StudentsDataGateway->getStudentList(1);
}

$pages = 0;
if($StudentsDataGateway->count()>50){
    $pages = ceil($StudentsDataGateway->count()/50);
}

include '..\templates\studentlist.php';