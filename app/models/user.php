<?php

namespace Model;

class User {
    public static function getHash($password,$salt){
        return hash("sha256",$password.$salt);
    }

    public static function authenticateCookie($x){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT * FROM cookies where sessionId = ?");
        $statement->execute([$x]);
        $row  = $statement->fetchAll();
        
        return $row;
    }
    public static function isAdmin($username){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT * FROM users where username = ?");
        $statement->execute([$username]);
        $row  = $statement->fetchAll();
        return $row[0]['admin'];
    }

    public static function getUser($username){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT * FROM users where username = ?");
        $statement->execute([$username]);
        $rows  = $statement->fetchAll();
        return $rows;
    }

    public static function newCookie($sessionId,$username){
        $db = \DB::getInstance();
        $statement = $db->prepare("insert into cookies values(?,?)");
        $statement->execute([$sessionId,$username]);
    }
    public static function destroyCookie($sessionId){
        $db = \DB::getInstance();
        $statement = $db->prepare("delete from cookies where sessionId=?");
        $statement->execute([$sessionId]);
    }

    public static function newUser($username,$salt,$hash){
        $db = \DB::getInstance();
        $statement = $db->prepare("INSERT INTO users VALUES(?,?,?,0)");
        $statement->execute([$username,$salt,$hash]);
    }

    public static function changePassword($username,$salt,$hash){
        $db = \DB::getInstance();
        $statement = $db->prepare("update users set salt = ?, password = ? where username=?");
        $statement->execute([$salt,$hash,$username]);
    }
}