<?php

    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "teacher")
    {
        header("location: ..");
    }
    include "../config.php";
    require_once("../dbhelp.php");
    $teacher = $_SESSION["username"];
    $students = get_all_students($db, $teacher);
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
                <td style="width:20%">Options</td>
            </tr>
            <?php foreach ($students as $item){ ?>
            <tr>
                <td><?=$item['ID']?></td>
                <td><?=$item['fullname']?></td>
                <td><?=$item['mail']?></td>
                <td><?=$item['phone']?></td>
                <td>
                    <form method="post" action="deleteStudent.php">
                        <input class="btn btn-success" onclick="window.location = 'updateStudent.php?id=<?=$item['ID']?>&student_username=<?=$item['username']?>'" type="button" value="Update"/>
                        <input type="hidden" name="id" value="<?php echo $item['ID']; ?>"/>
                        <input type="hidden" name="username" value="<?php echo $item['username']; ?>"/>
                        <input class="btn btn-success" onclick="return confirm('Are you sure want to delete?');" type="submit" name="delete" value="Delete"/>
                        <input class="btn btn-success" onclick="window.location = 'chat.php?id=<?=$item['ID']?>'" type="button" value="Chat"/>
                        
                    </form>
                    
                </td>
            </tr>
            <?php } ?>
        </table>
    </body>
</html>