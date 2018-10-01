<?php

class Controller_User {

    private $model;

    public function __construct() {
        $this->model = new Model_User();
    }

    public function getUser($param = false)
    {
        if($param){
            return $this->model->getAllUsers();
        } else {
            return $this->model->getUserById($param);
        }
    }

    public function postUser()
    {
        $validate = new Validate();
        $result = $validate->validateNewUser();
        if(is_string($result)){
            return array("code" => 400, "data" => $result);
        } else {
            return $this->model->login($result);
        }
    }

    public function putUser()
    {
        $validate = new Validate();
        $result = $validate->validateNewUser();
        if(is_string($result)){
            return array("code" => 400, "data" => $result);
        } else {
            return $this->model->login($result);
        }
    }
    
    public function deleteUser($id)
    {
        return $this->model->deleteUser($id);
    }
}
