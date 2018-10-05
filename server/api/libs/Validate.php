<?php

class Validate{
    public static $error;

    public function validateLogin(){
        self::$error = '';

        $email = $_SERVER['PHP_AUTH_USER'];
        $pwd = $_SERVER['PHP_AUTH_PW'];

        $this->validateEmail($email, "Email");
        $this->validateTextNum($pwd, "Password");

        if(self::$error == ''){
            return array($email, $pwd);
        } else {
            return self::$error;
        }
    }

    public function validateText($text, $fieldName){
        if(!is_null($text) && isset($text)){
            if(preg_match('[A-Za-z0-9]{2,50}', $text)){
                return true;
            }
        } else {
            self::$error = "Wrong $fieldName format. Only latin letters. Lenght between 2 and 65 symbol";
            return false;
        }
    }

    public function validateTextNum($textNum, $fieldName){
        if(!is_null($textNum) && isset($textNum)){
            if(preg_match('/[A-Za-z0-9]/', $textNum)){
                return true;
            }
        }
        self::$error = "Wrong $fieldName format. Only latin letters and numbers. Lenght between 4 and 65 symbol";
        return false;
    }

    public function validateNum($num, $fieldName){
        if(!is_null($num) && isset($num)){
            if(preg_match('[0-9]{1,11}', $num)){
                return true;
            }
        }
        self::$error = "Wrong $fieldName format. Only numbers. Lenght between 1 and 11 symbol";
        return false;
    }

    public function validatePassEqual($pass, $passAgin){
        if($pass === $passAgin){
            return true;
        } else {
            self::$error = "Repeated password isn`t equal.";
            return false;
        }
    }

    public function validateEmail($email, $fieldName)
    {
        if(!is_null($email) && isset($email)){
            if(preg_match("/[-0-9a-zA-Z.+_]+@[-0-9a-zA-Z.+_]+.[a-zA-Z]{2,4}/", $email)){
                return true;
            }
        }
        self::$error = "Wrong $fieldName format. Please enter a right email";
        return false;
    }
}
