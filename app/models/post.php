<?php

namespace Model;

class Post {
    public static function create($caption) {
        $db = \DB::get_instance();
        $statement = $db->prepare("INSERT INTO posts (caption) VALUES (?)");
        $statement->execute([$caption]);
    }

    public static function get_all() {
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT * FROM posts");
        $statement->execute();
        $rows = $statement->fetchAll();
        return $rows;
    }

    public static function find($id) {
        $db = \DB::get_instance();
        $statement = $db->prepare("SELECT * FROM posts WHERE id = ?");
        $statement->execute([$id]);
        $row = $statement->fetch();
        return $row;
    }
}
