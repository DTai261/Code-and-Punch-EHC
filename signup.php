<?php
    include "config.php";
    require_once('dbhelp.php');
    error_reporting(0);
    $msg_username = $msg_confirmation_password = $msg_fullname = "";
    $msg_weak_passowrd = "*Password must be at least 8 characters in length and must contain at least one number, one upper case letter, one lower case letter.";
    $success;
    $db=mysqli_connect('localhost', 'root', '','demo');
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
        $username = $_POST["username"];
        $fullname = $_POST["name"];
                // check sql injection
                $username = mysqli_real_escape_string($db, $username );
                $password = mysqli_real_escape_string($db, $password );
                $confirm_password = mysqli_real_escape_string($db, $confirm_password );
                $fullname  = mysqli_real_escape_string($db, $fullname  );
        if(!is_valid_fullname($db,$fullname)){
            $msg_fullname = "Full name must have characters (a-z or A-Z), start with upper case and
                                length from 5 to 30";
        }
        elseif(!is_valid_username($db,$username)){
            $msg_username = "Username must have lowercase characters (a-z) or numbers (0-9) or 
                            underscores(_), no special character and length from 5 to 30!";
        }
        elseif(is_exist($db, $username)){
            $msg_username = "username already exist";
        }
        elseif($password != $confirm_password){
            $msg_confirmation_password = "The password confirmation does not match";
        }
        else{
            $password = $_POST['password'];
            
            $number = preg_match('@[0-9]@', $password);
            $uppercase = preg_match('@[A-Z]@', $password);
            $lowercase = preg_match('@[a-z]@', $password);
            
            if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase) {
                $success = false;
            } else {
                $_POST["usertype"] = "teacher";
                if(insert_user($db, $_POST)){
                    $success = true;
                }
            }
        }
    }
?>


<!-- HTML -->
<html>
    <head>
        <title>SignUp</title>
        <link rel="stylesheet" href="css/signup.css">
    </head>
    <body>
        <form action="#" method="post">
            <h2>Sign Up</h2>
            <?php
                echo "<p style=\"color:red\"> ". $msg_fullname . "</p>"
            ?>
            <p>
                <label class="floatLabel">Name</label>
                <input name="name" type="text" required>
            </p>
            <?php
                echo "<p style=\"color:red\"> ". $msg_username . "</p>"
            ?>
            <p>
                <label class="floatLabel">UserName</label>
                <input name="username" type="text" required>
            </p>
            <p>
                <label for="password" class="floatLabel">Password</label>
                <input name="password" type="password" required>
            </p>
            <?php
                if(!isset($success)){
                    echo "<p style=\"color:gray; font-size: 85%\"> ". $msg_weak_passowrd . "</p>";
                }elseif($success == false){
                    echo "<p style=\"color:red; font-size: 85%\"> ". $msg_weak_passowrd . "</p>";
                }
            ?>
            <p>
                <label for="confirm_password" class="floatLabel">Confirm Password</label>
                <input name="confirm_password" type="password" required>
            </p>
            <?php
                echo "<p style=\"color:red\"> ". $msg_confirmation_password . "</p>";
                if(isset($success) && $success == true){
                    echo "<p class=\"message\">Create success <a href=\"index.php\">Login</a></p>";
                }
            ?>
            <p>
                <input type="submit" name="Create My Account">
            </p>
      </form>
    </body>
</html>	

