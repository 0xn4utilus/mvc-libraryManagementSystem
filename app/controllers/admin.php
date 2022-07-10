<?php

namespace Controller;

class Admin{
    public function get(){
        session_start();
        if(\Model\User::is_admin($_SESSION['uname'])==0){
            header('Location: /');
        }else{
            echo \View\Loader::make()->render("templates/admin.twig", array(
                "totalbooks" => \Model\Books::total_books(),
                "uname" => $_SESSION['uname'],
                "approverequests"=> \Model\Books::approverequests($_SESSION['uname']),
                "approvereturns"=>\Model\Books::approvereturns($_SESSION['uname']),
            ));
        }

    }

}