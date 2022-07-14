<?php

namespace Controller;

class Admin{
    public function get(){
        session_start();
        if(\Model\User::isAdmin($_SESSION['username'])==0){
            header('Location: /');
        }else{
            echo \View\Loader::make()->render("templates/admin.twig", array(
                "total_books" => \Model\Books::totalBooks(),
                "username" => $_SESSION['username'],
                "approve_requests"=> \Model\Books::approveRequests($_SESSION['username']),
                "approve_returns"=>\Model\Books::approveReturns($_SESSION['username']),
            ));
        }

    }

}