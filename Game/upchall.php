<?php
// include "../dbhelp.php";
include 'chall.php';
// Đường dẫn để lưu trữ file đó
$folder_path = "challenge/";
$file_path = $folder_path . $_FILES["LoadFile"]["name"];
$file_type = $_FILES["LoadFile"]["type"];

// Lấy tất cả thông tin từ form điền
$hints=$_POST["hints"];
$challenge=($_FILES["LoadFile"]["name"]);

$host = "localhost";
    $user = "root";
    $password = "";
    $db = "demo";

    // session_start();

$db = mysqli_connect($host, $user, $password, $db) or die("Cannot connect to the database");
$con12 = $db;

// Lưu thông tin challenge(chính là câu trả lời) và hints vào database
$sql = "INSERT INTO challenge (challenge,hints) VALUES ('$challenge', '$hints')";
mysqli_query($con12,$sql);

// Lưu file đó vào server
if($file_type == "text/plain"){
    if(move_uploaded_file($_FILES["LoadFile"]["tmp_name"],$file_path ))
    {

    // Thông báo với người dùng là đã upload thành công 
    echo "The file ". basename( $_FILES["LoadFile"]["name"]). " has been uploaded successfully!";
    }
    else {

    // Thông báo lỗi
    echo "Sorry, there was error when uploading your file.";
    }
}
else{
    echo '<p style="color: red">file type not valid</p>';
}

?>