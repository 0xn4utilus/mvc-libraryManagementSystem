<?php

namespace Controller;

class Register{
    public static function get(){
        session_start();
        header('Location: /');
    }
    public static function post(){
        session_start();
        if(!(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['passwordC']) )){ 
            echo "All fields are required";
            return;
        }else{
            $name = $_POST['username'];
            $password = $_POST['password'];
            $passwordC = $_POST['passwordC'];
            $salt = bin2hex(random_bytes(4));
            $hash= \Model\User::getHash($password,$salt);
            
        }
        
        if($password!=$passwordC){
            echo "Passwords didn't match";
            return;
        }elseif(!\Controller\Utils::userExists($name)){
            \Model\User::newUser($name,$salt,$hash);
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['admin'] = \Model\User::isAdmin($_POST['username']);
            $sessionId = base64_encode(random_bytes(16));
            setcookie('sessionId',$sessionId,time()+60*60*24*30);
            \Model\User::newCookie($sessionId,$_POST['username']);
            header('Location: /user');
        }else{
            echo "Username is not unique";
        }

    }
}