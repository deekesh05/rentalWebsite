<?php

include "config.php";
session_start();

/* ================= FETCH VEHICLE ================= */

if(isset($_GET['vehicle_id'])){

    $id = intval($_GET['vehicle_id']);

    $sql = "SELECT *,
            C.city,
            B.brand,
            V.id as vehicle_id

            FROM vehicles V

            LEFT JOIN city_master C
            ON V.city = C.id

            LEFT JOIN brand_master B
            ON V.brand = B.id

            WHERE V.id = '$id'";

    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0){

        $row = mysqli_fetch_assoc($res);

    }else{

        die("Vehicle Not Found");
    }

}else{

    die("Invalid Request");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Vehicle Details</title>

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
}

body{

    font-family:'Poppins',sans-serif;

    background:

    linear-gradient(
    135deg,
    #f4f7fb,
    #eef2f9,
    #f8fbff
    );

    min-height:100vh;

    overflow-x:hidden;

    position:relative;
}

/* ================= BACKGROUND EFFECT ================= */

body::before{

    content:'';

    position:fixed;

    width:350px;

    height:350px;

    background:
    rgba(13,110,253,0.05);

    border-radius:50%;

    top:-120px;

    right:-120px;

    z-index:-1;
}

body::after{

    content:'';

    position:fixed;

    width:300px;

    height:300px;

    background:
    rgba(37,211,102,0.05);

    border-radius:50%;

    bottom:-100px;

    left:-100px;

    z-index:-1;
}

/* ================= NAVBAR ================= */

.navbar{

    background:
    rgba(0,0,0,0.85);

    backdrop-filter:blur(10px);

    padding:12px 0;

    position:sticky;

    top:0;

    z-index:1000;

    box-shadow:
    0 4px 20px rgba(0,0,0,0.15);
}

.navbar-brand{

    color:#fff !important;

    font-size:30px;

    font-weight:700;
}

.nav-link{

    color:#ddd !important;

    font-size:17px;

    margin-left:18px;

    font-weight:500;

    position:relative;

    transition:0.3s;
}

.nav-link:hover{

    color:#fff !important;
}

.nav-link::after{

    content:'';

    position:absolute;

    width:0%;

    height:2px;

    background:#0d6efd;

    left:0;

    bottom:-5px;

    transition:0.3s;
}

.nav-link:hover::after{

    width:100%;
}

/* ================= MAIN CARD ================= */

.vehicle-card{

    background:
    rgba(255,255,255,0.9);

    backdrop-filter:blur(10px);

    border-radius:28px;

    padding:35px;

    box-shadow:
    0 15px 40px rgba(0,0,0,0.08);

    transition:0.4s;
}

.vehicle-card:hover{

    transform:translateY(-5px);
}

/* ================= IMAGE ================= */

.vehicle-img{

    width:100%;

    height:320px;

    object-fit:contain;

    border-radius:20px;

    transition:0.4s;
}

.vehicle-img:hover{

    transform:scale(1.03);
}

/* ================= DETAILS ================= */

.badge-city{

    background:#6c757d;

    color:white;

    padding:8px 14px;

    border-radius:10px;

    font-size:14px;

    font-weight:500;
}

.vehicle-title{

    font-size:42px;

    font-weight:700;

    color:#111;

    margin-top:15px;
}

.price{

    font-size:30px;

    color:#28a745;

    font-weight:700;

    margin-top:10px;
}

.description{

    color:#666;

    font-size:16px;

    line-height:1.6;

    margin-top:14px;
}
/* ================= SPECS ================= */

.spec-box{

    background:
    rgba(248,249,250,0.9);

   
    padding:18px;

    margin-top:18px;

    border-radius:18px;

    border:
    1px solid rgba(0,0,0,0.05);

   
}

.spec-box p{

    margin-bottom:14px;

    font-size:17px;

    color:#333;
}

/* ================= BUTTON ================= */

.btn-book{

    background:

    linear-gradient(
    45deg,
    #0d6efd,
    #00bfff
    );

    border:none;

    border-radius:15px;

    color:white !important;

    font-size:20px;

    font-weight:600;

    padding:15px;

    margin-top:18px;

    transition:0.3s;

    box-shadow:
    0 8px 25px rgba(13,110,253,0.3);

    text-decoration:none;

    display:flex;

    align-items:center;

    justify-content:center;

    gap:10px;
}

.btn-book:hover{

    transform:translateY(-3px);

    box-shadow:
    0 12px 30px rgba(13,110,253,0.4);
}

/* ================= RESPONSIVE ================= */

@media(max-width:992px){

    .vehicle-title{

        font-size:34px;
    }

    .price{

        font-size:30px;
    }
}

@media(max-width:768px){

    .vehicle-card{

        padding:20px;
    }

    .vehicle-title{

        font-size:28px;
    }

    .vehicle-img{

        height:320px;
    }
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

<?php if(isset($_SESSION['user_id'])){ ?>

<a class="nav-link d-inline"
href="booking_history.php">

My Bookings

</a>

<a class="nav-link d-inline"
href="userlogout.php">

Logout

</a>

<?php }else{ ?>

<a class="nav-link d-inline"
href="loginpage.php">

Login

</a>

<a class="nav-link d-inline"
href="signup.html">

Signup

</a>

<a class="nav-link d-inline"
href="dashboard.php">

Admin Login

</a>

<?php } ?>

</div>
</div>
</nav>

<!-- ================= MAIN SECTION ================= -->

<div class="container my-5">

<div class="vehicle-card">

<div class="row align-items-center">

<!-- ================= IMAGE ================= -->

<div class="col-lg-6 mb-4 mb-lg-0">

<img src="uploads/<?php echo $row['image']; ?>"

class="vehicle-img"

onerror="this.src='https://via.placeholder.com/500x300?text=No+Image'">

</div>

<!-- ================= DETAILS ================= -->

<div class="col-lg-6">

<span class="badge-city">

📍 <?php echo $row['city']; ?>

</span>

<h1 class="vehicle-title">

<?php echo $row['brand']; ?>

-

<?php echo $row['name']; ?>

</h1>

<div class="price">

₹<?php echo $row['price']; ?>

/ day

</div>

<p class="description">

Experience smooth rides and premium comfort
with this amazing vehicle.
Perfect for city rides, long trips,
weekend adventures and daily travel.

</p>

<!-- ================= SPECS ================= -->

<div class="spec-box">

<p>

⚙️ <b>Engine:</b>

<?php echo $row['engine']; ?>

</p>

<p>

⛽ <b>Fuel:</b>

<?php echo $row['fuel']; ?>

</p>

<p>

📊 <b>Mileage:</b>

<?php echo $row['mileage']; ?>

KM/L

</p>

</div>

<!-- ================= BUTTON ================= -->

<a href="booking.php?vehicle_id=<?php echo $row['vehicle_id']; ?>"

class="btn-book">

🚗 Book Now

</a>

</div>
</div>
</div>
</div>

</body>
</html>