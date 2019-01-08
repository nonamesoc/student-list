<?php
/**
 * Created by PhpStorm.
 * User: Avatar
 * Date: 02.01.2019
 * Time: 17:12
 */

class Student
{
    public $name;
    public $surname;
    public $gender;
    public $group;
    public $email;
    public $points;
    public $year;
    public $residence;

    public function __construct( $studentData =[
        'name'=>'',
        'surname'=>'',
        'gender'=>'',
        'group'=>'',
        'email'=>'',
        'points'=>'',
        'year'=>'',
        'residence'=>''])
    {
        $this->fillForm($studentData);
    }

    public function fillForm(array $inputData){

        $allowedData =[
            'name'=>'',
            'surname'=>'',
            'gender'=>'',
            'group'=>'',
            'email'=>'',
            'points'=>'',
            'year'=>'',
            'residence'=>''
        ];

        foreach ($allowedData as $key => $val){
            $this->$key = array_key_exists($key, $inputData) ? trim(strval($inputData[$key])) : $allowedData[$key];
        }
    }
}