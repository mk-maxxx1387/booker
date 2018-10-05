<?php

class Controller_Login {
    private $model;

    public function __construct() {
        $this->model = new Model_User();
    }

    public function putLogin(){
        $validate = new Validate();
        $result = $validate->validateLogin();

        if(is_string($result)){
            return array("code" => 400, "data" => $result);
        } else {
            return $this->model->login($result);
        }
    }

    public function deleteLogin(){
        $res = Token::removeToken();
        
        if($res){
            return array("code" => 200, "data" => array("message" => "Logout successful"));
        } else {
            return array("code" => 401, "data" => "Token not found. Please, login");
        }
    }
}
