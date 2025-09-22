<?php

require_once "../classes/product.php";
$productObj = new Product();

$product = ["title"=>"", "author"=>"", "genre"=>"", "publication_year"=>""];
$errors = ["title"=>"", "author"=>"", "genre"=>"", "publication_year"=>""];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $now = new DateTime('Y');
    $product["title"] = trim(htmlspecialchars($_POST["title"]));
    $product["author"] = trim(htmlspecialchars($_POST["author"]));
    $product["genre"] = trim(htmlspecialchars($_POST["genre"]));
    $product["publication_year"] = trim(htmlspecialchars($_POST["publication_year"]));

    if(empty($product["title"])){
        $errors["title"] = "Title is Required";
    }
    if(empty($product["author"])){
        $errors["author"] = "Author is Required";
    }
    if(empty($product["genre"])){
        $errors["genre"] = "Please Select a Genre";
    }
    if(empty($product["publication_year"])){
        $errors["publication_year"] = "Publication Year is Required";
    }elseif ($product["publication_year"] > date("Y")) {
        $errors["publication_year"] = "Input a valid publication year.";
    }
//  && 



    if(empty(array_filter($errors))){
        $productObj->title = $product["title"];
        $productObj->author = $product["author"];
        $productObj->genre = $product["genre"];
        $productObj->publication_year = $product["publication_year"];

        
        if($productObj->addBook()){
            echo "success";
        }else{
            echo "Lock in Buddy";
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        span{
            color: red;
        }
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <h1>Add Book</h1>
    <a href="viewBook.php">View Product</a><br><br>

    <form action="" method="post">
        <label for="title">title: <span>*</span></label><br>
        <input type="text" name="title" ><br>
        <p class="error"><?= $errors["title"] ?></p>

        <label for="author">author: <span>*</span></label><br>
        <input type="text" name="author" ><br>
        <p class="error"><?= $errors["author"] ?></p>

        <label for="genre">Genre: <span>*</span></label><br>
        <select name="genre" id="genre" >
            <option value="">--Select Option--</option>
            <option value="History">History</option>
            <option value="science">Science</option>
            <option value="fiction">Fiction</option>
        </select><br>
        <p class="error"><?= $errors["genre"] ?></p>

        <label for="publication_year">Publication Year: <span>*</span></label><br>
        <input type="text" name="publication_year" ><br>
        <p class="error"><?= $errors["publication_year"] ?></p>

        <input type="submit" value="Save Product">
    </form>
</body>
</html>

