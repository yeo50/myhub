<?php

if (count($errors) > 0) {
    foreach ($errors as $key => $err) {
        echo "<p class='text-center text-danger border border-danger p-2 mb-2' onclick='this.remove()'>$err</p>";
    }
}
