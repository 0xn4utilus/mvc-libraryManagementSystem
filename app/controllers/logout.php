<?php

namespace Controller;

class LogOut{
    public static function get(){
        $_SESSION = Null;
        \Model\User::destroyCookie($_COOKIE['sessionId']);
        setcookie('sessionId',"",time()-60*60*24*30);
        setcookie('PHPSESSID',"",time()-60*60*24*30);
        session_destroy();
        header('Location: /');
    }
}