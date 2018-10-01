<?php

class Model_User {
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function getUserById($id)
    {
        $data = array($id);
        $sql = "
            SELECT id, username, email 
            FROM booker_user 
            WHERE id = ?
        ";

        $result = $this->db->queryFetch($sql, $data);

        if ($result){
            $user = array();
            $user['id'] = $result['id'];
            $user['username'] = $result['username'];
            $user['email'] = $result['email'];

            return $user;
        }
    }

    public function addNewUser($user){
        $data = $user;

        $sql = "
            INSERT INTO booker_users (id, username, email, password, is_admin, is_active)
            VALUES (?,?,?,?,?,?)
        ";

        $this->db->queryFetch($sql, $data);
    }

    public function editUser(){
        $data = array(
            $employee->name
            , $employee->email
            , $employee->id
        );
        var_dump($employee->name);

        $sql = "
            UPDATE employees 
            SET username = ?, email = ? 
            WHERE id = ?
        ";

        $this->db->queryFetch($sql, $data);
    }
    public function deactivateUser()
    {
        # code...
    }
    public function login($data)
    {
        $sql = "
            SELECT id, username, email, password 
            FROM booker_users
            WHERE email = ?
            AND password = ?
        ";
        $res = $this->db->queryFetch($query, $result);
        if(!$res){
            return array("code" => 401, "data" => "Wrong login or password");
        } else {
            $token = Token::createToken($res['id']);
            return array("code" => 200, "data" => array("token" => $token, "login" => $res['login']));
        }
    }
    public function logout(Type $var = null)
    {
        # code...
    }

    

    public function getAllUsers()
    {
        $users = array();

        $sql = "
            SELECT id, username, email, is_admin 
            FROM booker_users
        ";

        $result = $this->db->queryFetchAll($sql);

        if ($result)
        {
            foreach ($result as $res)
            {
                $user = array();
                $user['id'] = $result['id'];
                $user['username'] = $result['username'];
                $user['email'] = $result['email'];

                $users[] = $user;
            }

            return $this->employees;
        }
    }

    public function editUser($user)
    {
        $data = $user;

        $sql = "
            UPDATE booker_users 
            SET name = ?, email = ? 
            WHERE id =? 
        ";

        $this->db->queryFetch($sql, $data);
    }

    public function deleteUser($id)
    {
        $data = array($id);

        $sql = "
            DELETE FROM employees 
            WHERE id = ?
        ";

        $this->db->queryFetch($sql, $data);
    }
}
