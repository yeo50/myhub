<?php
require("./database/db.php");
require("./partials/head.php");
$date = new DateTime("now");
$now = $date->format("Y-m-d H-i-s");
$errors = [];
if (isset($_POST['register'])) {
    echo "hello";
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    $photo = $_FILES['photo'];
    $category_id = $_POST['category_id'];
    $photoName = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];
    $is_featured = $_POST['is_featured'];
    move_uploaded_file($photoTmpName, "img/$photoName");
    empty($name) ? $errors[] = "name must be filled" : "";
    empty($description) ? $errors[] = "description must be filled" : "";
    empty($price) ? $errors[] = "price must be filled" : "";
    if (count($errors) === 0) {
        $qry = "INSERT INTO products (product_id,category_id, name, description,photo, price, is_featured, created_date, updated_date) VALUES (null,:category_id, :name, :description, :photo, :price, :is_featured, :created_date, :updated_date) ";
        $st = $pdo->prepare($qry);
        $st->bindParam(":category_id", $category_id, PDO::PARAM_INT);

        $st->bindParam(":name", $name, PDO::PARAM_STR);
        $st->bindParam(":description", $description, PDO::PARAM_STR);
        $st->bindParam(":price", $price, PDO::PARAM_STR);
        $st->bindParam(":photo", $photoName, PDO::PARAM_STR);
        $st->bindParam(":is_featured", $is_featured, PDO::PARAM_STR);
        $st->bindParam(":created_date", $now, PDO::PARAM_INT);
        $st->bindParam(":updated_date", $now, PDO::PARAM_INT);
        if ($st->execute()) {
            header("location:admin-dashboard.php");
        } else {
            echo "something goes wrong";
        }
    }
}

?>
<h3 class="text-center m-4"> Create Product</h3>
<form action="product-create.php" method="post" enctype="multipart/form-data" class=" bg-white py-3 px-4 shadow-lg rounded zid mt-1">
    <!-- 2 column grid layout with text inputs for the first and last names -->
    <?php
    if (count($errors) > 0) {
        foreach ($errors as $key => $value) {
            echo "<p class='text-danger text-center py-1 border border-danger' onclick='this.remove()'>$value </p>";
        }
    }
    ?>
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <label for="category-select">category</label>
                <select name="category_id" class="form-control" id="category-select">
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
            </div>
        </div>

    </div>
    <div class="row mb-4">
        <div class="col">
            <div class="form-outline">
                <input type="text" id="form3Example1" name="name" class="form-control" />
                <label class="form-label" for="form3Example1"> Name</label>
            </div>
        </div>

    </div>

    <!-- Email input -->
    <div class="form-outline mb-4">
        <input type="text" id="form3Example3" class="form-control" name="description" />
        <label class="form-label" for="form3Example3">Description</label>
    </div>


    <!-- phone input  -->
    <div class="form-outline mb-4">
        <input type="text" id="form3Example4" class="form-control" name="price" />
        <label class="form-label" for="form3Example4">Price</label>
    </div>
    <!-- photo input  -->
    <div class=" mb-4">
        <!-- <h2 class="form-control">Upload photo</h2> -->
        <label class="form-label " for="files">Upload Photo</label>
        <input type="file" id="files" class="form-control" name="photo" />

    </div>

    <!-- address input  -->
    <div class="form-outline mb-4">
        <input type="text" id="form3Example4" class="form-control" name="is_featured" />
        <label class="form-label" for="form3Example4">Is_featured</label>
    </div>

    <!-- Submit button -->
    <button type="submit" name="register" class="btn btn-primary btn-block mb-4">Create Product</button>



</form>
<?php
require("./partials/script.php");
