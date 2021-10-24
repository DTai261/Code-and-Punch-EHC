<?php
include "config.php";
session_start();
error_reporting(0); 
$error = false;
$msg = "";
$db=mysqli_connect('localhost', 'root', '','demo');
if($_SERVER["REQUEST_METHOD"]=="POST")
{
	$username=$_POST["username"];
	$password=$_POST["password"];
  
	  // check sql injection
    $username= mysqli_real_escape_string($db, $username );
    $password= mysqli_real_escape_string($db, $password);
   
     $sql="select * from user where username='".$username."' AND password='".$password."'";
     $result=mysqli_query($db,$sql);
     $row=mysqli_fetch_array($result);

	if($row["usertype"]=="student"){	

		$_SESSION["username"]=$username;
    $_SESSION["usertype"] = "student";

		header("location:StudentHomePage");
	}

	elseif($row["usertype"]=="teacher"){

		$_SESSION["username"]=$username;
    $_SESSION["usertype"] = "teacher";

		header("location:TeacherHomepage");
	}

	else{
		$msg = "username or password is incorrect";
	}

}

?>


<!-- HTML -->
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/Login.css">
        <style>
          h1{
            text-align: center;
            font-weight:bold;
            margin: 50 auto -70px;
          }
        </style>
    </head>
    <body>
        <h1>Welcome to Students management page!</h1>
        <div class="login-page">
            <div class="form">
              <form class="login-form" method="POST" action="#">
                <?php
                  echo "<p style=\"color: red\">". $msg . "</p>";
                ?>
                <input type="text" placeholder="username" name="username"/ required>
                <input type="password" placeholder="password" name="password"/ required>
                <button>login</button>
                <p class="message">Not registered? <a href="signup.php">Signup as Teacher</a></p>
              </form>
            </div>
          </div>
    </body>
</html>

