<?php

namespace Controller;

class Addbooks
{
    public static function post()
    {

        if(\Model\User::is_admin($_SESSION['uname'])==0){
            header('Location: /');
        }else{

        $target_dir = "static/images/";
        $target_file = $target_dir .time().basename($_FILES["bookcover"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if (isset($_POST["submit"])) {
            $check = getimagesize($_FILES["bookcover"]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["bookcover"]["size"] > 1000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["bookcover"]["tmp_name"], $target_file)) {
                echo "The file " . htmlspecialchars(basename($_FILES["bookcover"]["name"])) . " has been uploaded.";

                $imgsrc = $target_file;
                $isbn = $_POST["isbn"];
                $bookname = $_POST["bookname"];
                $copies = $_POST["copies"];
                $bookdescription = $_POST["bookdescription"];
                if (\Model\Books::isbn_exists($isbn)) {
                    echo "ISBN already exists";
                    unlink($target_file);
                } else {
                    \Model\Books::addbooks($isbn, $bookname, $imgsrc, $bookdescription, $copies);
                    echo "adding successfull";
                }

            } else {
                echo "Sorry, there was an error in adding book.";
            }
        }
        }
    }
}

// $isbn,$bookname,$imgsrc,$bookdescription,$copies