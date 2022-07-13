<?php

namespace Model;

class Books{
    public static function totalBooks(){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT * FROM books");
        $statement->execute();
        $rows  = $statement->fetchAll();
        return $rows;
    }
    public static function issuedBooks($uname){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT books.* from books left join issuedbooks on issuedbooks.isbn = books.isbn and issuedbooks.uname = ? where issuedbooks.isbn is not null");
        $statement->execute([$uname]);
        $rows  = $statement->fetchAll();
        return $rows;
    }
    public static function newIssueBooks($uname){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT books.* from books left join issuedbooks on issuedbooks.isbn = books.isbn and issuedbooks.uname = ? where issuedbooks.isbn is null and books.copies >0");
        $statement->execute([$uname]);
        $rows  = $statement->fetchAll();
        return $rows;
    }
    public static function approveRequests(){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT books.*, requests.uname from books left join requests on books.isbn = requests.isbn and requests.status = 'issue' where requests.uname is not null;");
        $statement->execute();
        $rows  = $statement->fetchAll();
        return $rows;
    }

    public static function approveReturns(){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT books.*, requests.uname from books left join requests on books.isbn = requests.isbn and requests.status = 'return' where requests.uname is not null");
        $statement->execute();
        $rows  = $statement->fetchAll();
        return $rows;
    }

    public static function getBookInfo($isbn){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT * from books where isbn = ?");
        $statement->execute([$isbn]);
        $rows  = $statement->fetchAll();
        return $rows;
        
    }

    public static function addBooks($isbn, $book_name, $img_src, $book_description, $copies){
        $db = \DB::getInstance();
        $statement = $db->prepare("insert into books values (?,?,?,?,?)");
        $statement->execute([$isbn,$book_name,$img_src,$book_description,$copies]);
    }

    public static function delete($isbn){
        $db = \DB::getInstance();
        $statement = $db->prepare("delete from books where isbn=?");
        $statement->execute([$isbn]);
    }

    public static function newIssue($isbn,$uname){
        $db = \DB::getInstance();
        $statement = $db->prepare("insert into requests values(?,?,'issue')");
        $statement->execute([$isbn,$uname]);
    }
    public static function newReturn($isbn,$uname){
        $db = \DB::getInstance();
        $statement = $db->prepare("insert into requests values(?,?,'return')");
        $statement->execute([$isbn,$uname]);
    }

    public static function approveIssues($isbn,$uname){
        $db = \DB::getInstance();
        $statement = $db->prepare("INSERT into issuedbooks values (?,?);update books set copies=copies-1 where isbn=?;delete from requests where status = 'issue' and isbn=? and uname=?");
        $statement->execute([$isbn,$uname,$isbn,$isbn,$uname]);

    }
    public static function approveReturnRequests($isbn,$uname){
        $db = \DB::getInstance();
        $statement = $db->prepare("delete from requests where status='return' and isbn=? and uname=?;update books set copies=copies+1 where isbn=?;delete from issuedbooks where isbn=? and uname=?");
        $statement->execute([$isbn,$uname,$isbn,$isbn,$uname]);

    }

    public static function editBook($isbn, $book_name, $img_src, $book_description, $copies){
        $db = \DB::getInstance();
        if($img_src!=Null){
            $statement = $db->prepare("update books set bookname= ?, bookcoverpath=?, bookdescription=?, copies=? where isbn =? ");
            $statement->execute([$book_name,$img_src,$book_description,$copies,$isbn]);
        }else{
            $statement = $db->prepare("update books set bookname= ?, bookdescription=?, copies=? where isbn =? ");
            $statement->execute([$book_name,$book_description,$copies,$isbn]);
        }
    }




}
