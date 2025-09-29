<?php

require_once "../classes/product.php";
$productObj = new Product();

$product = [];
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"])){
        $pid = trim(htmlspecialchars($_GET["id"]));
        $product = $productObj->fetchBook($pid);
        if(!$product){
            echo "<a href='viewBook.php'>View Book</a>";
            exit("No Product Found");
        }
    }
    else{
        echo "<a href='viewBook.php'>View Book</a>";
        exit("No Book Found");
    }
}
elseif($_SERVER["REQUEST_METHOD"] == "POST"){
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

        
        if($productObj->editBook($_GET["id"])){
            header("Location: viewBook.php");
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
    <h1>Edit Book</h1>
    <a href="viewBook.php">View Product</a><br><br>

    <form action="" method="POST">
        <label for="title">title: <span>*</span></label><br>
        <input type="text" name="title" value="<?= $product["title"] ?? "" ?>" ><br>
        <p class="error"><?= $errors["title"] ?? "" ?></p>

        <label for="author">author: <span>*</span></label><br>
        <input type="text" name="author" value="<?= $product["author"] ?? "" ?>" ><br>
        <p class="error"><?= $errors["author"] ?? "" ?></p>

        <label for="genre">Genre: <span>*</span></label><br>
        <select name="genre" id="genre" >
            <option value="">--Select Option--</option>
            <option value="History" <?= (isset($product["genre"]) && $product["genre"] == "History" )? "selected": "" ?>>History</option>
            <option value="science" <?= (isset($product["genre"]) && $product["genre"] == "science" )? "selected": "" ?>>Science</option>
            <option value="fiction" <?= (isset($product["genre"]) && $product["genre"] == "fiction" )? "selected": "" ?>>Fiction</option>
        </select><br>
        <p class="error"><?= $errors["genre"] ?? "" ?></p>

        <label for="publication_year">Publication Year: <span>*</span></label><br>
        <input type="text" name="publication_year" value="<?= $product["publication_year"] ?? "" ?>" ><br>
        <p class="error"><?= $errors["publication_year"] ?? "" ?></p>

        <input type="submit" value="Save Product">
    </form>
</body>
</html>

