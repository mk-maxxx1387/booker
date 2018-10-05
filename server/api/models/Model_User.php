<?php

class Model_User {
    private $db;
    private $token;

    public function __construct() {
        $this->db = new DB();
        $this->token = new Token();
    }

    public function getAllUsers()
    {
        $users = array();

        $query = "
            SELECT id, username, email, is_admin 
            FROM booker_users
        ";

        $result = $this->db->queryFetchAll($query, null);

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

    public function getUserById($id)
    {
        $data = array($id);
        $query = "
            SELECT id, username, email 
            FROM booker_user 
            WHERE id = ?
        ";

        $result = $this->db->queryFetch($query, $data);

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

        $query = "
            INSERT INTO booker_users (id, username, email, password, is_admin, is_active)
            VALUES (?,?,?,?,?,?)
        ";

        $this->db->queryFetch($query, $data);
    }

    public function editUser($user)
    {
        $data = $user;

        $query = "
            UPDATE booker_users 
            SET name = ?, email = ? 
            WHERE id =? 
        ";

        $this->db->queryFetch($query, $data);
    }

    public function deleteUser($id)
    {
        $data = array($id);

        $query = "
            DELETE FROM employees 
            WHERE id = ?
        ";

        $this->db->queryFetch($query, $data);
    }

    public function login($data)
    {
        $query = "
            SELECT id, username, email, password 
            FROM booker_users
            WHERE email = ?
            AND password = ?
        ";
        $res = $this->db->queryFetch($query, $data);
        if(!$res){
            return array("code" => 401, "data" => "Wrong login or password");
        } else {
            $token = $this->token->createToken($res['id']);
            return array("code" => 200, "data" => array(
                "token" => $token,
                "email" => $res['email'],
                "username" => $res['username']
                )
            );
        }
    }
    public function logout(Type $var = null)
    {
        $res = $this->token->removeToken();
        if($res){
            return array("code" => 200, "data" => array("message" => "Logout successful"));
        } else {
            return array("code" => 401, "data" => "Token not found. Please, login");
        }
    }
}
