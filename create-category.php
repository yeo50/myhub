<?php
require("./database/db.php");
require("./partials/head.php");
$errors = [];
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    empty($name) ? $errors[] = "name must be filled" : "";
    $qry = "INSERT INTO categories (name) VALUES (:name)";
    $statement = $pdo->prepare($qry);
    $statement->bindParam(":name", $name, PDO::PARAM_STR);
    if ($statement->execute()) {
        header("location:admin-dashboard.php");
    } else {
        $errors[] = "wrongs";
    };
}
?>
<h3 class="text-center mt-3"> Category Create</h3>
<form action="create-category.php" method="post" class="zid  col-4 mt-4">
    <input type="text" name="name" id="cat-name" class="form-control mb-3 " placeholder="name">

    <input type="submit" name="create" class="form-control bg-info shadow">

</form>
<?php
require("./partials/script.php");
?>