<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/login" => "\Controller\Login",
    "/changePassword" => "\Controller\ChangePassword",
    "/logout" => "\Controller\Logout",
    "/user" => "\Controller\User",
    "/admin" => "\Controller\Admin",
    "/register" => "\Controller\Register",
    "/addbooks" => "\Controller\Addbooks",
    "/editbook" => "\Controller\Editbook",
    "/deletebook" => "\Controller\Deletebook",
    "/newissue" => "\Controller\Newissue",
    "/approveissues" => "\Controller\Approveissues",
    "/newreturn" => "\Controller\Newreturn",
    "/approvereturns" => "\Controller\Approvereturns",
));
