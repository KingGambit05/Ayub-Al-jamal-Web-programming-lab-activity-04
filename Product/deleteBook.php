<?php

require_once "../classes/product.php";
$productObj = new Product();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $pid = trim(htmlspecialchars($_GET["id"]));
        $product = $productObj->fetchBook($pid);
        if(!$product){
        echo "<a href='viewBook.php'>View Book</a>";
        }else{
            $productObj->deleteBook($pid);
            header("Location: viewBook.php");
        }
    }else{
        echo "<a href='viewBook.php'>View Book</a>";
        exit("no book found");
    }
}
