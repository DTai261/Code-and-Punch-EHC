<?php
session_start();
if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "teacher")
    {
        header("location: ..");
    }

    $hintErr = "";
    $hint = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      if (empty($_POST["hint"])) {
        $hintErr = "Hints are required, not null.";
      } else {
        $hint = $_POST["hint"];
        //
        if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
          $usernameErr = "Only letters and numbers permitted.";
        }
      }
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Challenge</title>
    <link rel="stylesheet" href="../css/Homepage.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

  </head>
  <body>
    <br>
  <form action="../TeacherHomePage">
      <input class="btn btn-success" type="submit" value="Go back!" >
  </form>
    <form method="post" action="upchall.php" enctype="multipart/form-data">
      <p>
        Enter Game Details.
      </p>
      <p>
        Hints:
      </p>
      <input type="text" name="hints"/>
      <p>
        Please upload text file format!!!</p>
      <p>
        File:
      </p>
      <input type="text" name="user" value="<?=$teacher_username?>" style=" display : none ;" >
      <input type="hidden" name="size" value="35000">
      <input type="file" name="LoadFile" id="LoadFile"> 
      <br></br>
      <input class="btn btn-success" TYPE="submit" name="submit" value="Add Challenge"/>
    </form>
  </body>
</html>