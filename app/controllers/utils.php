<?php

namespace Controller;

class Utils{
    public static function authenticate_user($uname,$password){
        $rows = \Model\User::get_user($uname);
        if(!isset($rows[0])){
            return FALSE;
        }
        if($rows[0]['password'] == \Model\User::get_hash($password,$rows[0]['salt']) ){
            return TRUE;
        }
        return FALSE;
    }

    public static function user_exists($uname){
        $rows = \Model\User::get_user($uname);
        if(!isset($rows[0])){
            return FALSE;
        }
        return TRUE;
    }

    public static function isbn_exists($isbn){
        $rows = \Model\Books::get_book_info($isbn);
        if(!isset($rows[0])){
            return FALSE;
        }
        return TRUE;
        
    }

}