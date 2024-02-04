<?php
session_start();
require("./partials/head.php");
require("./partials/navbar.php");
require("./partials/carousel.php");

?>
<h1>Blog</h1>
<p class="text-danger">Welcome
    <?php
    if (isset($_SESSION['name'])) {
        echo $_SESSION['name'];
    }

    ?>
</p>
<?php
require("./partials/script.php");

?>