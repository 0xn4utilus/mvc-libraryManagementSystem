<?php

namespace Controller;

class DeleteBook{
    public function post(){
        session_start();
        
        
        if(\Model\User::isAdmin($_SESSION['username'])==0){
            header('Location: /');
        }else{
            $isbn = $_POST['isbn'];
            \Model\Books::delete($isbn);
            echo "Deletion Successful";
        }
    }
}