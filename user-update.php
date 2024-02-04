<?php
// print_r($_REQUEST);
require("./database/db.php");
require("./partials/head.php");
$errors = [];
if (isset($_POST['update'])) {
    $uuid = $_POST['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $oldphoto = $_POST['oldphoto'];
    $photo = $_FILES['photo'];
    $pname = $_FILES['photo']['name'];
    $tmpname = $_FILES['photo']['tmp_name'];

    if ($pname) {
        move_uploaded_file($tmpname, "img/$pname");
    } else {
        $pname = $oldphoto;
    }
    empty($name) ? $errors[] = "name required " : "";
    empty($email) ? $errors[] = "email required " : "";
    empty($phone) ? $errors[] = "phone required " : "";
    empty($pname) ? $errors[] = "photo required " : "";
    empty($tmpname) ? $errors[] = "photo required " : "";
    if (count($errors) === 0) {
        $updateqry = "UPDATE users SET name=:name , phone=:phone, email=:email, address=:address, photo=:photo WHERE user_id=:user_id";
        $statement = $pdo->prepare($updateqry);
        $statement->bindParam(":name", $name, PDO::PARAM_STR);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->bindParam(":address", $address, PDO::PARAM_STR);
        $statement->bindParam(":phone", $phone, PDO::PARAM_INT);
        $statement->bindParam(":photo", $pname, PDO::PARAM_STR);
        $statement->bindParam(":user_id", $uuid, PDO::PARAM_INT);
        $res = $statement->execute();
        if ($res) {
            header("location:admin-dashboard.php");
        } else {
            die("errore");
        }
    } else {
        $errors[] = "incorrect";
    }
}
?>
<div class="w-50 m-auto p-5"><?php require "errors.php"; ?></div>