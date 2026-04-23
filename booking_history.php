<?php
include "config.php";
session_start();

// 🔐 LOGIN CHECK
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit();
}

// ✅ Safe user_id
$user_id = intval($_SESSION['user']);

// 👤 Fetch user
$user_query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($user_query);

// 🔎 FETCH BOOKINGS
$sql = "SELECT B.*, V.name, V.image,
               C.city, BR.brand
        FROM bookings B
        JOIN vehicles V ON B.vehicle_id = V.id
        LEFT JOIN city_master C ON V.city = C.id
        LEFT JOIN brand_master BR ON V.brand = BR.id
        WHERE B.user_id = '$user_id'
        ORDER BY B.id DESC";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<title>My Bookings</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(120deg, #f0f2f5, #e4ecf7);
    font-family: 'Segoe UI';
}

/* NAVBAR */
.navbar {
    backdrop-filter: blur(10px);
    background: rgba(0, 0, 0, 0.75);
}

.navbar-brand {
    font-size: 22px;
    font-weight: bold;
}

.nav-link {
    color: #ccc !important;
    margin-left: 15px;
}

.nav-link:hover {
    color: #fff !important;
}

.user-name {
    color: #00ffcc;
    font-weight: bold;
}

/* CARDS */
.card {
    border: none;
    border-radius: 15px;
    overflow: hidden;
    transition: 0.3s;
}

.card:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.card img {
    height: 180px;
    object-fit: cover;
}

.badge {
    padding: 6px 10px;
}

.empty-box {
    text-align: center;
    padding: 50px;
    background: white;
    border-radius: 12px;
}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">
<div class="container">

<a class="navbar-brand" href="index.php">🚗 RentRide</a>

<div class="ms-auto d-flex align-items-center">

<a class="nav-link" href="index.php">Home</a>

<?php if (isset($_SESSION['user'])) { ?>

<a class="nav-link" href="booking_history.php">My Bookings</a>

<span class="nav-link user-name">
👤 <?php echo $user['name']; ?>
</span>

<a class="btn btn-danger btn-sm ms-2" href="userlogout.php">
Logout
</a>

<?php } else { ?>

<a class="nav-link" href="login.html">Login</a>
<a class="nav-link" href="signup.html">Signup</a>

<?php } ?>

</div>
</div>
</nav>

<!-- CONTENT -->
<div class="container my-5">

<div class="text-center mb-4">
<h2>🚗 My Bookings</h2>
<p>Welcome, <b><?php echo $user['name']; ?></b></p>
</div>

<div class="row">

<?php
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>

<div class="col-md-4 mb-4">
<div class="card shadow-sm">

<img src="uploads/<?php echo $row['image']; ?>"
onerror="this.src='https://via.placeholder.com/300x180?text=No+Image'">

<div class="card-body">

<h5><?php echo $row['brand']." ".$row['name']; ?></h5>
<p class="text-muted">📍 <?php echo $row['city']; ?></p>

<hr>

<p><b>Pickup:</b> <?php echo date("d M Y", strtotime($row['pickup_date'])); ?></p>
<p><b>Return:</b> <?php echo date("d M Y", strtotime($row['return_date'])); ?></p>
<p><b>Location:</b> <?php echo $row['location']; ?></p>
<p><b>Days:</b> <?php echo $row['days']; ?></p>

<h6 class="text-success">₹<?php echo $row['total_price']; ?></h6>

<!-- STATUS -->
<?php if ($row['status'] == 'Pending') { ?>
<span class="badge bg-warning text-dark">Pending</span>
<?php }elseif ($row['status'] == 'Confirmed'){ ?>
<span class="badge bg-success">Approved</span>
<?php } else { ?>
<span class="badge bg-danger">Cancelled</span>
<?php } ?>

</div>
</div>
</div>

<?php
    }
} else {
?>

<div class="empty-box">
<h4>No Bookings Yet 😢</h4>
<p>Go book your first ride 🚗</p>
<a href="index.php" class="btn btn-primary">Browse Vehicles</a>
</div>

<?php } ?>

</div>
</div>
</body>
</html>