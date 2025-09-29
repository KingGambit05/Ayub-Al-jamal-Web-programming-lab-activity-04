<?php

require_once "database.php";

class Product extends Database{
    public $id = "";
    public $title = "";
    public $author = "";
    public $genre = "";
    public $publication_year = "";

    public function addBook(){
        $sql = "INSERT INTO bookstore1 (title, author, genre, publication_year) VALUE (:title, :author, :genre, :publication_year)";
        $query = $this->connect()->prepare($sql);

        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publication_year", $this->publication_year);
        
        return $query->execute();
    }

    public function viewBook($search="", $genre=""){
        $sql = "SELECT * FROM bookstore1 WHERE title LIKE CONCAT('%', :search, '%') AND genre LIKE CONCAT('%', :genre, '%') ORDER BY title ASC";

        $query = $this->connect()->prepare($sql);
        $query->bindParam(":search", $search);
        $query->bindParam(":genre", $genre);

        if($query->execute()){
            return $query->fetchAll();
        }else{
            return null;
        }
    }

    public function isBookExist($ptitle, $pid=""){
        $sql = "SELECT COUNT(*) as total FROM bookstore1 WHERE title = :title AND id <> :id";
        $query = $this->connect()->prepare($sql);
        $query->bindParam(":title", $ptitle);
        $query->bindParam(":id", $pid);

        $record = null;

        if($query->execute()){
            $record = $query->fetch();
        }

        if($record["total"] > 0){
            return true;
        }else{
            return false;
        }

    }

    public function fetchBook($pid){
        $sql = "SELECT * FROM bookstore1 WHERE id = :id";
        $query = $this->connect()->prepare($sql);
        $query->bindParam(":id", $pid);
        
        if ($query->execute()){
            return $query->fetch();
        }else{
            return null;
        }
    }

    public function editBook($pid){
        $sql = "UPDATE bookstore1 SET title = :title, author = :author, genre = :genre, publication_year = :publication_year WHERE id = :id";

        $query = $this->connect()->prepare($sql);

        $query->bindParam(":title", $this->title);
        $query->bindParam(":author", $this->author);
        $query->bindParam(":genre", $this->genre);
        $query->bindParam(":publication_year", $this->publication_year);
        $query->bindParam(":id", $pid);
        
        return $query->execute();
    }

    public function deleteBook($pid){
        $sql = "DELETE FROM bookstore1 WHERE id=:id";
        
        $query = $this->connect()->prepare($sql);

        $query->bindParam(":id", $pid);

        return $query->execute();
    }
}


//$obj = new Product();
// $obj->title = "sad";
// $obj->author = "Dazai";
// $obj->genre = "History";
// $obj->publication_year = "2024";


//var_dump($obj->editBook(9));
