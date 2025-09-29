<?php

require_once "../classes/product.php";
$viewObj = new Product();

$search  = $genre = "";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $search = isset($_GET["search"])? trim(htmlspecialchars($_GET["search"])) : "";
    $genre = isset($_GET["genre"])? trim(htmlspecialchars($_GET["genre"])) : "";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Products</h1>
    <form action="" method="GET">
        <select name="genre" id="genre" >
            <option value="">--Select Option--</option>
            <option value="History" <?= (isset($product["genre"]) && $product["genre"] == "History" )? "selected": "" ?>>History</option>
            <option value="science" <?= (isset($product["genre"]) && $product["genre"] == "science" )? "selected": "" ?>>Science</option>
            <option value="fiction" <?= (isset($product["genre"]) && $product["genre"] == "fiction" )? "selected": "" ?>>Fiction</option>
        </select>
        <input type="submit" value="Submit">
    </form>
    <br>
    
    <a href="addBook.php">Add Book</a><br><br>
    <table border=1>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>author</th>
            <th>genre</th>
            <th>Publication_Year</th>
            <th>Action</th>
        </tr>
        <?php 
        $no = 1;
        foreach($viewObj->viewBook($search, $genre) as $view){
            $message = "Are you sure you wawnt to delete the product " . $view["title"] . "?";
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $view['title'] ?></td>
            <td><?= $view["author"] ?></td>
            <td><?= $view["genre"] ?></td>
            <td><?= $view["publication_year"] ?></td>
            <td>
                <a href="editProduct.php?id=<?= $view["id"] ?>">Edit</a>
                <a href="deleteBook.php?id=<?= $view["id"]  ?>" onclick="return confirm('<?= $message ?>')">Delete</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>