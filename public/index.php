<?php
/**
 * Created by PhpStorm.
 * User: Avatar
 * Date: 03.01.2019
 * Time: 18:27
 */
error_reporting(-1);
if($_REQUEST['notify']=='registered'){
    echo 'Вы успешно зарегистрированы.';
}
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/Database/db.php';
//use StudentList\Database\db;
use StudentList\Entities\Student;
use StudentList\Database\StudentsDataGateway;
use StudentList\Helper\Pager;
use StudentList\Helper\Linker;

$StudentsDataGateway = new StudentsDataGateway($db);
$studentList = [];

$page = array_key_exists('page',$_REQUEST) && $_REQUEST['page']>0 ?
    $_REQUEST['page'] : 1;

if (array_key_exists('sort',$_REQUEST)) {
    $preparedSort = explode(',',$_REQUEST['sort']);
    foreach ($preparedSort as $val){
        ($val == 'asc' || $val == 'desc') ?
            $sort['type'] = $val : $sort['column'] = $val;
    }

} else{
    $sort = null;
}
if( isset($_REQUEST['search']) && !empty($_REQUEST['search']) ) {
    $studentList = $StudentsDataGateway->find($_REQUEST['search'], $sort, $page);
    $totalRecords = $StudentsDataGateway->count($_REQUEST['search']);
}
else {
    $studentList = $StudentsDataGateway->getStudentList($sort, $page);
    $totalRecords = $StudentsDataGateway->count();
}

$pager = new Pager($totalRecords, 50);
$linker = new Linker();

include '..\templates\studentlist.php';