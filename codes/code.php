<?php

session_start();
include('../database/dbcon.php');

$userid =  $_SESSION['user_info']['id'];

if(isset($_POST['reg_btn']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $con_password = mysqli_real_escape_string($con, $_POST['cpassword']);

    $email_query = "SELECT email FROM users WHERE email='$email' ";
    $email_query_run = mysqli_query($con, $email_query);

    if(mysqli_num_rows($email_query_run) == 0)
    {

        if($password != $con_password)
        {
            $_SESSION['message'] = "Passwords are different";
            header('Location: ../register.php');
            exit();
        }
        else
        {
            $hashed_pass = hash('sha512', $password);
            $data_query = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_pass')";
            $run_query = mysqli_query($con, $data_query);

            if($run_query)
            {
                $_SESSION['message'] = "Registration Successfull";
                $query_info = "SELECT * FROM users WHERE email='$email' ";
                $run_info_query = mysqli_query($con, $query_info);
                $data = mysqli_fetch_array($run_info_query);
                $id = $data['id'];
                $info_query = "INSERT INTO userinfo (ID, FirstName, LastName, Phone, Address, About, Organization, image) VALUES ('$id', 'First Name', 'Last Name', 'Phone', 'Address', 'About', 'Organization', 'default.png')";
                $runn_query = mysqli_query($con, $info_query);
                header('Location: ../login.php');
                exit();
            }
            else{
                $_SESSION['message'] = "There was a problem";
                header('Location: ../register.php');
                exit();
            }
        }
    }
    else{
        $_SESSION['message'] = "Email already taken";
        header('Location: ../register.php');
        exit();
    }
}

else if(isset($_POST['login_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $hashed_pass = hash('sha512', $password);
    // echo "$email";
    // echo "$password";
    // echo "$hashed_pass";
    $query_login = "SELECT * FROM users WHERE email='$email' ";
    $run_query = mysqli_query($con, $query_login);
    if(mysqli_num_rows($run_query) == 0)
    {
        $_SESSION['message'] = "Invalid email";
        header('Location: ../login.php');
        exit();
    }
    else
    {
        $user_data = mysqli_fetch_array($run_query);
        $real_password = $user_data['password'];
        if($hashed_pass != $real_password){
            $_SESSION['message'] = "Invalid password";
            header('Location: ../login.php');
            exit();
        }
        $_SESSION['logged_in'] = true;
        $_SESSION['user_info'] = [
            'name' => $user_data['name'],
            'email' => $user_data['email'],
            'id' => $user_data['id']
        ];
        $_SESSION['message'] = "Login Successfull";
        header('Location: ../index.php');
        exit();
    }
}

else if(isset($_POST['cus-omr-btn']))
{
    echo "here";
    $row = mysqli_real_escape_string($con, $_POST['omr-row']);
    $xm_name =  $_POST['xm-name'];
    
    $xm_code = mysqli_real_escape_string($con, $_POST['xm-code']);
    
    
    $arr = array();
    for($x=1; $x <= $row; $x++){
        $id = "id-" . (string)$x;
        if(isset($_POST[$id])){
            $val = mysqli_real_escape_string($con, $_POST[$id]);
            // array_push($arr, $val);
            $st = "qu".(string)$x;
            $arr[$st] = $val;
        }
        else{
            // array_push($arr, "X");
            $st = "qu".(string)$x;
            $arr[$st] = $val;
        }
        // echo $arr[$x];
        // echo "<br>";
    }
    $jdata = json_encode($arr);

    $db_query = "INSERT INTO exams (xmname, xmcode, noofques, json, user_id) VALUES ('$xm_name', '$xm_code', '$row', '$jdata', '$userid')";

    $run_db_query = mysqli_query($con, $db_query);

    if($run_db_query){
        
        $_SESSION['message'] = "Correct OMR Added Successfully";
        header('Location: ../score.php');
        exit();
    }
    else{
        $_SESSION['message'] = "Something Went Wrong";
        header('Location: ../correctsamplefile.php');
        exit();
    }
}

else if(isset($_POST['correct-btn']))
{
    
    $xmname = $_POST['xm-name'];

    if($xmname == "")
    {
        $_SESSION['message'] = "Exam name not provided!";
        header('Location: ../correctsamplefile.php');
        exit();
    }
    
    $xmcode = $_POST['xm-code'];
    $noq = $_POST['rows'];
    if($xmcode == "")
    {
        $_SESSION['message'] = "Exam Code not provided!";
        header('Location: ../correctsamplefile.php');
        exit();
    }
    



    if(!file_exists($_FILES['image']['tmp_name'])){
        $_SESSION['message'] = "OMR image not provided!";
        header('Location: ../correctsamplefile.php');
        exit();
    }

    $image = $_FILES['image']['name'];
    
    $folder = "../Opencv/Photos";
    $image_ex = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ex;
    move_uploaded_file($_FILES['image']['tmp_name'], $folder.'/'.$filename);

    $out = shell_exec("python final.py $filename $noq");
    $rout = str_replace('\'','"', $out);
    $jout = json_encode($rout);
    // echo $xmname."<br>";
    // echo $xmcode."<br>";
    // echo $noq."<br>";
    // echo $out;
    $query = "SELECT * FROM `exams` WHERE xmname = '$xmname' AND xmcode = '$xmcode'";
    $run_query = mysqli_query($con, $query);

    if(mysqli_num_rows($run_query) > 0)
    {
        $_SESSION['message'] = "Exam name and Exam code already used!";
        header('Location: ../correctsamplefile.php');
        exit();
    }

    $db_query = "INSERT INTO exams (xmname, xmcode, noofques, json, user_id) VALUES ('$xmname', '$xmcode', '$noq', '$rout', '$userid')";

    $run_db_query = mysqli_query($con, $db_query);

    if($run_db_query){
        
        $_SESSION['message'] = "Correct OMR Added Successfully";
        header('Location: ../score.php');
        exit();
    }
    else{
        $_SESSION['message'] = "Something Went Wrong";
        header('Location: ../correctsamplefile.php');
        exit();
    }
}

else if(isset($_POST['edit-profile']))
{
    echo "here";
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $organization = $_POST['organization'];
    $about = $_POST['about'];
    $old_image = $_POST['oldimage'];

    $image = $_FILES['image']['name'];

    $new_image = $old_image;

    if($image != ""){
        $new_image = $image;
    }

    $folder = "../images";
    $image_ex = pathinfo($new_image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ex;
    if($image == ""){
        $filename = $old_image;
    }

    $query = "UPDATE userinfo SET FirstName='$fname', LastName='$lname', Phone='$phone', Address='$address', About='$about', Organization='$organization', image='$filename' WHERE id='$id' ";
    $run_query = mysqli_query($con, $query);

    if($run_query){
        if($image != ""){
            if(file_exists("../images/".$old_image)){
                unlink("../images/".$old_image);
            }
            move_uploaded_file($_FILES['image']['tmp_name'], $folder.'/'.$filename);
        }
        $_SESSION['message'] = "Information Updated Successfully";
        header('Location: ../dashboard.php');
        exit();
    }
    else{
        $_SESSION['message'] = "Something Went Wrong";
        header('Location: ../dashboard.php');
        exit();
    }
}

else if(isset($_POST['check-btn']))
{
    echo "check";
    $xmname = $_POST['xm-name'];
    $xmcode = $_POST['xm-code'];
    $troll = $_POST['roll-no'];

    $query = "SELECT * FROM `exams` WHERE xmname = '$xmname' AND xmcode = '$xmcode'";
    $run_query = mysqli_query($con, $query);

    if(mysqli_num_rows($run_query) == 0)
    {
        $_SESSION['message'] = "Exam name and Exam code don't match!";
        header('Location: ../check.php');
        exit();
    }
    $id_table = mysqli_fetch_array($run_query);
    $id = $id_table['id'];
    echo $id;
    $cor_jsn = json_decode($id_table['json']);
    $rows = $id_table['noofques'];
    echo "<br>";
    $total = count($_FILES['images']['name']);
    $folder = "../Opencv/Photos";
    for($i=0; $i < $total; $i++){
        $image = $_FILES['images']['name'][$i];
        $image_ex = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ex;
        move_uploaded_file($_FILES['images']['tmp_name'][$i], $folder.'/'.$filename);
        
        $out = shell_exec("python final.py $filename $rows");
        $rout = str_replace('\'','"', $out);
        $jout = json_encode($rout);
        $jsn = json_decode($rout);
        $marks = 0;

        for($x=1; $x <= $rows; $x++){
            $st = "qu".(string)$x;
            if($cor_jsn->$st == "X"){
                $marks++;
            }
            else if($jsn->$st == "X"){

            }
            else if($jsn->$st == $cor_jsn->$st){
                $marks++;
            }
        }
        if($troll == ""){
            $roll = $jsn->roll;
        }
        else{
            $roll = $troll;
        }

        $db_query = "INSERT INTO result (stdID, fullmarks, obtainedmarks, id, image,  json, user_id) VALUES ('$roll', '$rows', '$marks', '$id', '$filename', '$rout', '$userid')";

        $run_db_query = mysqli_query($con, $db_query);

        if($run_db_query){
            
            
        }
        else{
            $_SESSION['message'] = "Something Went Wrong";
            header('Location: ../check.php');
            exit();
        }
        
        sleep(1);
    }
    $_SESSION['message'] = "OMR Checked Successfully";
    header('Location: ../score.php');
    exit();
}
?>