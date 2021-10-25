<?php

    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "student")
    {
        header("location: ..");
    }
    include "../config.php";
    require_once("../dbhelp.php");
    $student = $_SESSION["username"];
    $file = scandir("../Chat");
    $all_file =[];

    //get all file that is the message sent for this user
    for($i = 2; $i < sizeof($file); $i++){
        if(explode(".", $file[$i])[1] == $student){
            array_push($all_file, explode(".", $file[$i])[0], $file[$i]);
        }
    }
    
    for($i =0; $i < sizeof($all_file); $i++){
        $fh = fopen($desination, 'r');
        $count = 0;
        while ($line = fgets($fh)) {
            $tmp = getBetween($line, "=START=", "=END=");
            if(isset($tmp)){
                $chat_log[$count] = $tmp[0];
                $count ++;
            }
        }
        fclose($fh);
    }

    

    function getBetween($content, $start, $end) {
        $n = explode($start, $content);
        $result = Array();
        foreach ($n as $val) {
            $pos = strpos($val, $end);
            if ($pos !== false) {
                $result[] = substr($val, 0, $pos);
            }
        }
        return $result;
    }
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
        <p>***The last message on top***</p>
        <table class="table table-striped" width="100%" border="1" cellspacing="0" cellpadding="10">
            <tr style="background: #4CAF50; color: white">
                <td>ID</td>
                <td>Sender</td>
                <td>Content</td>
            </tr>
            <?php
                for($i = 0; $i < $count; $i ++){?>
                    <tr>
                        <td><?=$i+1?></td>
                        <td><?=$teacher?></td>
                        <td><?=$chat_log[$i]?></td>
                    </tr>
                <?php } ?>
        </table>
    </body>
</html>