<?php
require("./database/db.php");
$errors = [];
$date = new DateTime("now");
$now = $date->format("Y-m-d H-i-s");
if (isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $is_featured = $_POST['is_featured'];
    $photo = $_FILES['photo'];
    $photoName = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];
    $oldphoto = $_POST['oldphoto'];

    if ($photoName) {
        move_uploaded_file($photoTmpName, "img/$photoName");
    } else {
        $photoName = $oldphoto;
    }


    empty($name) ? $errors[] = "name must be filled" : "";
    empty($description) ? $errors[] = "description need to filled" : "";
    empty($price) ? $errors[] = "price must be filled" : "";
    empty($category_id) ? $errors[] = "category must be selected" : "";
    if (count($errors) === 0) {
        $qry = "UPDATE products SET category_id=:category_id, name=:name, description=:description, price=:price, is_featured=:is_featured, photo=:photo Where product_id=:product_id";
        $statement = $pdo->prepare($qry);
        $statement->bindParam(":category_id", $category_id, PDO::PARAM_STR);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":description", $description, PDO::PARAM_STR);
        $statement->bindParam(":price", $price, PDO::PARAM_STR);
        $statement->bindParam(":is_featured", $is_featured, PDO::PARAM_INT);
        $statement->bindParam(":photo", $photoName, PDO::PARAM_STR);
        $statement->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        if ($statement->execute()) {
            header("location:admin-dashboard.php");
        } else {
            echo "something goes wrong";
        }
    }
}
