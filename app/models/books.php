<?php

namespace Model;

class Books{
    public static function total_books(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books");
        $stmt->execute();
        $rows  = $stmt->fetchAll();
        return $rows;
    }
    public static function issuedbooks($uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.* from books left join issuedbooks on issuedbooks.isbn = books.isbn and issuedbooks.uname = ? where issuedbooks.isbn is not null");
        $stmt->execute([$uname]);
        $rows  = $stmt->fetchAll();
        return $rows;
    }
    public static function newissuebooks($uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.* from books left join issuedbooks on issuedbooks.isbn = books.isbn and issuedbooks.uname = ? where issuedbooks.isbn is null and books.copies >0");
        $stmt->execute([$uname]);
        $rows  = $stmt->fetchAll();
        return $rows;
    }
    public static function approverequests(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.*, requests.uname from books left join requests on books.isbn = requests.isbn and requests.status = 'issue' where requests.uname is not null;");
        $stmt->execute();
        $rows  = $stmt->fetchAll();
        return $rows;
    }

    public static function approvereturns(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.*, requests.uname from books left join requests on books.isbn = requests.isbn and requests.status = 'return' where requests.uname is not null");
        $stmt->execute();
        $rows  = $stmt->fetchAll();
        return $rows;
    }

    public static function isbn_exists($isbn){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * from books where isbn = ?");
        $stmt->execute([$isbn]);
        $rows  = $stmt->fetchAll();
        if(isset($rows[0])){
            return TRUE;
        }
        return FALSE;
    }

    public static function addbooks($isbn,$bookname,$imgsrc,$bookdescription,$copies){
        $db = \DB::get_instance();
        $stmt = $db->prepare("insert into books values (?,?,?,?,?)");
        $stmt->execute([$isbn,$bookname,$imgsrc,$bookdescription,$copies]);
    }

    public static function delete($isbn){
        $db = \DB::get_instance();
        $stmt = $db->prepare("delete from books where isbn=?");
        $stmt->execute([$isbn]);
    }

    public static function newissue($isbn,$uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("insert into requests values(?,?,'issue')");
        $stmt->execute([$isbn,$uname]);
    }
    public static function newreturn($isbn,$uname){
        $db = \DB::get_instance();
        $stmt = $db->prepare("insert into requests values(?,?,'return')");
        $stmt->execute([$isbn,$uname]);
    }

    public static function approveissues($isbn,$uname){
        $db = \DB::get_instance();
        $stmt1 = $db->prepare("INSERT into issuedbooks values (?,?)");
        $stmt1->execute([$isbn,$uname]);
        $stmt2 = $db->prepare("update books set copies=copies-1 where isbn=?");
        $stmt2->execute([$isbn]);
        $stmt3 = $db->prepare("delete from requests where status = 'issue' and isbn=? and uname=?");
        $stmt3->execute([$isbn,$uname]);

    }
    public static function approveReturnRequests($isbn,$uname){
        $db = \DB::get_instance();
        $stmt1 = $db->prepare("delete from requests where status='return' and isbn=? and uname=?");
        $stmt1->execute([$isbn,$uname]);
        $stmt2 = $db->prepare("update books set copies=copies+1 where isbn=?");
        $stmt2->execute([$isbn]);
        $stmt3 = $db->prepare("delete from issuedbooks where isbn=? and uname=?");
        $stmt3->execute([$isbn,$uname]);

    }

    public static function editbook($isbn,$bookname,$imgsrc,$bookdescription,$copies){
        $db = \DB::get_instance();
        if($imgsrc!=Null){
            $stmt = $db->prepare("update books set bookname= ?, bookcoverpath=?, bookdescription=?, copies=? where isbn =? ");
            $stmt->execute([$bookname,$imgsrc,$bookdescription,$copies,$isbn]);
        }else{
            $stmt = $db->prepare("update books set bookname= ?, bookdescription=?, copies=? where isbn =? ");
            $stmt->execute([$bookname,$bookdescription,$copies,$isbn]);
        }
    }




}
