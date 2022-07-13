<?php

namespace Controller;

class NewReturn{
    public function post(){
        session_start();
        \Model\Books::newReturn($_POST['isbn'],$_SESSION['uname']);

        echo "Admin will approve your return request";
    }
}