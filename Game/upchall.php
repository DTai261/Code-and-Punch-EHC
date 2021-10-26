<?php
include "../config.php";
include 'chall.php'; 

$teacher = $_SESSION['username'];
// Đường dẫn để lưu trữ file đó
$folder_path = "challenge/";
$file_path = $folder_path . $_FILES["LoadFile"]["name"];
$file_type = $_FILES["LoadFile"]["type"];

// Lấy tất cả thông tin từ form điền
$hints=$_POST["hints"];
$challenge=($_FILES["LoadFile"]["name"]);

$con12 = $db;
// check sql 
$teacher = mysqli_real_escape_string($db, $teacher);
$hints= mysqli_real_escape_string($db, $hints);
$challenge= mysqli_real_escape_string($db, $challenge);
// Lưu thông tin challenge(chính là câu trả lời) và hints vào database
$sql = "INSERT INTO challenge (challenge,hints,teacher) VALUES ('$challenge', '$hints', '$teacher')";
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