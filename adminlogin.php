<?php
session_start();

$error = "";

if (isset($_POST['login'])) {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Demo Admin Login
    // Later you can connect database here

    if ($username === "admin" && $password === "1234") {

        $_SESSION['admin'] = true;
        $_SESSION['admin_name'] = "Administrator";

        header("Location: dashboard.php");
        exit();

    } else {
        $error = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>RentRide Admin Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            min-height: 100vh;
            background:
                linear-gradient(rgba(0, 0, 0, 0.5),
                    rgba(0, 0, 0, 0.6)),
                url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?q=80&w=2070&auto=format&fit=crop');

            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 1100px;
            min-height: 620px;
            display: flex;
            border-radius: 25px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }

        /* LEFT SIDE */

        .left-panel {
            flex: 1;
            padding: 60px;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: linear-gradient(to bottom right,
                    rgba(102, 126, 234, 0.7),
                    rgba(118, 75, 162, 0.7));
        }

        .brand {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .tagline {
            font-size: 18px;
            line-height: 1.8;
            color: #f1f1f1;
            max-width: 500px;
        }

        .features {
            margin-top: 40px;
        }

        .feature-item {
            margin-bottom: 18px;
            font-size: 16px;
        }

        .feature-item i {
            margin-right: 10px;
            color: #fff;
        }

        /* RIGHT SIDE */

        .right-panel {
            width: 420px;
            background: rgba(255, 255, 255, 0.95);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }

        .login-box {
            width: 100%;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            margin-bottom: 20px;
            color: white;
            font-size: 35px;
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .login-title {
            text-align: center;
            font-size: 30px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #222;
        }

        .login-subtitle {
            text-align: center;
            color: #777;
            margin-bottom: 35px;
            font-size: 14px;
        }

        .form-group {
            position: relative;
            margin-bottom: 22px;
        }

        .form-group i {
            position: absolute;
            top: 15px;
            left: 15px;
            color: #777;
        }

        .form-control {
            height: 52px;
            padding-left: 45px;
            border-radius: 12px;
            border: 1px solid #ddd;
            transition: 0.3s;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 10px rgba(102, 126, 234, 0.3);
        }

        .login-btn {
            width: 100%;
            height: 52px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            font-weight: 600;
            font-size: 16px;
            transition: 0.3s;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .alert {
            border-radius: 10px;
            font-size: 14px;
        }

        .footer-text {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #888;
        }

        /* Responsive */

        @media(max-width: 992px) {

            .login-container {
                flex-direction: column;
            }

            .left-panel {
                display: none;
            }

            .right-panel {
                width: 100%;
                padding: 30px;
            }
        }
    </style>

</head>

<body>

    <div class="login-container">

        <!-- LEFT PANEL -->

        <div class="left-panel">

            <h1 class="brand">RentRide</h1>

            <p class="tagline">
                Smart Vehicle Rental Management System for seamless bookings,
                vehicle tracking, customer management, and admin control.
            </p>

            <div class="features">

                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    Manage Vehicles & Bookings
                </div>

                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    Secure Admin Dashboard
                </div>

                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    Fast & Responsive System
                </div>

                <div class="feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    Professional Rental Management
                </div>

            </div>

        </div>

        <!-- RIGHT PANEL -->

        <div class="right-panel">

            <div class="login-box">

                <div class="login-logo">
                    <i class="bi bi-shield-lock-fill"></i>
                </div>

                <h2 class="login-title">Admin Login</h2>

                <p class="login-subtitle">
                    Access RentRide Administration Panel
                </p>

                <?php if ($error != "") { ?>

                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>

                <?php } ?>

                <form method="POST">

                    <div class="form-group">

                        <i class="bi bi-person-fill"></i>

                        <input type="text"
                            name="username"
                            class="form-control"
                            placeholder="Enter Username"
                            required>

                    </div>

                    <div class="form-group">

                        <i class="bi bi-lock-fill"></i>

                        <input type="password"
                            name="password"
                            class="form-control"
                            placeholder="Enter Password"
                            required>

                    </div>

                    <button type="submit"
                        name="login"
                        class="login-btn">

                        <i class="bi bi-box-arrow-in-right"></i>
                        Login to Dashboard

                    </button>

                </form>

                <div class="footer-text">
                    © 2026 RentRide. All Rights Reserved.
                </div>

            </div>

        </div>

    </div>

</body>

</html>