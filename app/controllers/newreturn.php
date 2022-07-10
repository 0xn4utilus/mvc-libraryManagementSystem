<?php

namespace Controller;

class Newreturn{
    public function post(){
        session_start();
        \Model\Books::newreturn($_POST['isbn'],$_SESSION['uname']);

        echo "Admin will approve your return request";
    }
}