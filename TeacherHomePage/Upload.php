<?php
    include "../config.php";
    require_once("../dbhelp.php");
    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "teacher")
    {
        header("location: ..");
    }

    //create path to folder
    $Assignment_name =  $_POST["Assignment_name"];
    $teacher_name = $_SESSION["username"];
    $dir = "../Assignment/" . $teacher_name;


    //Create teacher folder to push assignment in
    if(is_dir($dir) === false )
    {
        mkdir($dir);
    }

    if(isset($_FILES["uploaded_file"])){
        $file = $_FILES["uploaded_file"];

        //file properties
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_size = $file['size'];
        $file_error = $file['error'];

        //get file extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        $allowed = array('txt', 'pdf');    

        if(in_array($file_ext, $allowed)){
            if($file_error === 0){
                if($file_size <= 10000000){
                    $new_name =  $teacher_name . "." . $Assignment_name  . "." . $file_ext;
                    $file_destination = $dir . "/" . $new_name;

                    //create folder for student to submit
                    $folder_submit = $dir . "/" . $teacher_name . "." . $Assignment_name . ".submit";
                    if(is_dir($folder_submit) === false )
                    {
                        mkdir($folder_submit);
                    }
                    
                    //check file already exist
                    if (file_exists($file_destination)){
                        header("location: UpLoadAssignment.php?msg=exist");
                    }
                    elseif(move_uploaded_file($file_tmp, $file_destination)){
                        header("location: UpLoadAssignment.php?msg=success");
                    }
                }
                else{
                    header("location: UpLoadAssignment.php?msg=size");
                }
            }
            else{
                header("location: UpLoadAssignment.php?msg=error");
            }
        }
        else{
            header("location: UpLoadAssignment.php?msg=type");
        }
    }
?>