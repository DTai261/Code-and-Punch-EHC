<?php

    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "student")
    {
        header("location: ..");
    }
    $student = $_SESSION["username"];
    $recv_stu = $_GET["student"];
    $msg = "";
    error_reporting(0);

    if(isset($_POST["chat"])){
        $chat = trim($_POST["chat"], " \n\r\t\v\0");
        $chat = str_replace(array("\r","\n")," ",$chat);
        $message = "=START=" . $chat . "=END=";
        $file_chat = $student . "." . $recv_stu . ".txt";
        $desination = "../Chat/" . $file_chat;

        if (file_exists($desination)) {
            $file_data = $message . "\n";
            $file_data .= file_get_contents($desination);
            file_put_contents($desination, $file_data);

            $msg = "Send message success !";
          } else {
            $fh = fopen($desination, 'w');
            fwrite($fh, $message."\n");
            $msg = "Send message success !";
            fclose($fh);
          }

    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>CHAT WITH STUDENT</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>
<body>
    <br>
    <form action="ListStudents.php">
            <input class="btn btn-success"  type="submit" value="Go back!" > 
    </form>
	<div class="container">
		<div class="panel panel-primary">
            <h2>Say something to him/her</h2>
			<div class="panel-body">
                <form method="post" action="#">
			    	<div class="form-group">
                        <textarea rows = "5" style = "width:100%" name = "chat">
                        </textarea>
				    </div>
                    <?php
                        echo '<p style="color: Green">' . $msg . '</p>';
                    ?>
                    <button class="btn btn-success" style="width: 100%;">Send</button>
                </form>
			</div>
		</div>
	</div>
</body>
</html> 