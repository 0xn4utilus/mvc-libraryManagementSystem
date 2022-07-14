<?php

namespace Controller;

class AddBooks
{
    public static function post()
    {
        session_start();
        if(\Model\User::isAdmin($_SESSION['username'])==0){
            // header('Location: /');
            echo 'hii0';
        }else{

        $target_dir = "static/images/";
        $target_file = $target_dir .time().basename($_FILES["book_cover"]["name"]);
        $upload_ok = 1;
        $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["book_cover"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $upload_ok = 1;
            } else {
                echo "File is not an image.";
                $upload_ok = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $upload_ok = 0;
        }

        // Check file size
        if ($_FILES["book_cover"]["size"] > 1000000) {
            echo "Sorry, your file is too large.";
            $upload_ok = 0;
        }

        // Allow certain file formats
        if (
            $image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"
            && $image_file_type != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $upload_ok = 0;
        }

        // Check if $upload_ok is set to 0 by an error
        if ($upload_ok == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["book_cover"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["book_cover"]["name"])) . " has been uploaded.";

                $img_src = $target_file;
                $isbn = $_POST["isbn"];
                $book_name = $_POST["book_name"];
                $copies = $_POST["copies"];
                $book_description = $_POST["book_description"];
                if (\Controller\Utils::isbnExists($isbn)) {
                    echo "ISBN already exists";
                    unlink($target_file);
                } else {
                    \Model\Books::addBooks($isbn, $book_name, $img_src, $book_description, $copies);
                    echo "adding successfull";
                }

            } else {
                echo "Sorry, there was an error in adding book.";
            }
        }
        }
    }
}

