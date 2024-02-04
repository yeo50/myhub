<?php
require("./database/db.php");
$id = $_GET['id'];
$qry = "DELETE FROM categories WHERE category_id=:category_id";
$statement = $pdo->prepare($qry);
$statement->bindParam(":category_id", $id, PDO::PARAM_INT);
$res = $statement->execute();
if ($res) {
    header('location:admin-dashboard.php?message="delete success"');
}
