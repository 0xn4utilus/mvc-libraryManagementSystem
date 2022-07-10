<?php

namespace Model;

class User {
    public static function authenticate_cookie($x){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM cookies where sessionId = ?");
        $stmt->execute([$x]);
        $row  = $stmt->fetchAll();
        
        return $row;
    }
    public static function is_admin($uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users where uname = ?");
        $stmt->execute([$uname]);
        $row  = $stmt->fetchAll();
        return $row[0]['admin'];
    }

    public static function authenticate_user($uname,$password){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users where uname = ?");
        $stmt->execute([$uname]);
        $row  = $stmt->fetchAll();
        
        print_r(hash("sha256",$password.$row[0]['salt']));
        if(!isset($row[0])){
            return FALSE;
        }
        if($row[0]['password'] == hash("sha256",$password.$row[0]['salt']) ){
            return TRUE;
        }
        return FALSE;
    }
    public static function user_exists($uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM users where uname = ?");
        $stmt->execute([$uname]);
        $row  = $stmt->fetchAll();
        if(!isset($row[0])){
            return FALSE;
        }
        return TRUE;
    }

    public static function new_cookie($sessionId,$uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("insert into cookies values(?,?)");
        $stmt->execute([$sessionId,$uname]);
    }
    public static function destroy_cookie($sessionId){
        $db = \DB::get_instance();
        $stmt = $db->prepare("delete from cookies where sessionId=?");
        $stmt->execute([$sessionId]);
    }

    public static function new_user($uname,$salt,$hash){
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO users VALUES(?,?,?,0)");
        $stmt->execute([$uname,$salt,$hash]);
    }

    public static function changePassword($uname,$salt,$hash){
        $db = \DB::get_instance();
        $stmt = $db->prepare("update users set salt = ?, password = ? where uname=?");
        $stmt->execute([$salt,$hash,$uname]);
    }
}