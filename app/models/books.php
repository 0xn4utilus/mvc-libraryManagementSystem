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
    public static function issuedBooks($username){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT books.* from books left join issued_books on issued_books.isbn = books.isbn and issued_books.username = ? where issued_books.isbn is not null");
        $statement->execute([$username]);
        $rows  = $statement->fetchAll();
        return $rows;
    }
    public static function newIssueBooks($username){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT books.* from books left join issued_books on issued_books.isbn = books.isbn and issued_books.username = ? where issued_books.isbn is null and books.copies >0");
        $statement->execute([$username]);
        $rows  = $statement->fetchAll();
        return $rows;
    }
    public static function approveRequests(){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT books.*, requests.username from books left join requests on books.isbn = requests.isbn and requests.status = 'issue' where requests.username is not null;");
        $statement->execute();
        $rows  = $statement->fetchAll();
        return $rows;
    }

    public static function approveReturns(){
        $db = \DB::getInstance();
        $statement = $db->prepare("SELECT books.*, requests.username from books left join requests on books.isbn = requests.isbn and requests.status = 'return' where requests.username is not null");
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

    public static function newIssue($isbn,$username){
        $db = \DB::getInstance();
        $statement = $db->prepare("insert into requests values(?,?,'issue')");
        $statement->execute([$isbn,$username]);
    }
    public static function newReturn($isbn,$username){
        $db = \DB::getInstance();
        $statement = $db->prepare("insert into requests values(?,?,'return')");
        $statement->execute([$isbn,$username]);
    }

    public static function approveIssues($isbn,$username){
        $db = \DB::getInstance();
        $statement = $db->prepare("INSERT into issued_books values (?,?);update books set copies=copies-1 where isbn=?;delete from requests where status = 'issue' and isbn=? and username=?");
        $statement->execute([$isbn,$username,$isbn,$isbn,$username]);

    }
    public static function approveReturnRequests($isbn,$username){
        $db = \DB::getInstance();
        $statement = $db->prepare("delete from requests where status='return' and isbn=? and username=?;update books set copies=copies+1 where isbn=?;delete from issued_books where isbn=? and username=?");
        $statement->execute([$isbn,$username,$isbn,$isbn,$username]);

    }

    public static function editBook($isbn, $book_name, $img_src, $book_description, $copies){
        $db = \DB::getInstance();
        if($img_src!=Null){
            $statement = $db->prepare("update books set book_name= ?, book_cover_path=?, book_description=?, copies=? where isbn =? ");
            $statement->execute([$book_name,$img_src,$book_description,$copies,$isbn]);
        }else{
            $statement = $db->prepare("update books set book_name= ?, book_description=?, copies=? where isbn =? ");
            $statement->execute([$book_name,$book_description,$copies,$isbn]);
        }
    }




}
