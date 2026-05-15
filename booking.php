<?php

include "config.php";
session_start();

/* ================= FETCH VEHICLE ================= */

if (isset($_GET['vehicle_id'])) {

    $id = intval($_GET['vehicle_id']);

    $sql = "SELECT *,
            C.city,
            B.brand

            FROM vehicles V

            LEFT JOIN city_master C
            ON V.city = C.id

            LEFT JOIN brand_master B
            ON V.brand = B.id

            WHERE V.id='$id'";

    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {

        $row = mysqli_fetch_assoc($res);
    } else {

        die("Vehicle Not Found");
    }
} else {

    die("Invalid Request");
}

/* ================= USER ================= */

if (isset($_SESSION['user_id'])) {

    $user_id = $_SESSION['user_id'];

    $user_query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE id='$user_id'"
    );

    $user = mysqli_fetch_assoc($user_query);
}

/* ================= BOOKING INSERT ================= */

if (isset($_POST['confirm_booking'])) {

    $vehicle_id = $id;

    $pickup_date = $_POST['startDate'];

    $return_date = $_POST['endDate'];

    $location = mysqli_real_escape_string($conn, $_POST['pickupLocation']);

    $days = $_POST['days'];

    $total = $_POST['total'];

    $user_id = $_SESSION['user_id'];

    $insert = "INSERT INTO bookings

    (vehicle_id,user_id,pickup_date,
    return_date,location,days,total_price,status)

    VALUES

    ('$vehicle_id','$user_id',
    '$pickup_date','$return_date',
    '$location','$days','$total','Pending')";

    if (mysqli_query($conn, $insert)) {

        echo "

        <script>

        alert('Booking Confirmed Successfully');

        window.location='booking_history.php';

        </script>

        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Book Vehicle</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="preconnect"
        href="https://fonts.googleapis.com">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {

            font-family: 'Poppins', sans-serif;

            background:
                linear-gradient(135deg,
                    #f4f7fb,
                    #eef2f9,
                    #f8fbff);

            min-height: 100vh;

            overflow-x: hidden;

            position: relative;
        }

        /* ================= BACKGROUND EFFECT ================= */

        body::before {

            content: '';

            position: fixed;

            width: 350px;

            height: 350px;

            background:
                rgba(13, 110, 253, 0.05);

            border-radius: 50%;

            top: -120px;

            right: -120px;

            z-index: -1;
        }

        body::after {

            content: '';

            position: fixed;

            width: 300px;

            height: 300px;

            background:
                rgba(37, 211, 102, 0.05);

            border-radius: 50%;

            bottom: -100px;

            left: -100px;

            z-index: -1;
        }

        /* ================= NAVBAR ================= */

        .navbar {

            background:
                rgba(0, 0, 0, 0.85);

            backdrop-filter: blur(10px);

            padding: 14px 0;

            position: sticky;

            top: 0;

            z-index: 1000;

            box-shadow:
                0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .navbar-brand {

            color: #fff !important;

            font-size: 32px;

            font-weight: 700;
        }

        .nav-link {

            color: #ddd !important;

            font-size: 17px;

            margin-left: 18px;

            font-weight: 500;

            position: relative;

            transition: 0.3s;
        }

        .nav-link:hover {

            color: #fff !important;
        }

        .nav-link::after {

            content: '';

            position: absolute;

            width: 0%;

            height: 2px;

            background: #0d6efd;

            left: 0;

            bottom: -5px;

            transition: 0.3s;
        }

        .nav-link:hover::after {

            width: 100%;
        }

        /* ================= MAIN ================= */

        .main-box {

            background:
                rgba(255, 255, 255, 0.92);

            backdrop-filter: blur(10px);

            border-radius: 28px;

            padding: 20px;

            box-shadow:
                0 15px 40px rgba(0, 0, 0, 0.08);
        }

        /* ================= LEFT ================= */

        .left-section {

            display: flex;

            flex-direction: column;

            justify-content: center;

            height: 100%;
        }

        /* ================= IMAGE ================= */

        .vehicle-img {

            width: 100%;

            height: 240px;

            object-fit: contain;

            border-radius: 18px;
        }

        /* ================= TITLE ================= */

        .vehicle-title {

            font-size: 28px;

            font-weight: 700;

            margin-top: 12px;

            margin-bottom: 5px;

            color: #111;
        }

        .vehicle-price {

            color: #28a745;

            font-size: 22px;

            font-weight: 700;
        }

        /* ================= SUMMARY ================= */

        .summary-box {

            background: #f8fbff;

            padding: 22px;

            border-radius: 22px;

            border:
                1px solid rgba(0, 0, 0, 0.05);

            position: sticky;

            top: 95px;
        }

        .summary-box h4 {

            font-weight: 700;

            margin-bottom: 12px;

            font-size: 28px;

            color: #111;
        }

        /* ================= FORM ================= */

        .form-control {

            height: 44px;

            font-size: 14px;

            border-radius: 14px;

            border:
                1px solid #ddd;

            box-shadow: none;

            font-size: 15px;
        }

        .form-control:focus {

            border-color: #0d6efd;

            box-shadow: none;
        }

        label {

            font-weight: 600;

            margin-bottom: 8px;

            color: #222;
        }

        /* ================= BUTTONS ================= */

        .btn-calculate {

            height: 44px;

            border: none;

            border-radius: 14px;

            font-weight: 600;

            background: #111;

            color: #fff;

            transition: 0.3s;
        }

        .btn-calculate:hover {

            background: #000;

            transform: translateY(-2px);
        }

        .btn-confirm {

            height: 46px;

            border: none;

            border-radius: 14px;

            font-weight: 600;

            background:
                linear-gradient(45deg,
                    #0d6efd,
                    #00bfff);

            transition: 0.3s;

            color: white;
        }

        .btn-confirm:hover {

            transform: translateY(-2px);

            color: white;
        }

        /* ================= PRICE ================= */

        .total-price {

            font-size: 30px;

            font-weight: 700;

            color: #28a745;
        }

        /* ================= MODAL ================= */

        .modal-content {

            border: none;

            border-radius: 25px;

            padding: 10px;
        }

        .modal-header {

            border: none;
        }

        .modal-footer {

            border: none;
        }

        /* ================= RESPONSIVE ================= */

        @media(max-width:768px) {

            .vehicle-img {

                height: 200px;
            }

            .vehicle-title {

                font-size: 24px;

                margin-top: 8px;
            }

            .summary-box {

                margin-top: 30px;

                position: static;
            }

            .navbar-brand {

                font-size: 26px;
            }
        }

        /* ================= FOOTER ================= */

        footer {

            background: #111;

            color: white;

            text-align: center;

            padding: 28px;

            margin-top: 80px;
        }
    </style>

</head>

<body>

    <!-- ================= NAVBAR ================= -->

    <nav class="navbar navbar-expand-lg">

        <div class="container">

            <a class="navbar-brand"
                href="index.php">

                🚗 RentRide

            </a>

            <div class="ms-auto">

                <a class="nav-link d-inline"
                    href="index.php">

                    Home

                </a>

                <?php if (isset($_SESSION['user_id'])) { ?>

                    <a class="nav-link d-inline"
                        href="booking_history.php">

                        My Bookings

                    </a>

                    <a class="nav-link d-inline"
                        href="userlogout.php">

                        Logout

                    </a>

                <?php } else { ?>

                    <a class="nav-link d-inline"
                        href="loginpage.php">

                        Login

                    </a>

                    <a class="nav-link d-inline"
                        href="signup.html">

                        Signup

                    </a>

                <?php } ?>

            </div>
        </div>
    </nav>

    <!-- ================= MAIN ================= -->

    <div class="container my-5">

        <div class="main-box">

            <div class="row align-items-center g-3">

                <!-- ================= LEFT ================= -->

                <div class="col-lg-6 left-section">

                    <img src="uploads/<?php echo $row['image']; ?>"
                        class="vehicle-img">

                    <h2 class="vehicle-title">

                        <?php echo $row['brand']; ?>
                        -
                        <?php echo $row['name']; ?>

                    </h2>

                    <p class="text-muted mb-2">

                        📍 <?php echo $row['city']; ?>

                    </p>

                    <div class="vehicle-price">

                        ₹<?php echo $row['price']; ?> / day

                    </div>

                </div>

                <!-- ================= RIGHT ================= -->

                <div class="col-lg-6">

                    <div class="summary-box">

                        <h4>Booking Details</h4>

                        <label>Pickup Date</label>

                        <input type="date"
                            id="startDate"
                            class="form-control mb-3"
                            min="<?php echo date('Y-m-d'); ?>">

                        <label>Return Date</label>

                        <input type="date"
                            id="endDate"
                            class="form-control mb-3"
                            min="<?php echo date('Y-m-d'); ?>">

                        <label>Pickup Location</label>

                        <input type="text"
                            id="pickupLocation"
                            class="form-control mb-3"
                            placeholder="Enter pickup location">

                        <button onclick="calculatePrice()"
                            class="btn btn-calculate w-100 mb-4">

                            Calculate Price

                        </button>

                        <hr>

                        <p>

                            <b>Price Per Day:</b>

                            ₹<?php echo $row['price']; ?>

                        </p>

                        <p>

                            <b>Total Days:</b>

                            <span id="days">0</span>

                        </p>

                        <h3 class="total-price">

                            ₹<span id="total">0</span>

                        </h3>

                        <?php if (isset($_SESSION['user_id'])) { ?>

                            <button onclick="openSummary()"
                                class="btn btn-confirm w-100 mt-3">

                                Confirm Booking

                            </button>

                        <?php } else { ?>

                            <a href="loginpage.php?vehicle_id=<?php echo $id; ?>"

                                class="btn btn-confirm w-100 mt-3
d-flex align-items-center justify-content-center">

                                Login To Book

                            </a>

                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= MODAL ================= -->

    <div class="modal fade"
        id="summaryModal">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-header">

                    <h4 class="fw-bold">

                        Booking Summary

                    </h4>

                    <button class="btn-close"
                        data-bs-dismiss="modal"></button>

                </div>

                <div class="modal-body">

                    <p>

                        <b>Name:</b>

                        <?php echo $user['name']; ?>

                    </p>

                    <p>

                        <b>Mobile:</b>

                        <?php echo $user['mobile']; ?>

                    </p>

                    <p>

                        <b>Vehicle:</b>

                        <?php echo $row['brand']; ?>
                        <?php echo $row['name']; ?>

                    </p>

                    <p>

                        <b>Pickup:</b>

                        <span id="sumStart"></span>

                    </p>

                    <p>

                        <b>Return:</b>

                        <span id="sumEnd"></span>

                    </p>

                    <p>

                        <b>Location:</b>

                        <span id="sumLocation"></span>

                    </p>

                    <p>

                        <b>Total Days:</b>

                        <span id="sumDays"></span>

                    </p>

                    <h3 class="text-success">

                        ₹<span id="sumTotal"></span>

                    </h3>

                </div>

                <div class="modal-footer">

                    <form method="post"
                        class="w-100">

                        <input type="hidden"
                            name="startDate"
                            id="inputStart">

                        <input type="hidden"
                            name="endDate"
                            id="inputEnd">

                        <input type="hidden"
                            name="pickupLocation"
                            id="inputLocation">

                        <input type="hidden"
                            name="days"
                            id="inputDays">

                        <input type="hidden"
                            name="total"
                            id="inputTotal">

                        <button type="submit"
                            name="confirm_booking"
                            class="btn btn-confirm w-100">

                            Confirm Booking

                        </button>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- ================= FOOTER ================= -->

    <footer>

        <h5>
            🚗 RentRide
        </h5>

        <p class="mb-0">
            © 2026 All Rights Reserved | Designed By Deekesh
        </p>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        /* ================= TODAY DATE ================= */

        let today = new Date().toISOString().split("T")[0];

        document.getElementById("startDate").setAttribute("min", today);

        document.getElementById("endDate").setAttribute("min", today);

        /* ================= RETURN DATE CONTROL ================= */

        document.getElementById("startDate")
            .addEventListener("change", function() {

                document.getElementById("endDate")
                    .setAttribute("min", this.value);
            });

        /* ================= CALCULATE ================= */

        function calculatePrice() {

            let start =
                document.getElementById("startDate").value;

            let end =
                document.getElementById("endDate").value;

            let location =
                document.getElementById("pickupLocation").value;

            if (start == "" || end == "" || location == "") {

                alert("Please fill all fields");

                return;
            }

            let d1 = new Date(start);

            let d2 = new Date(end);

            let diff =
                (d2 - d1) / (1000 * 60 * 60 * 24);

            if (diff <= 0) {

                alert("Return date must be after pickup date");

                return;
            }

            let price =
                <?php echo $row['price']; ?>;

            let total = diff * price;

            document.getElementById("days").innerText = diff;

            document.getElementById("total").innerText = total;
        }

        /* ================= MODAL ================= */

        function openSummary() {

            let days =
                document.getElementById("days").innerText;

            if (days == 0) {

                alert("Please calculate price first");

                return;
            }

            let start =
                document.getElementById("startDate").value;

            let end =
                document.getElementById("endDate").value;

            let location =
                document.getElementById("pickupLocation").value;

            let total =
                document.getElementById("total").innerText;

            document.getElementById("sumStart").innerText = start;

            document.getElementById("sumEnd").innerText = end;

            document.getElementById("sumLocation").innerText = location;

            document.getElementById("sumDays").innerText = days;

            document.getElementById("sumTotal").innerText = total;

            /* hidden fields */

            document.getElementById("inputStart").value = start;

            document.getElementById("inputEnd").value = end;

            document.getElementById("inputLocation").value = location;

            document.getElementById("inputDays").value = days;

            document.getElementById("inputTotal").value = total;

            let modal =
                new bootstrap.Modal(
                    document.getElementById('summaryModal')
                );

            modal.show();
        }
    </script>

</body>

</html>