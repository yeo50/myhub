<?php
require("./database/db.php");
$id = $_GET['id'];
$qry = "DELETE FROM users WHERE user_id=:user";
$statement = $pdo->prepare($qry);
$statement->bindParam(":user", $id, PDO::PARAM_INT);
$res = $statement->execute();
if ($res) {
    header('location:admin-dashboard.php?message="delete success"');
}
