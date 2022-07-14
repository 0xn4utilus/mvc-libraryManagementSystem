<?php

namespace Controller;

class Login {
    public function post(){
        session_start();
        echo $_POST['username'],$_POST['password'];

        if(!isset($_POST['username']) && !isset($_POST['password'])){
            echo 'All fields are required';
        }elseif(\Controller\Utils::authenticateUser($_POST['username'],$_POST['password'])){
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['admin'] = \Model\User::isAdmin($_POST['username']);
            $sessionId = base64_encode(random_bytes(16));
            setcookie('sessionId',$sessionId,time()+60*60*24*30);
            \Model\User::newCookie($sessionId,$_POST['username']);
            header('Location: /user');
        }else{
            echo 'Either user does not exist or user and password do not match';
        }


    }
}