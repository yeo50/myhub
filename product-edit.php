<?php
require("./database/db.php");
$id = $_GET['id'];
// $erros = [];
$qry = "SELECT * FROM products WHERE product_id=:product_id";
$statement = $pdo->prepare($qry);
$statement->bindParam(":product_id", $id, PDO::PARAM_INT);
$statement->execute();
$product = $statement->fetch();
// print_r($product);
require("./partials/head.php");
require("./partials/navbar.php");
?>
<form class="col-6 mx-auto shadow-lg mt-4 p-3 rounded-3" action="product-update.php" method="post" enctype="multipart/form-data">
    <!-- 2 column grid layout with text inputs for the first and last names -->
    <div class="row mb-4">
        <div class="col">
            <div data-mdb-input-init class="form-outline">
                <input type="hidden" id="form3Example1" class="form-control" name="product_id" value="<?= $product['product_id'] ?>" />
                <input type="text" id="form3Example1" class="form-control" name="name" value="<?= $product['name'] ?>" />
                <label class="form-label" for="form3Example1"> Name</label>
            </div>
        </div>

    </div>
    <label for="category-select" class="m-2"> Select Category</label>
    <select name="category_id" class="form-control my-3" id="category-select">
        <?php
        $cate_qry = "SELECT * FROM categories";
        $cate_statement = $pdo->prepare($cate_qry);
        $cate_statement->execute();
        $cate_res = $cate_statement->fetchAll(PDO::FETCH_ASSOC);
        // print_r($cate_res);
        foreach ($cate_res as $key => $category) :
        ?>
            <option value="<?= $category['category_id'] ?>"><?= $category['name'] ?></option>
        <?php endforeach ?>
    </select>
    <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="form3Example3" class="form-control" name="description" value="<?= $product['description'] ?>" />
        <label class="form-label" for="form3Example3">Description</label>


    </div>


    <div data-mdb-input-init class="form-outline mb-4">
        <input type="text" id="form3Example4" class="form-control" name="price" value="<?= $product['price'] ?>" />
        <label class="form-label" for="form3Example4">Price</label>
    </div>

    <div data-mdb-input-init class="form-outline mb-4">
        <input type="number" id="form3Example4" class="form-control" name="is_featured" value="<?= $product['is_featured'] ?>" />
        <label class="form-label" for="form3Example4">Is_featured</label>
    </div>
    <div data-mdb-input-init class="form-outline mb-4">
        <label class="form-label m-3" for="form3Example4">Upload Photo</label>

        <input type="file" id="form3Example4" class="form-control" name="photo" />
    </div>
    <input type="hidden" id="form3Example4" class="form-control" name="oldphoto" value="<?= $product['photo'] ?>" />
    <!-- Submit button -->
    <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block mb-4" name="update">Update</button>


</form>