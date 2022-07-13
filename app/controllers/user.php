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
                "total_books" => \Model\Books::totalBooks(),
                "uname" => $_SESSION['uname'],
                "issued_books"=> \Model\Books::issuedBooks($_SESSION['uname']),
                "new_issue_books"=>\Model\Books::newIssueBooks($_SESSION['uname']),
            ));
        }
    }
}