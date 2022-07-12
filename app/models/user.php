<?php

namespace Model;

class User {
    public static function get_hash($password,$salt){
        return hash("sha256",$password.$salt);
    }

    public static function authenticate_cookie($x){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT * FROM cookies where sessionId = ?");
        $statement->execute([$x]);
        $row  = $statement->fetchAll();
        
        return $row;
    }
    public static function is_admin($uname){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT * FROM users where uname = ?");
        $statement->execute([$uname]);
        $row  = $statement->fetchAll();
        return $row[0]['admin'];
    }

    public static function authenticate_user($uname,$password){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT * FROM users where uname = ?");
        $statement->execute([$uname]);
        $row  = $statement->fetchAll();
        if(!isset($row[0])){
            return FALSE;
        }
        if($row[0]['password'] == \Model\User::get_hash($password,$row[0]['salt']) ){
            return TRUE;
        }
        return FALSE;
    }
    public static function user_exists($uname){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT * FROM users where uname = ?");
        $statement->execute([$uname]);
        $row  = $statement->fetchAll();
        if(!isset($row[0])){
            return FALSE;
        }
        return TRUE;
    }

    public static function new_cookie($sessionId,$uname){
        $db = \DB::get_instance();
        $statement = $db->prepare("insert into cookies values(?,?)");
        $statement->execute([$sessionId,$uname]);
    }
    public static function destroy_cookie($sessionId){
        $db = \DB::get_instance();
        $statement = $db->prepare("delete from cookies where sessionId=?");
        $statement->execute([$sessionId]);
    }

    public static function new_user($uname,$salt,$hash){
        $db = \DB::get_instance();
        $statement = $db->prepare("INSERT INTO users VALUES(?,?,?,0)");
        $statement->execute([$uname,$salt,$hash]);
    }

    public static function changePassword($uname,$salt,$hash){
        $db = \DB::get_instance();
        $statement = $db->prepare("update users set salt = ?, password = ? where uname=?");
        $statement->execute([$salt,$hash,$uname]);
    }
}