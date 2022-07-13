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
    public static function isAdmin($uname){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT * FROM users where uname = ?");
        $statement->execute([$uname]);
        $row  = $statement->fetchAll();
        return $row[0]['admin'];
    }

    public static function getUser($uname){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT * FROM users where uname = ?");
        $statement->execute([$uname]);
        $rows  = $statement->fetchAll();
        return $rows;
    }

    public static function newCookie($sessionId,$uname){
        $db = \DB::getInstance();
        $statement = $db->prepare("insert into cookies values(?,?)");
        $statement->execute([$sessionId,$uname]);
    }
    public static function destroyCookie($sessionId){
        $db = \DB::getInstance();
        $statement = $db->prepare("delete from cookies where sessionId=?");
        $statement->execute([$sessionId]);
    }

    public static function newUser($uname,$salt,$hash){
        $db = \DB::getInstance();
        $statement = $db->prepare("INSERT INTO users VALUES(?,?,?,0)");
        $statement->execute([$uname,$salt,$hash]);
    }

    public static function changePassword($uname,$salt,$hash){
        $db = \DB::getInstance();
        $statement = $db->prepare("update users set salt = ?, password = ? where uname=?");
        $statement->execute([$salt,$hash,$uname]);
    }
}