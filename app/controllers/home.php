<?php

namespace Controller;

class Home {
    public function get(){
        session_start();
        
        if (isset($_COOKIE["sessionId"])){
            // $_SESSION['uname']
            $res = \Model\User::authenticateCookie($_COOKIE["sessionId"]);
            
            if(isset($res[0])){
                $_SESSION['admin'] = \Model\User::isAdmin($res[0]['uname']);
                $_SESSION['uname']= $res[0]['uname'];
            }
        }

        if (isset($_SESSION['uname'])){
            header('Location: /user');
        }else{
            echo \View\Loader::make()->render("templates/index.twig", array(
                "total_books" => \Model\Books::totalBooks(),
            ));
        }
        

    }
}