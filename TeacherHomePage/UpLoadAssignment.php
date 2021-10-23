
<?php
    include "../config.php";
    require_once("../dbhelp.php");
    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "teacher")
    {
        header("location: ..");
    }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Upload Assignment</title>
</head>
<body>
  <form action=".">
      <input type="submit" value="Go back!" >
  </form>
  <form enctype="multipart/form-data" action="Upload.php" method="POST">
    <p>Upload your assignment</p>
    <p>Allowed file Type: PDF, TXT</p>
    <?php
      if(isset($_GET["msg"]) && $_GET["msg"] == "type"){
        echo "<p style=\"color: red\">Invalid file type, try again</p>";
      }
      if(isset($_GET["msg"]) && $_GET["msg"] == "error"){
        echo "<p style=\"color: red\">Can't upload file, try again</p>";
      }
      if(isset($_GET["msg"]) && $_GET["msg"] == "size"){
        echo "<p style=\"color: red\">File must be < 10 MB, try again</p>";
      }
      if(isset($_GET["msg"]) && $_GET["msg"] == "success"){
        echo "<p style=\"color: Green\">Upload success !</p>";
      }
      if(isset($_GET["msg"]) && $_GET["msg"] == "exist"){
        echo "<p style=\"color: red\">Assignment name already assigned, change the name</p>";
      }
    ?>
    <input type="text" name="Assignment_name" placeholder="Assigment name" required> <br>
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Upload"></input>
  </form>
</body>
</html>