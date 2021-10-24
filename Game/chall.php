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
    <link rel="stylesheet" href="../css/Homepage.css">
  </head>
  <body>
    
  <form action="../TeacherHomepage">
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
      <input type="hidden" name="size" value="35000">
      <input type="file" name="LoadFile" id="LoadFile"> 
      <br></br>
      <input TYPE="submit" name="submit" value="Add Challenge"/>
    </form>
  </body>
</html>