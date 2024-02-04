<?php

require("./database/db.php");
require("./partials/head.php");
$errors = [];
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    empty($name) ? $errors[] = "name must be filled" : "";
    $updateqry = "UPDATE categories SET name=:name  WHERE category_id=:category_id";
    $statement = $pdo->prepare($updateqry);
    $statement->bindParam(":name", $name, PDO::PARAM_STR);
    $statement->bindParam(":category_id", $category_id, PDO::PARAM_STR);

    $res = $statement->execute();
    if ($res) {
        header("location:admin-dashboard.php");
    } else {
        echo "no ono";
    }
}
?>
<?php
require("errors.php");
