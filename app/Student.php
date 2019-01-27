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
    public $group_number;
    public $email;
    public $points;
    public $birth_date;
    public $residence;

    public function __construct( $studentData =[
        'name'=>'',
        'surname'=>'',
        'gender'=>'',
        'group_number'=>'',
        'email'=>'',
        'points'=>'',
        'birth_date'=>'',
        'residence'=>''])
    {
        $this->fillForm($studentData);
    }

    public function fillForm(array $inputData){

        $allowedData =[
            'name'=>'',
            'surname'=>'',
            'gender'=>'',
            'group_number'=>'',
            'email'=>'',
            'points'=>'',
            'birth_date'=>'',
            'residence'=>''
        ];

        foreach ($allowedData as $key => $val){
            $this->$key = array_key_exists($key, $inputData) ? trim(strval($inputData[$key])) : $allowedData[$key];
        }
    }
}