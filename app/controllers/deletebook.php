<?php

namespace Controller;

class Deletebook{
    public function post(){
        session_start();
        
        
        if(\Model\User::is_admin($_SESSION['uname'])==0){
            header('Location: /');
        }else{
            $isbn = $_POST['isbn'];
            \Model\Books::delete($isbn);
            echo "Deletion Successful";
        }
    }
}