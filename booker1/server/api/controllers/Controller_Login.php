<?php

class Controller_Login {
    private $model;

    public function __construct() {
        $this->model = new Model_Login();
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
        $this->model->logout();
    }
}
