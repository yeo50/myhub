<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['photo']);
session_destroy();
header("location:index.php");
