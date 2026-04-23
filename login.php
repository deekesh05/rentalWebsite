

<?php
include "config.php";
session_start();

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $user = mysqli_fetch_assoc($res);

        $_SESSION['user'] = $user['id'];   // ✅ USER SESSION

            
        if (isset($_POST['vehicle_id'])) {
            $vehicle_id = $_POST['vehicle_id'];
            
            header("Location:booking.php?vehicle_id=$vehicle_id");
        } else {
            header("Location: index.php");
        }
    } else {
        echo "<script>alert('Invalid Login'); window.location='login.html';</script>";
    }
}
?>