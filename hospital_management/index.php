
<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>
<!-- error_reporting(E_ALL);
ini_set('display_errors', 1); -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body>

    
<?php include 'config.php'; include 'layout_top.php'; ?>

<div class="row">

<div class="col-md-3">
<div class="card bg-primary text-white p-3">
<h5>Patients</h5>
<?php $r=$conn->query("SELECT COUNT(*) c FROM patients")->fetch_assoc(); echo $r['c']; ?>
</div>
</div>

<div class="col-md-3">
<div class="card bg-success text-white p-3">
<h5>Doctors</h5>
<?php $r=$conn->query("SELECT COUNT(*) c FROM doctors")->fetch_assoc(); echo $r['c']; ?>
</div>
</div>

<div class="col-md-3">
<div class="card bg-warning text-white p-3">
<h5>Appointments</h5>
<?php
echo $conn->query("SELECT COUNT(*) as c FROM appointments")->fetch_assoc()['c'];
?>
</div>
</div>


<div class="col-md-3">
<div class="card bg-danger text-white p-3">
<div class="dropdown mt-4">
  <button class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
    🛏️ Bed Details
  </button>

  <ul class="dropdown-menu p-3" style="width:300px; max-height:300px; overflow:auto;">
    <?php
$totalBeds = 10;

// get occupied beds
$res = $conn->query("SELECT bed_number FROM beds WHERE status='Occupied'");
$occupiedBeds = [];

while($row = $res->fetch_assoc()){
    $occupiedBeds[] = $row['bed_number'];
}

// show all beds
for($i=1;$i<=$totalBeds;$i++){

    if(in_array($i, $occupiedBeds)){
        echo "<li class='text-danger'>Bed $i - Occupied</li>";
    } else {
        echo "<li class='text-success'>Bed $i - Available</li>";
    }
}
?>
  </ul>




</div>
</div>

</div>

<img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3" class="img-fluid mt-4 rounded">

<?php include 'layout_bottom.php'; ?>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>