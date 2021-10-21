<?php

    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "student")
    {
        header("location: ..");
    }
    include "../config.php";
    require_once("../dbhelp.php");
    $teacher = $_SESSION["username"];
    $students = get_all($db);
    error_reporting(0);
?>
 
<!DOCTYPE html>
<html>
    <head>
        <title>List Of Students</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <form action=".">
            <input class="btn btn-success" type="submit" value="Go back!" >
        </form>
        <h1>List Of Students</h1>
        <table class="table table-striped" width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr style="background: #4CAF50; color: white">
                <td>ID</td>
                <td>Fullname</td>
                <td>Email</td>
                <td>Phone number</td>
            </tr>
            <?php foreach ($students as $item){ ?>
            <tr>
                <td><?=$item['ID']?></td>
                <td><?=$item['fullname']?></td>
                <td><?=$item['mail']?></td>
                <td><?=$item['phone']?></td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>