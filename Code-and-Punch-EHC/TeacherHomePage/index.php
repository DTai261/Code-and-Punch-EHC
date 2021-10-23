
<?php
    include "../config.php";
    session_start();

        // &&
    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "teacher")
    {
        header("location: ..");
    }
    $_POST["type"] = "add";
?>
<html>
    <head>
        <title>Teacher Home Page</title>
        <link rel="stylesheet" href="../css/HomePage.css">
    </head>
    <body>
        <?php
            echo "<H1>Welcome ". $_SESSION["username"] . " to our class!</H1>";
        ?>
        <br><br><br>
        <div class="container">
            <form action="ListStudents.php">
                <button class="button" style="background:tomato;">List of students</button>
            </form>
        </div>
        <div class="container">
            <form action="#">
                <button class="button" style="background: Green;">List of assignments </button>
            </form>
        </div>
        <div class="container">
            <form action="../Game/chall.php">
                <button class="button" style="background: #9BE017;">Games </button>
            </form>
        </div>
        <div class="container">
            <form action="addstudent.php" method="post">
                <input type="text" name="type" value="<?=$_POST["type"]?>" style=" display : none ;" >
                <button type="submit" class="button" style="background: #EBF50C;">Add a student</button>           
            </form>
        </div>
        <div class="container">
            <form action="UpLoadAssignment.html">
                <button class="button" style="background: #0C6AF5;">Upload assignment </button>
            </form>
        </div>
        <div class="container">
            <form action="../logout.php">
                <button class="button" style="background: #FE00B5;">Sign out </button>
            </form>
        </div>
    </body>
</html>