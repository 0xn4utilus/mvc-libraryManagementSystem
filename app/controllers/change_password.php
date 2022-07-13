<?php

namespace Controller;

class ChangePassword{
 public static function post(){
    session_start();
    $current_password =$_POST['current_password'];
    $new_password = $_POST['new_password'];
    $new_password_confirm =$_POST['new_password_confirm'];
    if(!(isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['new_password_confirm']) )){ 
        echo "All fields are required";
        return;
    }elseif($new_password_confirm!= $new_password){
        echo "Passwords doesn't match";
        return;
    }elseif(!\Controller\Utils::authenticateUser($_SESSION['uname'],$current_password)){
        echo "Incorrect Password!";
    }else{
        $salt = bin2hex(random_bytes(4));
        $hash= hash("sha256",$new_password.$salt);
        $hash= \Model\User::getHash($new_password,$salt);
        \Model\User::changePassword($_SESSION['uname'],$salt,$hash);
        echo "Password Changed successfully.";
    }
 }
}