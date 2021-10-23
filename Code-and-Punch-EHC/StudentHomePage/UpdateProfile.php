<?php
    include "../config.php";
    require_once('../dbhelp.php');
    session_start();

    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "student" || !isset($_POST))
    {
        header("location: ..");
    }
    $_POST["username"] = $_SESSION["username"];

    $s_email =$s_fullname = $s_password = $s_phone = $s_confirm_password = "";
    $msg_fullname = $msg_password = $msg_phone = $msg_success ="";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])){
        $s_password = $_POST["password"];
        $s_confirm_password = $_POST["confirm_password"];
        $s_email = $_POST["email"];
        $s_phone = $_POST["phone"];
        

        if(!is_valid_phone($s_phone)){
            $msg_phone = "Invalid phone number";
        }
        elseif(!check_password($db, $s_password)){
            $msg_password ="Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter.";
        }
        elseif($s_password != $s_confirm_password){
            $msg_password = "The password confirmation does not match";
        }
        else{
            $_POST["usertype"] = "student";
            if(update_profile($db, $_POST["username"] , $_POST)){
                $msg_success = "Update student's profile successful !";
            }
        }

    }

?>
<!DOCTYPE html>
<html>
<head>
	<title>UPDATE STUDENT'S PROFILE</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <form action=".">
        <input class="btn btn-success" type="submit" value="Go back!" >
    </form>
	<div class="container">
		<div class="panel panel-primary">
            <h2 class="text-center">Update Student's Profile </h2>
			<div class="panel-body">
                <form method="post">
                <div class="form-group">
                        <label for="email">Email:</label>
                        <input required="true" type="email" class="form-control" name="email" value="<?=$s_email?>">
                    </div>
                    <div class="form-group">
                        <label for="address">Phone number:</label>
                        <input type="text" class="form-control" name="phone" value="<?=$s_phone?>">
                    </div>
                    <?php
                        echo "<p style=\"color:red; font-size: 85%\">". $msg_phone ."</p>"
                    ?>
                    <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input required="true" type="password" class="form-control" name="password" value="<?=$s_password?>">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Confirm password:</label>
                        <input required="true" type="password" class="form-control" name="confirm_password" value="<?=$s_confirm_password?>">
                    </div>
                    <?php
                        echo "<p style=\"color:red; font-size: 85%\">". $msg_password ."</p>"
                    ?>
                    <?php
                        echo "<p style=\"color:green; font-size: 85%\">". $msg_success ."</p>"
                    ?>
                    <button class="btn btn-success" style="width: 100%;">Update</button>
                </form>
			</div>
		</div>
	</div>
</body>
</html> 