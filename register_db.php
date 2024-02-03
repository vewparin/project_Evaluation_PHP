<?php
    // session_start();
    // include('server.php');

    // $errors =array();

    // if(isset($_POST['reg_user'])){
    //     $username = mysqli_real_escape_string($conn, $_POST['username']);
    //     $email = mysqli_real_escape_string($conn, $_POST['email']);
    //     $password1 = mysqli_real_escape_string($conn, $_POST['password1']);
    //     $password2 = mysqli_real_escape_string($conn, $_POST['password2']);


    //     if(empty($username)){
    //         array_push($errors,"Username is required");
    //     }
    //     if(empty($email)){
    //         array_push($errors,"Email is required");
    //     }
    //     if(empty($password1)){
    //         array_push($errors,"Password is required");
    //     }
    //     if($password1 != $password2){
    //         array_push($errors,"The two passwords do not match");
    //     }

    //     $user_check_query = "SELECT * FROM user WHERE username = '$username' OR email = '$email'";
    //     $query = mysqli_query($conn,$user_check_query);
    //     $result = mysqli_fetch_assoc($query);

    //     if($result){
    //         if($result['username'] === $username){
    //             array_push($errors,"Username already exits");
    //         }
    //         if($result['email'] === $email){
    //             array_push($errors,"Email already exits");
    //         }
    //     }


    // }

?>