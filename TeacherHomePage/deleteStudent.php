<?php
    include "../config.php";
    include "../dbhelp.php";
    
    $id = isset($_POST['id']) ? (int)$_POST['id'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    if ($id){
        delete_student($db, $id, $username);
    }

    header("location: ListStudents.php");

?>