<?php

namespace Controller;

class Approvereturns{
    public function post(){
        session_start();

        if(\Model\User::is_admin($_SESSION['uname'])==0){
            header('Location: /');
        }else{
            \Model\Books::approveReturnRequests($_POST['isbn'],$_POST['uname']);
            echo "Approved issue request";
        }

    }
}