
<?php
    include "../config.php";
    require_once('../dbhelp.php');
    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "student")
    {
        header("location: ..");
    }
    $username = $_SESSION["username"];
    $teacher_username = get_teacher($db, $username);
    $dir = "../Assignment/" . $teacher_username;
    $file_sc = scandir($dir);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <title>List Of Assignment</title>
    </head>
    <body>
        <br>
    <form action=".">
            <input class="btn btn-success"  type="submit" value="Go back!" > 
    </form>
    <br>
    <table class="table table-striped" width="50%" border="1" cellspacing="0" cellpadding="10">
                <tr style="background: #4CAF50; color: white">
                    <td>Number</td>
                    <td>Assigment</td>
                    <td>Options</td>
                    <td>Submitted</td>
                </tr>
                <?php    
                    $allowed = array('txt', 'pdf'); 
                    for($i = 2; $i < sizeof($file_sc); $i++){
                        $file_ext = explode('.', $file_sc[$i]);
                        $file_ext = strtolower(end($file_ext));
                           
                        //only list file assignment
                        if(in_array($file_ext, $allowed)){
                            echo "<tr>";
                            echo "<td>". ($i - 1) ."</td>";
                            echo "<td>". $file_sc[$i] ."</td>";
                            $file_dir =$dir . "/" . $file_sc[$i];
                            echo '<td><a href="'. $file_dir .'">Download</a></td>';
                            echo '<td><a href="SubmitAssignment.php?name=' . $file_sc[$i] .'&teacher=' . $teacher_username . '">Submit</a></td>';
                            echo "</tr>";
                        }
                    }
                ?>
                
            </table>
    </body>
</html>