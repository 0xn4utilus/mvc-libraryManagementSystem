<?php

namespace Controller;

class ApproveReturns{
    public function post(){
        session_start();
        if(\Model\User::isAdmin($_SESSION['uname'])==0){
            header('Location: /');
        }else{
            \Model\Books::approveReturnRequests($_POST['isbn'],$_POST['uname']);
            echo "Approved return request";
        }

    }
}