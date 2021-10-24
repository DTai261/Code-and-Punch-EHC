<?php
    include "../config.php";
    include "../dbhelp.php";
    $id = isset($_POST['id']) ? (int)$_POST['id'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    // // check sql injection
    // $id= mysqli_real_escape_string($db, $id);
    // $username= mysqli_real_escape_string($db, $username);
    if ($id){
        delete_student($db, $id, $username);
    }

    header("location: ListStudents.php");

?>