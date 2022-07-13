<?php

namespace Controller;

class Login {
    public function post(){
        session_start();
        echo $_POST['uname'],$_POST['password'];

        if(!isset($_POST['uname']) && !isset($_POST['password'])){
            echo 'All fields are required';
        }elseif(\Controller\Utils::authenticateUser($_POST['uname'],$_POST['password'])){
            $_SESSION['uname'] = $_POST['uname'];
            $_SESSION['admin'] = \Model\User::isAdmin($_POST['uname']);
            $sessionId = base64_encode(random_bytes(16));
            setcookie('sessionId',$sessionId,time()+60*60*24*30);
            \Model\User::newCookie($sessionId,$_POST['uname']);
            header('Location: /user');
        }else{
            echo 'Either user does not exist or user and password do not match';
        }


    }
}