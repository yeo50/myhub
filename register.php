<?php
require("./database/db.php");
require("./partials/head.php");

$date = new DateTime("now");
$now = $date->format("Y-m-d H-i-s");

$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_REQUEST["submit"])) {
        $name = trim($_REQUEST["name"]);
        $email = trim($_REQUEST["email"]);
        $password = trim($_REQUEST["password"]);
        $password = password_hash($password, PASSWORD_BCRYPT);
        $phone = trim($_REQUEST["phone"]);
        $address = trim($_REQUEST["address"]);
        $photoName = $_FILES["photo"]["name"];
        $photoTmpName = $_FILES["photo"]["tmp_name"];
        move_uploaded_file($photoTmpName, "img/$photoName");
        empty($name) ? $errors[] = "name required" : "";
        empty($email) ? $errors[] = "email required" : "";
        empty($password) ? $errors[] = "password required" : "";
        empty($phone) ? $errors[] = "phone number required" : "";
        empty($address) ? $errors[] = "address required" : "";
        empty($photoName) ? $errors[] = "photo required" : "";
        $emailCheck = "SELECT * FROM users WHERE email=:email";
        $statement = $pdo->prepare($emailCheck);
        $statement->bindParam(":email", $email, PDO::PARAM_STR);
        $statement->execute();
        $res = $statement->fetch();
        if ($res) {
            $errors[] = "email is already exists";
        } else {
            $qry = "INSERT INTO users (user_id, name, email, password, phone, photo, address, created_date, updated_date) VALUES (null, :name, :email, :password, :phone, :photo, :address, :created_date, :updated_date)";
            $s   = $pdo->prepare($qry);
            $s->bindParam(":name", $name, PDO::PARAM_STR);
            $s->bindParam(":email", $email, PDO::PARAM_STR);
            $s->bindParam(":password", $password, PDO::PARAM_STR);
            $s->bindParam(":phone", $phone, PDO::PARAM_INT);
            $s->bindParam(":photo", $photoName, PDO::PARAM_STR);
            $s->bindParam(":address", $address, PDO::PARAM_STR);
            $s->bindParam(":created_date", $now, PDO::PARAM_INT);
            $s->bindParam(":updated_date", $now, PDO::PARAM_INT);
            if ($s->execute()) {
                header("location: login.php");
            } else {
                $errors[] = "Ooops Somethings went wrong";
            }
        }
    }
}

require("./partials/navbar.php");
require("./partials/form.php");
require("./partials/carousel.php");
require("./partials/script.php");
