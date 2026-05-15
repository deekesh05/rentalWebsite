<?php
include "config.php";
session_start();

/* ================= VEHICLE ID ================= */

if(isset($_GET['vehicle_id'])){
    $vehicle_id = $_GET['vehicle_id'];
}else{
    $vehicle_id = 0;
}

/* ================= LOGIN AUTH ================= */

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $vehicle_id = $_POST['vehicle_id'];

    $sql = "SELECT * FROM users
            WHERE email='$email'
            AND password='$password'";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) > 0){

        $user = mysqli_fetch_assoc($result);

        /* SESSION */

        $_SESSION['user'] = $user['name'];
        $_SESSION['user_id'] = $user['id'];

        /* REDIRECT */

        if($vehicle_id != 0){

            header("Location: booking.php?vehicle_id=$vehicle_id");

        }else{

            header("Location: index.php");

        }

        exit();

    }else{

        $error = "Invalid Email or Password";

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>RentRide Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="preconnect"
href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background:
    linear-gradient(
    rgba(0,0,0,0.55),
    rgba(0,0,0,0.7)
    ),

    url('https://images.unsplash.com/photo-1492144534655-ae79c964c9d7')
    center/cover no-repeat;

    overflow:hidden;
}

/* ================= LOGIN CARD ================= */

.login-container{

    width:100%;
    max-width:430px;

    padding:40px;

    border-radius:22px;

    background:
    rgba(255,255,255,0.12);

    backdrop-filter:blur(14px);

    border:
    1px solid rgba(255,255,255,0.2);

    box-shadow:
    0 15px 40px rgba(0,0,0,0.3);

    color:white;

    animation:fadeIn 0.8s ease;
}

/* ================= TITLE ================= */

.logo{

    text-align:center;
    font-size:42px;

    margin-bottom:10px;
}

h2{

    text-align:center;

    font-weight:700;

    margin-bottom:8px;
}

.subtitle{

    text-align:center;

    color:#ddd;

    margin-bottom:30px;

    font-size:15px;
}

/* ================= INPUT ================= */

.form-control{

    height:55px;

    border-radius:12px;

    border:none;

    background:
    rgba(255,255,255,0.18);

    color:white;

    padding-left:15px;

    margin-bottom:18px;
}

.form-control::placeholder{

    color:#ddd;
}

.form-control:focus{

    background:
    rgba(255,255,255,0.28);

    color:white;

    box-shadow:none;

    border:
    1px solid rgba(255,255,255,0.4);
}

/* ================= BUTTON ================= */

.btn-login{

    height:55px;

    border-radius:12px;

    border:none;

    font-size:17px;

    font-weight:600;

    background:#0d6efd;

    color:white;

    transition:0.3s;
}

.btn-login:hover{

    transform:translateY(-2px);

    background:#0b5ed7;
}

/* ================= ALERT ================= */

.alert{

    border-radius:12px;
}

/* ================= LINK ================= */

.signup-text{

    text-align:center;

    margin-top:20px;

    color:#eee;
}

.signup-text a{

    color:#fff;

    font-weight:600;

    text-decoration:none;
}

.signup-text a:hover{

    text-decoration:underline;
}

/* ================= ANIMATION ================= */

@keyframes fadeIn{

    from{
        opacity:0;
        transform:translateY(20px);
    }

    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* ================= MOBILE ================= */

@media(max-width:500px){

    .login-container{

        margin:20px;

        padding:30px 25px;
    }

    h2{
        font-size:28px;
    }
}

</style>

</head>

<body>

<div class="login-container">

<div class="logo">
<h2>🚗RentRide</h2>
</div>

<h2>Welcome Back</h2>

<p class="subtitle">
Login to continue your journey with RentRide
</p>

<!-- ERROR -->

<?php if(isset($error)){ ?>

<div class="alert alert-danger text-center">

<?php echo $error; ?>

</div>

<?php } ?>

<!-- FORM -->

<form method="POST">

<input type="email"
name="email"
placeholder="Enter Your Email"
class="form-control"
required>

<input type="password"
name="password"
placeholder="Enter Your Password"
class="form-control"
required>

<input type="hidden"
name="vehicle_id"
value="<?php echo $vehicle_id; ?>">

<button type="submit"
name="login"
class="btn btn-login w-100">

Login

</button>

</form>

<p class="signup-text">

Don't have an account?

<a href="signup.html">

Signup

</a>

</p>

</div>

</body>
</html>