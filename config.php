<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "demo";

    // session_start();

$db = mysqli_connect($host, $user, $password, $db) or die("Cannot connect to the database");
?>