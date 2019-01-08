<?php
/**
 * Created by PhpStorm.
 * User: Avatar
 * Date: 02.01.2019
 * Time: 17:31
 */

class Validator
{
    public function validate($values){
        $errors = [];
        foreach ($values as $key=>$val){
//            if($key == 'name'){
//                $errors[$key] = (!preg_match('/^[А-Я]{1}[а-я]{0,29}$/u',$val) ? '');
//
//            }
        }
        $errors = true;
        return $errors;
    }
}