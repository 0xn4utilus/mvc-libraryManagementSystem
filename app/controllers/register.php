<?php

namespace Controller;

class Register{
    public static function get(){
        session_start();
        header('Location: /');
    }
    public static function post(){
        session_start();
        if(!(isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['passwordC']) )){ 
            echo "All fields are required";
            return;
        }else{
            $name = $_POST['uname'];
            $password = $_POST['password'];
            $passwordC = $_POST['passwordC'];
            $salt = bin2hex(random_bytes(4));
            $hash= hash("sha256",$password.$salt);
            
        }
        
        if($password!=$passwordC){
            echo "Passwords didn't match";
            return;
        }elseif(!\Model\User::user_exists($name)){
            \Model\User::new_user($name,$salt,$hash);
            $_SESSION['uname'] = $_POST['uname'];
            $_SESSION['admin'] = \Model\User::is_admin($_POST['uname']);
            $sessionId = base64_encode(random_bytes(16));
            setcookie('sessionId',$sessionId,time()+60*60*24*30);
            \Model\User::new_cookie($sessionId,$_POST['uname']);
            header('Location: /user');
        }else{
            echo "Username is not unique";
        }

    }
}