<?php

namespace Controller;

class ChangePassword{
 public static function get(){
    $currPass =$_POST['currPass'];
    $newPass = $_POST['newPass'];
    $newPassC =$_POST['newPassC'];
    if(!(isset($_POST['currPass']) && isset($_POST['newPass']) && isset($_POST['newPassC']) )){ 
        echo "All fields are required";
        return;
    }elseif($newPassC!= $newPass){
        echo "Passwords doesn't match";
        return;
    }elseif(!\Model\User::authenticate_user($_SESSION['uname'],$currPass)){
        echo "Incorrect Password!";
    }else{
        $salt = bin2hex(random_bytes(4));
        $hash= hash("sha256",$newPass.$salt);
        $hash= \Model\User::get_hash($newPass,$salt);
        \Model\User::changePassword($_SESSION['uname'],$salt,$hash);
        echo "Password Changed successfully.";
    }
 }
}