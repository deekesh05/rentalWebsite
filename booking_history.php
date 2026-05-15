<?php

include "config.php";
session_start();

/* ================= LOGIN CHECK ================= */

if(!isset($_SESSION['user_id'])){

    header("Location: loginpage.php");
    exit();
}

/* ================= USER ================= */

$user_id = $_SESSION['user_id'];

$user_query = mysqli_query($conn,
"SELECT * FROM users WHERE id='$user_id'");

$user = mysqli_fetch_assoc($user_query);

/* ================= BOOKINGS ================= */

$sql = "SELECT B.*, V.name, V.image,
        C.city, BR.brand

        FROM bookings B

        JOIN vehicles V
        ON B.vehicle_id = V.id

        LEFT JOIN city_master C
        ON V.city = C.id

        LEFT JOIN brand_master BR
        ON V.brand = BR.id

        WHERE B.user_id = '$user_id'

        ORDER BY B.id DESC";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>My Bookings</title>

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

    background:

    linear-gradient(
    135deg,
    #f4f7fb,
    #eef2f9,
    #f8fbff
    );

    min-height:100vh;

    position:relative;

    overflow-x:hidden;
}

/* subtle circles */

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

/* ================= NAVBAR ================= */

.navbar{

    background:rgba(0,0,0,0.85);

    backdrop-filter:blur(10px);

    padding:11px 0;

    position:sticky;

    top:0;

    z-index:1000;

    box-shadow:
    0 4px 20px rgba(0,0,0,0.15);
}

.navbar-brand{

    color:#fff !important;

    font-size:28px;

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

.user-name{

    color:#00ffcc !important;

    font-weight:600;
}

/* ================= HEADER ================= */

.page-header{

    text-align:center;

    padding:50px 20px 30px;
}

.page-header h1{

    font-size:42px;

    font-weight:700;

    color:#111;
}

.page-header p{

    color:#666;

    margin-top:10px;
}

/* ================= CARD ================= */

.booking-card{

    border:none;

    border-radius:22px;

    overflow:hidden;

    background:#fff;

    transition:0.4s;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.08);

    height:100%;
}

.booking-card:hover{

    transform:translateY(-10px);

    box-shadow:
    0 18px 45px rgba(0,0,0,0.15);
}

.vehicle-img{

    width:100%;

    height:230px;

    object-fit:cover;
}

.card-body{

    padding:22px;
}

.vehicle-title{

    font-size:24px;

    font-weight:700;

    color:#111;
}

.location{

    color:#777;

    margin-top:5px;
}

/* ================= INFO ================= */

.booking-info{

    margin-top:15px;
}

.booking-info p{

    margin-bottom:10px;

    color:#444;
}

/* ================= PRICE ================= */

.price{

    font-size:26px;

    font-weight:700;

    color:#0d6efd;
}

/* ================= STATUS ================= */

.status{

    display:inline-block;

    padding:8px 16px;

    border-radius:30px;

    font-size:14px;

    font-weight:600;

    margin-top:10px;
}

.pending{

    background:#fff3cd;

    color:#856404;
}

.confirmed{

    background:#d1e7dd;

    color:#0f5132;
}

.cancelled{

    background:#f8d7da;

    color:#842029;
}

/* ================= BUTTON ================= */

.btn-whatsapp{

    margin-top:18px;

    border-radius:12px;

    height:52px;

    font-weight:600;

    background:#25D366;

    border:none;

    transition:0.3s;

    display:flex;

    align-items:center;

    justify-content:center;

    gap:8px;

    font-size:18px;
}

.btn-whatsapp:hover{

    background:#1ebe5d;

    transform:translateY(-2px);
}

/* ================= EMPTY ================= */

.empty-box{

    background:#fff;

    padding:60px 30px;

    border-radius:20px;

    text-align:center;

    box-shadow:
    0 10px 30px rgba(0,0,0,0.08);
}

.empty-box h3{

    font-weight:700;

    margin-bottom:10px;
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    .page-header h1{

        font-size:34px;
    }

    .vehicle-title{

        font-size:22px;
    }
}

</style>

</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

<a class="navbar-brand"
href="index.php">

🚗 RentRide

</a>

<div class="ms-auto d-flex align-items-center">

<a class="nav-link"
href="index.php">

Home

</a>

<a class="nav-link"
href="booking_history.php">

My Bookings

</a>

<span class="nav-link user-name">

👤 <?php echo $user['name']; ?>

</span>

<a href="userlogout.php"
class="btn btn-danger btn-sm ms-3">

Logout

</a>

</div>
</div>
</nav>

<!-- ================= PAGE HEADER ================= -->

<div class="page-header">

<h1>🚗 My Bookings</h1>

<p>

Track all your vehicle bookings here

</p>

</div>

<!-- ================= BOOKINGS ================= -->

<div class="container pb-5">

<div class="row g-4">

<?php

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

/* WHATSAPP MESSAGE */

$message = "Hello, I want to discuss my booking.%0A%0A";

$message .= "Customer Name: ".$user['name']."%0A";

$message .= "Mobile: ".$user['mobile']."%0A%0A";

$message .= "Booking ID: ".$row['id']."%0A";

$message .= "Vehicle: ".$row['brand']." ".$row['name']."%0A";

$message .= "Pickup Date: ".$row['pickup_date']."%0A";

$message .= "Return Date: ".$row['return_date']."%0A";

$message .= "Location: ".$row['location']."%0A";

$message .= "Days: ".$row['days']."%0A";

$message .= "Total Price: ₹".$row['total_price'];

?>

<div class="col-lg-4 col-md-6">

<div class="booking-card">

<img src="uploads/<?php echo $row['image']; ?>"

class="vehicle-img"

onerror="this.src='https://via.placeholder.com/400x250?text=No+Image'">

<div class="card-body">

<h4 class="vehicle-title">

<?php echo $row['brand']; ?>

<?php echo $row['name']; ?>

</h4>

<p class="location">

📍 <?php echo $row['city']; ?>

</p>

<hr>

<div class="booking-info">

<p>

<b>Pickup:</b>

<?php echo date("d M Y",
strtotime($row['pickup_date'])); ?>

</p>

<p>

<b>Return:</b>

<?php echo date("d M Y",
strtotime($row['return_date'])); ?>

</p>

<p>

<b>Location:</b>

<?php echo $row['location']; ?>

</p>

<p>

<b>Total Days:</b>

<?php echo $row['days']; ?>

</p>

</div>

<div class="d-flex
justify-content-between
align-items-center
mt-3">

<div class="price">

₹<?php echo $row['total_price']; ?>

</div>

<div>

<?php if($row['status'] == 'Pending'){ ?>

<span class="status pending">

Pending

</span>

<?php }elseif($row['status'] == 'Confirmed'){ ?>

<span class="status confirmed">

Approved

</span>

<?php }else{ ?>

<span class="status cancelled">

Cancelled

</span>

<?php } ?>

</div>

</div>

<!-- WHATSAPP -->

<a href="https://wa.me/918878545059?text=<?php echo $message; ?>"

target="_blank"

class="btn btn-success btn-whatsapp w-100">

💬 Chat on WhatsApp

</a>

</div>
</div>
</div>

<?php
}
}else{
?>

<div class="col-12">

<div class="empty-box">

<h3>No Bookings Yet 😢</h3>

<p class="mb-4">

Looks like you haven't booked any ride yet.

</p>

<a href="index.php"
class="btn btn-primary btn-lg">

Browse Vehicles

</a>

</div>

</div>

<?php } ?>

</div>
</div>

</body>
</html>