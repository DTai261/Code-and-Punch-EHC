<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<form action="../StudentHomePage">
      <input class="btn btn-success" type="submit" value="Go back!" >
  </form>
<?php
include "../config.php";
require_once('../dbhelp.php');
error_reporting(0);
session_start();
if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "student")
{
    header("location: ..");
}
$teacher = get_teacher($db, $_SESSION["username"]);
$conn = $db;

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$teacher= mysqli_real_escape_string($db, $teacher);
$sql = "SELECT hints from challenge WHERE teacher='$teacher' ORDER BY chalID DESC LIMIT 1";
mysqli_query($conn, $sql);
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

  while($row = mysqli_fetch_assoc($result)) {
    echo "hints: " . $row["hints"];
  }
} else {
  echo "Error!!!";
}

mysqli_close($conn);
?>
<?php
if (isset($_POST["btn_submit"])) {
$answer = $_POST["answer"];
		if ($answer == "") {
			echo "Answer is empty!!!";
		}else{
			$myfile = fopen("challenge/$answer.txt", "r");
			if($myfile){
      echo "<br>";
			echo "<br>Congratulation! Your answer is CORRECT!<br>";
			echo fread($myfile,filesize("challenge/$answer.txt"));
			fclose($myfile);
			}
			else{
			echo "<br>INCORRECT ANSWER!!!<br>";
			}
		}
}
?>
<form method="POST" action="stu_answer.php">
    <table class="table">
        <tr class="table-success">
            <td>Your answer</td>
        </tr>
        <tr class="table-success">
            <td align="left"><input type="text" name="answer" size="50"></td>
        </tr>
        <tr class="table-success">
            <td  > <input name="btn_submit" type="submit" value="Submit"></td>
        </tr>
    </table>
</form>
</body>
</html>