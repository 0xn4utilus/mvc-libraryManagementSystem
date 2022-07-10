<?php

namespace Controller;

class Newissue{
    public function post(){
        session_start();
        \Model\Books::newissue($_POST['isbn'],$_SESSION['uname']);

        echo "Admin will approve your issue request";
    }
}