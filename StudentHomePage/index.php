
<?php
    include "../config.php";
    session_start();

    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "student")
    {
        header("location: ..");
    }
?>
<html>
    <head>
        <title>Student Home Page</title>
        <link rel="stylesheet" href="../css/Homepage.css">
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
            <form action="ListOfAssignment.php">
                <button class="button" style="background: Green;">List of assignments </button>
            </form>
        </div>
        <div class="container">
            <form action="../Game/stu_answer.php">
                <button class="button" style="background: #9BE017;">Games </button>
            </form>
        </div><div class="container">
            <form action="#">
                <button class="button" style="background: #00FED2;">views message</button>
            </form>
        </div>
        <div class="container">
            <form action="UpdateProfile.php" method="get">
                <input type="hidden" name="username" value="<?php echo $_SESSION["username"]; ?>"/>
                <button type="submit" class="button" style="background: #EBF50C;">UPDATE YOUR PROFILE</button>           
            </form>
        </div>
        <div class="container">
            <form action="../logout.php">
                <button class="button" style="background: #FE00B5;">Sign out </button>
            </form>
        </div>
    </body>
</html>