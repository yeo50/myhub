<?php
require("./database/db.php");
$id = $_GET['id'];
// $erros = [];
$qry = "SELECT * FROM users WHERE user_id=:user_id";
$statement = $pdo->prepare($qry);
$statement->bindParam(":user_id", $id, PDO::PARAM_INT);
$statement->execute();
$user = $statement->fetch();
// print_r($user);
require("./partials/head.php");
require("./partials/navbar.php");
?>
<form action="user-update.php" method="post" enctype="multipart/form-data" class=" bg-white py-3 px-4 shadow-lg rounded zid mt-1">
    <!-- 2 column grid layout with text inputs for the first and last names -->

    <h1 class="mb-4 text-center">Edit Here</h1>
    <div class="row mb-4">
        <div class="col">
            <div data-mdb-input-init class="form-outline">
                <input type="hidden" id="form3Example1" class="user_id" name="user_id" value="<?= $user['user_id'] ?>" />
                <input type="text" id="form3Example1" class="form-control" name="name" value="<?= $user['name'] ?>" />

            </div>
        </div>

    </div>

    <!-- Email input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="email" id="form3Example3" class="form-control" name="email" value="<?= $user['email'] ?>" />

    </div>

    <!-- Password input -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="password" id="form3Example4" class="form-control" name="password" />
        <label class="form-label" for="form3Example4">Password</label>
    </div>
    <!-- phone input  -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="number" id="form3Example4" class="form-control" name="phone" value="<?= $user['phone'] ?>" />

    </div>
    <!-- photo input  -->
    <div data-mdb-input-init class=" mb-4">
        <!-- <h2 class="form-control">Upload photo</h2> -->
        <label class="form-label " for="files">Upload Photo</label>

        <input type="file" id="files" class="form-control" name="photo" />
    </div>
    <input type="hidden" id="files" class="form-control" name="oldphoto" value="<?= $user['photo'] ?>" />
    <div class="text-center">
        <img src="img/<?= $user['photo'] ?>" alt="photo" width="150">
    </div>

    <!-- address input  -->
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="form3Example4" class="form-control" name="address" />
        <?= $user['address'];  ?>
        <label class="form-label" for="form3Example4">Address</label>
    </div>

    <!-- Submit button -->
    <button data-mdb-ripple-init type="submit" name="update" class="btn btn-primary btn-block mb-4">Update</button>


</form>