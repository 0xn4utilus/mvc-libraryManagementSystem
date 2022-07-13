<?php

namespace Controller;

class CheckAdmin{
    public static function checkAdmin(){
        session_start();
        if ($_SESSION['admin']==1){
            return TRUE;                       
        }
        return FALSE;
    }
}