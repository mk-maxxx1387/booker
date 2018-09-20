<?php

class Model_User {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function addNewUser(){}
    public function editUser()
    {
        # code...
    }
    public function deactivateUser()
    {
        # code...
    }
    public function loginUser(Type $var = null)
    {
        # code...
    }
    public function logoutUser(Type $var = null)
    {
        # code...
    }
}
