<?php


function is_exist($db, $username){
    $sql = "select * from user where username = '" .$username. "'";
    $result = mysqli_query($db, $sql);
    $rowsNum = mysqli_num_rows($result);
    if($rowsNum >= 1){
        return true;
    }else{
        return false;
    }
}

function is_valid_username($username){
    $valid_username = preg_match('@[a-z0-9_]@', $username);
    if(strlen($username) < 5 || strlen($username) > 30 || !$valid_username 
        || $username == trim($username) && strpos($username, ' ') !== false){
        return false;
    }
    else{
        return true;;
    }
}

function is_valid_fullname($fullname){
    $valid_name = preg_match('@[a-zA-Z]@', $fullname);
    if(strlen($fullname) < 5 || strlen($fullname) > 30 
            || $fullname != ucfirst($fullname) || !$valid_name){
        return false;
    }else{
        return true;
    }
}

function is_valid_phone($phone)
{
     // Allow +, - and . in phone number
     $filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
     // Remove "-" from number
     $phone_to_check = str_replace("-", "", $filtered_phone_number);
     // Check the lenght of number
     // This can be customized if you want phone number from a specific country
     if (strlen($phone_to_check) < 10 || strlen($phone_to_check) > 11) {
        return false;
     } else {
       return true;
     }
}

function insert_user($db, $values){
    $username = $values['username'];
    $password = $values["password"];
    $usertype = $values["usertype"];

    $sql_insert_tb_user = "insert into user(username, password, usertype)
            values ('$username', '$password', '$usertype')";

    $run = mysqli_query($db, $sql_insert_tb_user) or die ("insert not successful");
    
    //insert into table teacher or student depend on 'type'
    if($usertype == "teacher"){
        $name = $values["name"];

        $sql_insert_tb_teacher = "insert into teacher(username, name)
            values ('$username', '$name')";
        $run = mysqli_query($db, $sql_insert_tb_teacher) or die ("insert not successful");
        return true;
    }
    elseif($usertype == "student"){
        $fullname = $values["fullname"];
        $email = $values["email"];
        $phone = $values["phone"];
        $teacher_username = $values["teacher_username"];

        $sql_insert_tb_student = "insert into student(ID, username, fullname, phone, mail, teacher_username)
            values (NULL, '$username', '$fullname', '$phone', '$email', '$teacher_username')";
        $run = mysqli_query($db, $sql_insert_tb_student) or die ("insert not successful");
        return true;
    }else{
        return false;
    }

}

//update student's profile by teacher
function update_student($db, $current_username , $values){


    $id = $values["ID"];
    $username = $values['username'];
    $password = $values["password"];
    $usertype = $values["usertype"];
    $fullname = $values["fullname"];
    $email = $values["email"];
    $phone = $values["phone"];
    $teacher_username = $values["teacher_username"];

    if($username == $current_username){
        $sql_update_tb_user = "update user set password = '$password'
                where username = '$current_username'";
        $run = mysqli_query($db, $sql_update_tb_user) or die ("update user not successful");

        $sql_update_tb_student = "update student set fullname = '$fullname', phone = '$phone', 
            mail = '$email' where ID = '$id' and teacher_username = '$teacher_username'";

        $run = mysqli_query($db, $sql_update_tb_student) or die ("update not successful");
    }else{
        
        $run = delete_student($db, $id, $current_username);
        
        //insert student into user table
        $sql_insert_tb_user = "insert into user(username, password, usertype)
            values ('$username', '$password', '$usertype')";
        $run = mysqli_query($db, $sql_insert_tb_user) or die ("insert not successful");

        //insert student into student table
        $sql_insert_tb_student = "insert into student(ID, username, fullname, phone, mail, teacher_username)
            values ('$id', '$username', '$fullname', '$phone', '$email', '$teacher_username')";
        $run = mysqli_query($db, $sql_insert_tb_student) or die ("insert tb student not successful");

        
    }
        
    
    return true;
}

//student update their prifile
function update_profile($db, $username, $values){
    $username = $values['username'];
    $password = $values["password"];
    $usertype = $values["usertype"];
    $sql_update_tb_user = "update user set password = '$password'
                where username = '$username'";
    $run = mysqli_query($db, $sql_update_tb_user) or die ("update user not successful");

    
    $email = $values["email"];
    $phone = $values["phone"];

    $sql_update_tb_student = "update student set phone = '$phone', mail = '$email' where username = '$username'";

    $run = mysqli_query($db, $sql_update_tb_student) or die ("update not successful");
    return true;
}

function delete_student($db, $student_id, $student_username)
{
    
    $sql = "delete from student WHERE ID = '$student_id'";
    $query = mysqli_query($db, $sql);
    $sql = "delete from user where username = '$student_username'";
    $query = mysqli_query($db, $sql);
     
    return $query;
}

function check_password($db, $password){
    $number = preg_match('@[0-9]@', $password);
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    // $specialChars = preg_match('@[^\w]@', $password);
    
    if(strlen($password) < 8 || !$number || !$uppercase || !$lowercase) {
        return false;
    }else{
        return true;
    }
}

function get_all_students($db, $teacher)
{
    $sql = "select * from student where teacher_username = '". $teacher ."'";
    $query = mysqli_query($db, $sql);
    $result = array();
     
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }else{
        echo "Failed to fetch data";
    }
     
    return $result;
}

function get_all($db)
{
    $sql = "select * from student ";
    $query = mysqli_query($db, $sql);
    $result = array();
     
    if ($query){
        while ($row = mysqli_fetch_assoc($query)){
            $result[] = $row;
        }
    }else{
        echo "Failed to fetch data";
    }
     
    return $result;
}

?>
