<?php

require_once "../classes/product.php";
$viewObj = new Product();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="addBook.php">Add Book</a><br><br>
    <table border=1>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>author</th>
            <th>genre</th>
            <th>Publication_Year</th>
        </tr>
        <?php 
        $no = 1;
        foreach($viewObj->viewBook() as $view){
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $view['title'] ?></td>
            <td><?= $view["author"] ?></td>
            <td><?= $view["genre"] ?></td>
            <td><?= $view["publication_year"] ?></td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>