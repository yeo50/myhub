<?php
session_start();
require("./partials/head.php");

require("./database/db.php");
$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_REQUEST["login"])) {
        $email = trim($_REQUEST['email']);
        $password = trim($_REQUEST["password"]);
        empty($email) ? $errors[] = "you must enter your email" : "";
        empty($password) ? $errors[]  = "you must enter your password" : "";
        $qry = "SELECT * FROM users WHERE email=:email";
        $st = $pdo->prepare($qry);
        $st->bindParam(":email", $email, PDO::PARAM_STR);
        $st->execute();
        $res = $st->fetch();
        if ($email === "admin@gmail.com" && $password === "admin") {
            $_SESSION['name'] = "admin";
            $_SESSION['admin'] = "admin";
            header("location:admin-dashboard.php");
        } else {
            if ($res) {
                if (password_verify($password, $res['password']) && $email == $res['email']) {
                    $_SESSION['name'] = $res['name'];
                    $_SESSION['photo'] = $res['photo'];
                    header("location:index.php");
                } else {
                    $errors[] = "password does not match";
                }
            } else {
                $errors[] = "email does not match";
            }
        }
    }
}
require("./partials/navbar.php");

?>
<form class="log-in mx-auto bg-primary-400  border rounded-3 shadow-lg py-5 px-4 mt-4" action="login.php" method="post">
    <?php
    foreach ($errors as $k => $v) {
        echo "<p class='text-center text-danger border border-danger' onclick='this.remove()'>$v </p>";
    }
    ?>
    <!-- Email input -->
    <div class="form-outline mb-5">
        <input type="email" id="form1Example1" class="form-control border" name="email" style="height: 50px;" />
        <label class="form-label mt-2" for="form1Example1">Email address</label>
    </div>

    <!-- Password input -->
    <div class="form-outline mb-5">
        <input type="password" id="form1Example2" class="form-control border" name="password" style="height: 50px;" />
        <label class="form-label mt-2" for="form1Example2">Password</label>
    </div>

    <!-- 2 column grid layout for inline styling -->
    <div class="row mb-5">
        <div class="col d-flex justify-content-center">
            <!-- Checkbox -->
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                <label class="form-check-label" for="form1Example3"> Remember me </label>
            </div>
        </div>

        <div class="col">
            <!-- Simple link -->
            <a href="#!">Forgot password?</a>
        </div>
    </div>

    <!-- Submit button -->
    <button data-mdb-ripple-init type="submit" name="login" class="btn btn-primary btn-block" style="height: 50px;">Sign in</button>
</form>
<?php
require("./partials/script.php");
?>