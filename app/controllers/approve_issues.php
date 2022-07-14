<?php

namespace Controller;

class ApproveIssues{
    public function post(){
        session_start();
        if(\Model\User::isAdmin($_SESSION['username'])==0){
            header('Location: /');
        }else{
            \Model\Books::approveIssues($_POST['isbn'],$_POST['username']);
            echo "Approved issue request";
        }

    }
}