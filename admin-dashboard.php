<?php
session_start();
require("./database/db.php");
$admin = isset($_SESSION['admin']);
require("./partials/head.php");

?>
<?php if ($admin) : ?>
    <?php require("./partials/navbar.php"); ?>

    <div class="row ">
        <h2 class="text-center text-4 m-4 ">Admin Dashboard</h2>
        <span class="sbar"><i class="fas fa-solid fa-bars m-4" id="bar" style="font-size: 1.5rem;"></i></span>
        <div class="col-2 p-4 bg-info translateX(50%) sidelist">

            <ul class="list-group list-group-light ">
                <li class="list-group-item"><a href="#user">User</a></li>
                <li class="list-group-item"><a href="#product">Product</a></li>
                <li class="list-group-item"><a href="#category">Category</a></li>
                <li class="list-group-item"><a href="#order">Order</a></li>
            </ul>
        </div>
        <div class="col-8 p-4 mx-auto">
            <?php
            $mes = $_GET['message'] ?? "";
            if ($mes) {
                echo "<p class='text-success text-center border p-2 mb-2 border-success' onclick='this.remove()'>$mes</p>";
            }
            ?>
            <section>
                <h4 id="user" class="text-center mb-4">User Listing</h4>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $qry = "SELECT * FROM users ORDER BY name ASC LIMIT 10";
                        $statement = $pdo->prepare($qry);
                        $statement->execute();
                        $users = $statement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($users as $key => $user) :
                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="img/<?= $user['photo'] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />

                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?= $user['name'] ?></p>

                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?= $user['email'] ?></p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?= $user['address'] ?></p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?= $user['phone'] ?></p>
                                </td>
                                <td>
                                    <a type="button" class="btn btn-link btn-sm btn-rounded" href="user-edit.php?id=<?= $user['user_id'] ?>">
                                        Edit
                                    </a>
                                    <a type="button" class="btn btn-link btn-sm btn-rounded" href="user-del.php?id=<?= $user['user_id'] ?>" onclick="return confirm('are you sure')">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>
            <section>
                <h4 id="product" class="text-center">Product Listing</h4>
                <a href="product-create.php" class="text-center btn btn-info">Create Product Here</a>
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Is_featured</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pqry = "SELECT * FROM products ORDER BY name ASC LIMIT 10";
                        $pstatement = $pdo->prepare($pqry);
                        $pstatement->execute();
                        $products = $pstatement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($products as $k => $product) :

                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="img/<?= $product['photo'] ?>" alt="" style="width: 45px; height: 45px" class="rounded-circle" />

                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?= $product['name'] ?></p>

                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?= $product['description'] ?></p>
                                </td>
                                <td><?= $product['price'] ?></td>
                                <td><?= $product['is_featured'] ?></td>
                                <td>
                                    <a type="button" class="btn btn-link btn-sm btn-rounded" href="product-edit.php?id=<?= $product['product_id'] ?>">
                                        Edit
                                    </a>
                                    <a type="button" class="btn btn-link btn-sm btn-rounded" href="product-del.php?id=<?= $product['product_id'] ?>" onclick="return confirm('are you sure')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

            </section>
            <section>
                <h4 id="category" class="m-3">Category Listing</h4>
                <a href="create-category.php" class="btn btn-info"> Create Category</a>

                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                        <tr>
                            <th>Category_id</th>
                            <th>Name</th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cqry = "SELECT * FROM categories ORDER BY name ASC LIMIT 10";
                        $cstatement = $pdo->prepare($cqry);
                        $cstatement->execute();
                        $cusers = $cstatement->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($cusers as $ckey => $cuser) :
                        ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <p class="fw-normal mb-1"><?= $cuser['category_id'] ?></p>
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?= $cuser['name'] ?></p>

                                </td>


                                <td>
                                    <a type="button" class="btn btn-link btn-sm btn-rounded" href="category-edit.php?id=<?= $cuser['category_id'] ?>">
                                        Edit
                                    </a>
                                    <a type="button" class="btn btn-link btn-sm btn-rounded" href="category-del.php?id=<?= $cuser['category_id'] ?>" onclick="return confirm('are you sure')">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                        <?php endforeach ?>
                    </tbody>
                </table>
            </section>

            <section>
                <h4 id="order">Order Listing</h4>
            </section>
        </div>
    </div>

    <?php
    require("./partials/script.php")
    ?>
<?php else : ?>
    <?php header("location:index.php"); ?>
<?php endif  ?>