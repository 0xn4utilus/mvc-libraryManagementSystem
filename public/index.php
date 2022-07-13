<?php

require __DIR__."/../vendor/autoload.php";

Toro::serve(array(
    "/" => "\Controller\Home",
    "/login" => "\Controller\Login",
    "/changePassword" => "\Controller\ChangePassword",
    "/logout" => "\Controller\LogOut",
    "/user" => "\Controller\User",
    "/admin" => "\Controller\Admin",
    "/register" => "\Controller\Register",
    "/addbooks" => "\Controller\AddBooks",
    "/editbook" => "\Controller\EditBook",
    "/deletebook" => "\Controller\DeleteBook",
    "/newissue" => "\Controller\NewIssue",
    "/approveissues" => "\Controller\ApproveIssues",
    "/newreturn" => "\Controller\NewReturn",
    "/approvereturns" => "\Controller\ApproveReturns",
));
