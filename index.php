<?php
include "config.php";
session_start();

// ================= SEARCH =================

$cond = " WHERE 1=1 ";

$city = "";
$brand = "";
$pickup_date = "";
$return_date = "";

if (isset($_GET['search'])) {

    $city = $_GET['city'];
    $brand = $_GET['brand'];
    $pickup_date = $_GET['pickup_date'];
    $return_date = $_GET['return_date'];

    // CITY FILTER
    if (!empty($city)) {
        $cond .= " AND V.city='$city'";
    }

    // BRAND FILTER
    if (!empty($brand)) {
        $cond .= " AND V.brand='$brand'";
    }

    // DATE AVAILABILITY FILTER
    if (!empty($pickup_date) && !empty($return_date)) {

        $cond .= " AND V.id NOT IN (

        SELECT vehicle_id FROM bookings

        WHERE status='Confirmed'

        AND (

        ('$pickup_date' BETWEEN pickup_date AND return_date)

        OR

        ('$return_date' BETWEEN pickup_date AND return_date)

        OR

        (pickup_date BETWEEN '$pickup_date' AND '$return_date')

        )

        )";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>RentRide</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Poppins',sans-serif;
}

body{
    background:#f4f7fb;
    overflow-x:hidden;
}

/* ================= NAVBAR ================= */

.navbar{
    background:rgba(0,0,0,0.88);
    backdrop-filter:blur(12px);
    padding:12px 0;
    position:sticky;
    top:0;
    z-index:1000;
}

.navbar-brand{
    color:#fff !important;
    font-size:30px;
    font-weight:700;
}

.nav-link{
    color:#ddd !important;
    margin-left:20px;
    font-size:17px;
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
    left:0;
    bottom:-6px;
    width:0%;
    height:2px;
    background:#0d6efd;
    transition:0.3s;
}

.nav-link:hover::after{
    width:100%;
}

/* ================= HERO ================= */

.hero{

    min-height:100vh;

    background:
    linear-gradient(rgba(0,0,0,0.68),
    rgba(0,0,0,0.78)),

    url('https://images.unsplash.com/photo-1503376780353-7e6692767b70')
    center/cover no-repeat;

    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;

    padding:50px 20px;
    color:white;
}

.hero h1{
    font-size:70px;
    font-weight:700;
}

.hero p{
    font-size:22px;
    opacity:0.92;
    margin-top:12px;
}

/* ================= SEARCH BOX ================= */

.search-box{

    margin-top:45px;

    background:white;

    padding:28px;

    border-radius:22px;

    box-shadow:
    0 12px 40px rgba(0,0,0,0.20);

    max-width:1200px;

    margin-inline:auto;
}

.form-control{
    height:58px;
    border-radius:14px;
    border:1px solid #ddd;
    font-size:16px;
}

.form-control:focus{
    box-shadow:none;
    border-color:#0d6efd;
}

.btn-search{

    height:58px;

    border-radius:14px;

    font-size:17px;

    font-weight:600;
}

.btn-clear{

    height:58px;

    border-radius:14px;

    font-size:17px;

    font-weight:600;

    display:flex;
    align-items:center;
    justify-content:center;

    transition:0.3s;
}

.btn-clear:hover{
    transform:translateY(-2px);
}

/* ================= SECTION ================= */

.section-title{

    text-align:center;

    font-size:46px;

    font-weight:700;

    color:#111;

    margin-bottom:55px;
}

/* ================= CARDS ================= */

.vehicle-card{

    border:none;

    border-radius:22px;

    overflow:hidden;

    background:white;

    height:100%;

    transition:0.4s;

    box-shadow:
    0 10px 28px rgba(0,0,0,0.08);
}

.vehicle-card:hover{

    transform:translateY(-10px);

    box-shadow:
    0 22px 45px rgba(13,110,253,0.16);
}

.vehicle-img{

    width:100%;

    height:240px;

    object-fit:contain;

    background:#fff;

    padding:15px;
}

.card-body{
    display:flex;
    flex-direction:column;
}

.vehicle-title{

    font-size:25px;

    font-weight:600;

    color:#111;
}

.location{

    color:#666;

    margin-top:8px;

    font-size:15px;
}

.price{

    color:#0d6efd;

    font-size:28px;

    font-weight:700;

    margin-top:12px;
}

.btn-group-custom{

    margin-top:auto;

    display:flex;

    gap:10px;
}

.btn-view{

    flex:1;

    border-radius:12px;

    padding:11px;

    font-weight:500;
}

.btn-book{

    flex:1;

    border:none;

    border-radius:12px;

    background:#198754;

    color:white;

    padding:11px;

    font-weight:600;

    transition:0.3s;
}

.btn-book:hover{

    background:#157347;

    transform:translateY(-2px);
}

/* ================= EMPTY ================= */

.empty-box{

    text-align:center;

    background:white;

    padding:70px 30px;

    border-radius:22px;

    box-shadow:
    0 10px 25px rgba(0,0,0,0.08);
}

/* ================= FOOTER ================= */

footer{

    background:#111;

    color:white;

    text-align:center;

    padding:28px;

    margin-top:80px;
}

/* ================= RESPONSIVE ================= */

