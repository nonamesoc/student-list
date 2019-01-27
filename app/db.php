<?php
/**
 * Created by PhpStorm.
 * User: Noname
 * Date: 09.01.2019
 * Time: 16:14
 */
$dbconfig = file_get_contents(dirname(__FILE__).'\dbconfig.json');
$dbconfig = json_decode($dbconfig, true);

try {
    $DB = new PDO("mysql:host=$dbconfig[host];dbname=$dbconfig[name]",
        $dbconfig['user'], $dbconfig['password'],
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET sql_mode='STRICT_ALL_TABLES'"));
    $DB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(PDOException $e) {
    echo $e->getMessage();
}
