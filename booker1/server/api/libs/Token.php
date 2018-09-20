<?php

class Token 
{
    public static function createToken($userId) {
        $db = RESTServer::getDBConn();
        $date = date_create();
        $token = sha1(date_timestamp_get($date).$userId);
        $query = "
            INSERT INTO `booker_tokens` (user_id, token) 
            VALUES (?, ?)
            ";
        $db->query($query, array($userId, $token));
        return $token;
    }

    public static function getUserIdByToken(){
        $db = RESTServer::getDBConn();
        $headers = getallheaders();
        $authToken = $headers['Authorization'];
        
        $query = "
            SELECT user_id
            FROM `booker_tokens`
            WHERE token = ?";
        $res = $db->query($query, array($authToken));
        
        if($res){
            return $res['user_id'];
        } else {
            return false;
        }
    }

    public static function removeToken()
    {
        $db = RESTServer::getDBConn();
        $headers = getallheaders();
        $authToken = $headers['Authorization'];
        var_dump($authToken);
        $query = "
            DELETE FROM `booker_tokens`
            WHERE token = ? 
        ";
        $res = $db->query($query, array($authToken));
        return $res;
    }
}
