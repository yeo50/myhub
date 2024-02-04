<?php
require("./database/db.php");
$id = $_GET['id'];
$qry = "DELETE FROM products WHERE product_id=:product_id";
$statement = $pdo->prepare($qry);
$statement->bindParam(":product_id", $id, PDO::PARAM_INT);
if ($statement->execute()) {
    header("location:admin-dashboard.php?message='delete success'");
} else {
    echo "goes wroong";
}
