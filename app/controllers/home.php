<?php

namespace Controller;

class Home {
    public function get(){
        session_start();
        
        if (isset($_COOKIE["sessionId"])){
            // $_SESSION['username']
            $res = \Model\User::authenticateCookie($_COOKIE["sessionId"]);
            
            if(isset($res[0])){
                $_SESSION['admin'] = \Model\User::isAdmin($res[0]['username']);
                $_SESSION['username']= $res[0]['username'];
            }
        }

        if (isset($_SESSION['username'])){
            header('Location: /user');
        }else{
            echo \View\Loader::make()->render("templates/index.twig", array(
                "total_books" => \Model\Books::totalBooks(),
            ));
        }
        

    }
}