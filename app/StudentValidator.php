<?php
/**
 * Created by PhpStorm.
 * User: Avatar
 * Date: 02.01.2019
 * Time: 17:31
 */

class StudentValidator
{

    public function validate($values, $StudentsDataGateway, $studentId = null){
        $errors = [];
        foreach ($values as $key => $val){
            if(empty($val)){
                $errors[$key] = 'Заполните поле';
                continue;
            }
            if($key == 'name'){
                (!preg_match('/^.{2,}$/u',$val)) ? $errors[$key] = 'Имя не должно быть меньше 2 символов ' : null;
                (!preg_match('/^.{0,15}$/u',$val)) ? $errors[$key] .= 'Имя не должно быть длиннее 15 символов ' : null;
                (!preg_match('/^[а-яА-Я]*$/u',$val)) ? $errors[$key] .= 'Имя должно состоять из русских букв ' : null;
                continue;
            }
            if($key == 'surname'){
                (!preg_match('/^.{0,25}$/u',$val)) ? $errors[$key] = 'Фамилия не должна быть длиннее 25 символов ' : null;
                (!preg_match('/^[а-яА-Я\W]*$/u',$val)) ? $errors[$key] .= 'Фамилия должна состоять из русских букв ': null;
                (!preg_match('/^[a-zа-я\s\'\-]*$/ui',$val)) ? $errors[$key] .= 'Имя может содержать только буквы, пробелы, дефис, апостроф ': null;
                continue;
            }
            if($key == 'gender'){
                (!preg_match('/^(male)|(female)$/ui',$val)) ? $errors[$key] = 'Недопустимые данные': null;
                continue;
            }
            if($key == 'group_number'){
                (!preg_match('/^.{2,}$/ui',$val)) ? $errors[$key] .= 'Номер группы не должен быть короче 2 символов ': null;
                (!preg_match('/^.{0,5}$/ui',$val)) ? $errors[$key] .= 'Номер группы не должен быть длинее 5 символов ': null;
                (!preg_match('/^[а-яА-Я\W\d]{0,5}$/ui',$val)) ? $errors[$key] .= 'В номере группы можно использовать только русские ': null;
                (!preg_match('/^\w*$/ui',$val)) ? $errors[$key] .= 'В номере группы можно использовать только буквы и цифры ': null;
                continue;
            }
            if($key == 'email'){
                (!filter_var($val,FILTER_VALIDATE_EMAIL)) ? $errors[$key] = 'Некорректный email' : null;
                if( $studentId != null){
                    $currentEmail = $StudentsDataGateway->issetEmailById($studentId);
                    if ($currentEmail['email'] == $val){
                        continue;
                    }
                }
                (!empty($StudentsDataGateway->issetEmail($val))) ? $errors[$key] .= 'Этот email уже занят' : null;
                continue;
            }
            if($key == 'points'){
                ($val > 400) ? $errors[$key] = 'Слишком большое число ': null;
                ($val < 100) ? $errors[$key] = 'Недостаточно баллов ': null;
                (!preg_match('/^\d*$/',$val)) ? $errors[$key] = 'Допустимы только числа ': null;
                continue;
            }
            if($key == 'birth_date '){
                $currentDate = getdate();
                $maxYear = $currentDate['year']-18;
                $maxDate = "$maxYear-$currentDate[mon]-$currentDate[mday]";
                (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/',$val)) ? $errors[$key] = 'Недопустимый формат': null;
                (strtotime($val)>strtotime($maxDate)) ? $errors[$key] .= 'Недопустимый возраст ': null;
                continue;
            }
            if($key == 'residence'){
                (!preg_match('/^(resident)|(nonresident)$/ui',$val)) ? $errors[$key] = 'Недопустимые данные': null;
                continue;
            }
        }

        return $errors;
    }
}