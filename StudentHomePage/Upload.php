<?php
    include "../config.php";
    require_once("../dbhelp.php");
    session_start();
    if(!isset($_SESSION["username"]) || $_SESSION["usertype"] != "student")
    {
        header("location: ..");
    }

    //create path to folder
    $Folder_submit =  $_POST["Folder"];
    $Assignment_name = explode(".", $Folder_submit)[1];
    $student_name = $_SESSION["username"];
    $teacher_name = $_POST["teacher"];
    $dir = "../Assignment/" . $teacher_name . "/" . $Folder_submit . "/";

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
                    $new_name =  $student_name . "." . $Assignment_name  . "." . $file_ext;
                    $dir = $dir . $new_name;

                    if(move_uploaded_file($file_tmp, $dir)){
                        header("location: SubmitAssignment.php?msg=success");
                    }
                }
                else{
                    header("location: SubmitAssignment.php?msg=size");
                }
            }
            else{
                header("location: SubmitAssignment.php?msg=error");
            }
        }
        else{
            header("location: SubmitAssignment.php?msg=type");
        }
    }
?>