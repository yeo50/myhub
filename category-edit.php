<?php
require("./database/db.php");
$id = $_GET['id'];
// $erros = [];
$qry = "SELECT * FROM categories WHERE category_id=:category_id";
$statement = $pdo->prepare($qry);
$statement->bindParam(":category_id", $id, PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch();
// print_r($user);
require("./partials/head.php");
require("./partials/navbar.php");
?>
<form action="category-update.php" method="post" enctype="multipart/form-data" class=" bg-white py-3 px-4 shadow-lg rounded zid mt-1">
    <!-- 2 column grid layout with text inputs for the first and last names -->

    <h1 class="mb-4 text-center">Edit Here</h1>
    <div class="row mb-4">
        <div class="col">
            <div data-mdb-input-init class="form-outline">
                <input type="hidden" id="form3Example1" class="user_id" name="category_id" value="<?= $user['category_id'] ?>" />
                <input type="text" id="form3Example1" class="form-control" name="name" value="<?= $user['name'] ?>" />

            </div>
        </div>

    </div>






    <!-- Submit button -->
    <button data-mdb-ripple-init type="submit" name="update" class="btn btn-primary btn-block mb-4">Update</button>


</form>