@media(max-width:768px){

    .hero h1{
        font-size:42px;
    }

    .hero p{
        font-size:18px;
    }

    .section-title{
        font-size:34px;
    }

    .navbar-brand{
        font-size:24px;
    }

}

</style>

</head>

<body>

<!-- ================= NAVBAR ================= -->

<nav class="navbar navbar-expand-lg">

<div class="container">

<a class="navbar-brand" href="index.php">
🚗 RentRide
</a>

<div class="ms-auto">

<a class="nav-link d-inline" href="index.php">
Home
</a>

<?php if(isset($_SESSION['user'])) { ?>

<a class="nav-link d-inline" href="booking_history.php">
My Bookings
</a>

<a class="nav-link d-inline" href="userlogout.php">
Logout
</a>

<?php } else { ?>

<a class="nav-link d-inline" href="loginpage.php">
Login
</a>

<a class="nav-link d-inline" href="signup.html">
Signup
</a>

<a class="nav-link d-inline" href="dashboard.php">
Admin Login
</a>

<?php } ?>

</div>

</div>

</nav>

<!-- ================= HERO ================= -->

<section class="hero">

<div class="container">

<h1>
Drive Your Dream Ride 🚗
</h1>

<p>
Best Cars & Bikes At Affordable Price
</p>

<!-- SEARCH -->

<form method="GET">

<div class="search-box row g-3">

<!-- CITY -->

<div class="col-lg-3 col-md-6">

<select name="city" id="city" class="form-control">

<option value="">
Select City
</option>

<?php

$res = mysqli_query($conn, "SELECT * FROM city_master");

while($row = mysqli_fetch_assoc($res)){

?>

<option value="<?php echo $row['id']; ?>">

<?php echo $row['city']; ?>

</option>

<?php } ?>

</select>

</div>

<!-- BRAND -->

<div class="col-lg-3 col-md-6">

<select name="brand" id="brand" class="form-control">

<option value="">
Select Brand
</option>

<?php

$res = mysqli_query($conn, "SELECT * FROM brand_master");

while($row = mysqli_fetch_assoc($res)){

?>

<option value="<?php echo $row['id']; ?>">

<?php echo $row['brand']; ?>

</option>

<?php } ?>

</select>

</div>

<!-- PICKUP -->

<div class="col-lg-3 col-md-6">

<input
type="date"
name="pickup_date"
id="pickup_date"
class="form-control"
min="<?php echo date('Y-m-d'); ?>"
value="<?php echo $pickup_date; ?>"
required>

</div>

<!-- RETURN -->

<div class="col-lg-3 col-md-6">

<input
type="date"
name="return_date"
id="return_date"
class="form-control"
min="<?php echo date('Y-m-d'); ?>"
value="<?php echo $return_date; ?>"
required>

</div>

<!-- BUTTONS -->

<div class="col-12">

<div class="d-flex gap-3 flex-wrap">

<button class="btn btn-primary flex-fill btn-search" name="search">
🔍 Search Available Vehicles
</button>

<a href="index.php"
class="btn btn-outline-dark flex-fill btn-clear">

Clear Search

</a>

</div>

</div>

</div>

</form>

</div>

</section>

<!-- ================= VEHICLES ================= -->

<div class="container py-5">

<h2 class="section-title">
Available Vehicles
</h2>

<div class="row g-4">

<?php

$sql = "SELECT *,
        C.city,
        B.brand,
        V.id as vehicle_id

        FROM vehicles V

        LEFT JOIN city_master C
        ON V.city=C.id

        LEFT JOIN brand_master B
        ON V.brand=B.id

        $cond";

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) > 0){

while($row = mysqli_fetch_assoc($result)){

?>

<div class="col-lg-4 col-md-6">

<div class="card vehicle-card">

<img
src="uploads/<?php echo $row['image']; ?>"
class="vehicle-img"

onerror="this.src='https://via.placeholder.com/400x240?text=No+Image'">

<div class="card-body">

<h5 class="vehicle-title">

<?php echo $row['brand']; ?>

-

<?php echo $row['name']; ?>

</h5>

<p class="location">
📍 <?php echo $row['city']; ?>
</p>

<p class="price">
₹<?php echo $row['price']; ?>/day
</p>

<div class="btn-group-custom">

<a
href="details.php?vehicle_id=<?php echo $row['vehicle_id']; ?>"
class="btn btn-outline-primary btn-view">

View

</a>

<a
href="booking.php?vehicle_id=<?php echo $row['vehicle_id']; ?>"
class="btn btn-book">

Book Now

</a>

</div>

</div>

</div>

</div>

<?php
}
}
else{
?>

<div class="col-12">

<div class="empty-box">

<h3 class="text-danger mb-3">
No Vehicles Available 🚫
</h3>

<p class="text-muted">
Try changing dates or filters
</p>

<a href="index.php" class="btn btn-primary mt-3">
Reset Search
</a>

</div>

</div>

<?php } ?>

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

<script>

// SELECT VALUES

document.getElementById("city").value =
"<?php echo $city; ?>";

document.getElementById("brand").value =
"<?php echo $brand; ?>";

// RETURN DATE VALIDATION

document.getElementById("pickup_date").addEventListener("change", function(){

document.getElementById("return_date").min = this.value;

});

</script>

</body>
</html>