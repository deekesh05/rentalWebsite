<?php

include "config.php";

if(isset($_POST['signup'])){

    /* GET DATA */

    $name = mysqli_real_escape_string($conn, $_POST['name']);

    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);

    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $password = mysqli_real_escape_string($conn, $_POST['password']);

    /* CHECK EMAIL */

    $check = mysqli_query($conn,
    "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){

        echo "<script>

        alert('Email Already Exists');

        window.location='signup.html';

        </script>";

    }else{

        /* INSERT */

        $sql = "INSERT INTO users
        (name, mobile, email, password)

        VALUES

        ('$name','$mobile','$email','$password')";

        if(mysqli_query($conn, $sql)){

            echo "<script>

            alert('Signup Successful');

            window.location='loginpage.php';

            </script>";

        }else{

            echo "<script>

            alert('Something Went Wrong');

            window.location='signup.html';

            </script>";
        }
    }
}
?>