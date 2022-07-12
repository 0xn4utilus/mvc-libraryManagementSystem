<?php

namespace Model;

class Books{
    public static function total_books(){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT * FROM books");
        $statement->execute();
        $rows  = $statement->fetchAll();
        return $rows;
    }
    public static function issuedbooks($uname){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT books.* from books left join issuedbooks on issuedbooks.isbn = books.isbn and issuedbooks.uname = ? where issuedbooks.isbn is not null");
        $statement->execute([$uname]);
        $rows  = $statement->fetchAll();
        return $rows;
    }
    public static function newissuebooks($uname){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT books.* from books left join issuedbooks on issuedbooks.isbn = books.isbn and issuedbooks.uname = ? where issuedbooks.isbn is null and books.copies >0");
        $statement->execute([$uname]);
        $rows  = $statement->fetchAll();
        return $rows;
    }
    public static function approverequests(){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT books.*, requests.uname from books left join requests on books.isbn = requests.isbn and requests.status = 'issue' where requests.uname is not null;");
        $statement->execute();
        $rows  = $statement->fetchAll();
        return $rows;
    }

    public static function approvereturns(){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT books.*, requests.uname from books left join requests on books.isbn = requests.isbn and requests.status = 'return' where requests.uname is not null");
        $statement->execute();
        $rows  = $statement->fetchAll();
        return $rows;
    }

    public static function isbn_exists($isbn){
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT * from books where isbn = ?");
        $statement->execute([$isbn]);
        $rows  = $statement->fetchAll();
        if(isset($rows[0])){
            return TRUE;
        }
        return FALSE;
    }

    public static function addbooks($isbn,$bookname,$imgsrc,$bookdescription,$copies){
        $db = \DB::get_instance();
        $statement = $db->prepare("insert into books values (?,?,?,?,?)");
        $statement->execute([$isbn,$bookname,$imgsrc,$bookdescription,$copies]);
    }

    public static function delete($isbn){
        $db = \DB::get_instance();
        $statement = $db->prepare("delete from books where isbn=?");
        $statement->execute([$isbn]);
    }

    public static function newissue($isbn,$uname){
        $db = \DB::get_instance();
        $statement = $db->prepare("insert into requests values(?,?,'issue')");
        $statement->execute([$isbn,$uname]);
    }
    public static function newreturn($isbn,$uname){
        $db = \DB::get_instance();
        $statement = $db->prepare("insert into requests values(?,?,'return')");
        $statement->execute([$isbn,$uname]);
    }

    public static function approveissues($isbn,$uname){
        $db = \DB::get_instance();
        $statement = $db->prepare("INSERT into issuedbooks values (?,?);update books set copies=copies-1 where isbn=?;delete from requests where status = 'issue' and isbn=? and uname=?");
        $statement->execute([$isbn,$uname,$isbn,$isbn,$uname]);

    }
    public static function approveReturnRequests($isbn,$uname){
        $db = \DB::get_instance();
        $statement = $db->prepare("delete from requests where status='return' and isbn=? and uname=?;update books set copies=copies+1 where isbn=?;delete from issuedbooks where isbn=? and uname=?");
        $statement->execute([$isbn,$uname,$isbn,$isbn,$uname]);

    }

    public static function editbook($isbn,$bookname,$imgsrc,$bookdescription,$copies){
        $db = \DB::get_instance();
        if($imgsrc!=Null){
            $statement = $db->prepare("update books set bookname= ?, bookcoverpath=?, bookdescription=?, copies=? where isbn =? ");
            $statement->execute([$bookname,$imgsrc,$bookdescription,$copies,$isbn]);
        }else{
            $statement = $db->prepare("update books set bookname= ?, bookdescription=?, copies=? where isbn =? ");
            $statement->execute([$bookname,$bookdescription,$copies,$isbn]);
        }
    }




}
