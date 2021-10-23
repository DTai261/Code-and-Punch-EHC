
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
  <form enctype="multipart/form-data" action="Upload.php" method="POST">
    <p>Upload your assignment</p>
    <input type="file" name="uploaded_file"></input><br />
    <input type="submit" value="Upload"></input>
  </form>
</body>
</html>