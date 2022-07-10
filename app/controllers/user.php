<?php

namespace Controller;


class User{
    public static function get(){
        session_start();
        if (!isset($_SESSION['uname'])){
            header('Location: /');
        }elseif ($_SESSION['admin']==1){
            header('Location: /admin');
        }else{
            echo \View\Loader::make()->render("templates/user.twig", array(
                "totalbooks" => \Model\Books::total_books(),
                "uname" => $_SESSION['uname'],
                "issuedbooks"=> \Model\Books::issuedbooks($_SESSION['uname']),
                "newissuebooks"=>\Model\Books::newissuebooks($_SESSION['uname']),
            ));
        }
    }
}