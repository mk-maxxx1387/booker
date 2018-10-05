<?php

class Token 
{
    private $db;

    public function __construct() {
        $this->db = new DB();
    }

    public function createToken($userId) {
        $date = date_create();
        $token = sha1(date_timestamp_get($date).$userId);
        $query = "
            INSERT INTO `booker_tokens` (user_id, token) 
            VALUES (?, ?)
            ";

        $res = $this->db->queryFetch($query, array($userId, $token));
        
        return $token;
    }

    public function getUserIdByToken(){
        $headers = getallheaders();
        $authToken = $headers['Authorization'];
        
        $query = "
            SELECT user_id
            FROM `booker_tokens`
            WHERE token = ?
        ";

        $res = $this->db->queryFetch($query, array($authToken));
        
        if($res){
            return $res['user_id'];
        } else {
            return false;
        }
    }

    public function removeToken()
    {
        $headers = getallheaders();
        $authToken = $headers['Authorization'];

        $query = "
            DELETE FROM `booker_tokens`
            WHERE token = ? 
        ";
        var_dump($this->db);
        $res = $this->db->queryFetch($query, array($authToken));
        return $res;
    }
}
