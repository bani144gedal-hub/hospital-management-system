<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Hospital Management System</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    font-family: Arial;
}

/* Hero Section */
.hero{
    background: url('https://images.unsplash.com/photo-1576091160550-2173dba999ef') no-repeat center;
    background-size: cover;
    height: 90vh;
    color: white;
    display:flex;
    align-items:center;
}
.hero h1{
    font-size:50px;
    font-weight:bold;
}
.hero p{
    font-size:20px;
}

/* Sections */
.section{
    padding:60px 0;
}

/* Cards */
.card{
    border-radius:15px;
    transition:0.3s;
}
.card:hover{
    transform:scale(1.05);
}

/* Footer */
.footer{
    background:#343a40;
    color:white;
    padding:20px;
    text-align:center;
}
</style>

</head>

<body>



<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container">
<a class="navbar-brand" href="#" > HMS </a>

<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">
<ul class="navbar-nav ms-auto">
<li class="nav-item"><a class="nav-link" href="#">Home</a></li>
<li class="nav-item"><a class="nav-link" href="#about">About</a></li>
<li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
<li class="nav-item"><a class="nav-link" href="#patients">Patients</a></li>
<li class="nav-item"><a class="nav-link" href="doctor_cards.php">Doctors</a></li>
<li class="nav-item"><a class="nav-link" href="login.php">Log-in</a></li>
<li class="nav-item"><a class="nav-link btn btn-primary text-white ms-2" href="index.php" >Dashboard</a></li>
</ul>
</div>
</div>
</nav>

<!-- Hero -->
<section class="hero">
<div class="container">
<h1>Welcome to Our Hospital</h1>
<p>Fast, Secure & Easy Healthcare Management System</p>
<a href="appointment.php" class="btn btn-warning btn-lg mt-3">Book Appointment</a>
</div>
</section>

<!-- About -->
<section id="about" class="section text-center">
<div class="container">
<h2>About Our Hospital</h2>
<p>We provide advanced healthcare services with modern technology. Our system helps patients to register quickly, book appointments easily, and get emergency bed services instantly.</p>
</div>
</section>

<!-- Services -->
<section id="services" class="section bg-light">
<div class="container text-center">
<h2>Our Services</h2>

<div class="row mt-4">

<div class="col-md-4">
<div class="card p-3">
<h4>👨‍⚕️ Expert Doctors</h4>
<p>Professional doctors with proper timing schedules.</p>
</div>
</div>

<div class="col-md-4">
<div class="card p-3">
<h4>📅 Appointment Booking</h4>
<p>Easy and fast appointment booking system.</p>
</div>
</div>

<div class="col-md-4">
<div class="card p-3">
<h4>🛏️ Emergency Beds</h4>
<p>Quick bed availability in emergency situations.</p>
</div>
</div>

</div>
</div>
</section>

<!-- Patients Section -->
<section id="patients" class="section">
<div class="container text-center">
<h2>Our Patients Care</h2>

<div class="row mt-4">

<div class="col-md-4">
<div class="card p-3">
<h5>Quick Registration</h5>
<p>Patients can register within seconds.</p>
</div>
</div>

<div class="col-md-4">
<div class="card p-3">
<h5>Safe Treatment</h5>
<p>Secure and reliable treatment system.</p>
</div>
</div>

<div class="col-md-4">
<div class="card p-3">
<h5>24/7 Support</h5>
<p>Available anytime for patient support.</p>
</div>
</div>

</div>
</div>
</section>

<!-- Call to Action -->
<section class="section bg-primary text-white text-center">
<div class="container">
<h2>Need Immediate Help?</h2>
<p>Register now and get instant medical support</p>
<a href="register.php" class="btn btn-light">Register Patient</a>
</div>
</section>

<!-- Footer -->
<div class="footer">
<p>© 2026 Hospital Management System | All Rights Reserved</p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>