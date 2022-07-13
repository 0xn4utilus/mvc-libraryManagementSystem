<?php

namespace Controller;

class NewIssue{
    public function post(){
        session_start();
        \Model\Books::newIssue($_POST['isbn'],$_SESSION['uname']);

        echo "Admin will approve your issue request";
    }
}