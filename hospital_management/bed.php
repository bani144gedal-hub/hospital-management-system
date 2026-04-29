<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Bed</title>
</head>
<body>




    <?php include 'config.php'; include 'layout_top.php'; ?>

<h3 class="mb-3">Bed Management</h3>

<!-- Assign Bed -->
<form method="POST" class="card p-3 mb-4">
<input name="patient_id" class="form-control mb-2" placeholder="Patient ID" required>
<input name="bed_number" class="form-control mb-2" placeholder="Bed Number" required>

<select name="status" class="form-control mb-2">
<option value="Occupied">Occupied</option>
<option value="Available">Available</option>
</select>

<button name="save" class="btn btn-danger">Assign Bed</button>
</form>
<h4>Available Beds</h4>

<?php
$totalBeds = 10;

// get occupied beds
$res = $conn->query("SELECT bed_number FROM beds WHERE status='Occupied'");
$occupiedBeds = [];

while($row = $res->fetch_assoc()){
    $occupiedBeds[] = $row['bed_number'];
}

// show available beds
for($i=1;$i<=$totalBeds;$i++){
    if(!in_array($i, $occupiedBeds)){
        echo "<span class='badge bg-success m-1'>Bed $i</span>";
    }
}
?>
<h4>Occupied Beds</h4>

<?php
$res = $conn->query("SELECT bed_number FROM beds WHERE status='Occupied'");

while($row = $res->fetch_assoc()){
    echo "<span class='badge bg-danger m-1'>Bed ".$row['bed_number']."</span>";
}
?>

<?php
if(isset($_POST['save'])){

$bed = $_POST['bed_number'];

// check if bed already occupied
$check = $conn->query("SELECT * FROM beds WHERE bed_number='$bed' AND status='Occupied'");

if($check->num_rows > 0){
    echo "<div class='alert alert-danger'>This bed is already occupied!</div>";
} else {
    $conn->query("INSERT INTO beds (patient_id,bed_number,status)
    VALUES ('$_POST[patient_id]','$bed','Occupied')");

    echo "<div class='alert alert-success'>Bed Assigned!</div>";
}
}
?>



<!-- <?php
if(isset($_POST['save'])){
$conn->query("INSERT INTO beds (patient_id,bed_number,status)
VALUES ('$_POST[patient_id]','$_POST[bed_number]','$_POST[status]')");

echo "<div class='alert alert-success'>Bed Assigned!</div>";
}
?> -->

<!-- SHOW RESERVED BEDS -->
<h4>Reserved / Occupied Beds</h4>

<?php
if(isset($_GET['release'])){
$conn->query("DELETE FROM beds WHERE id=$_GET[release]");
echo "<div class='alert alert-success'>Bed Released</div>";
}
?>

<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Patient ID</th>
<th>Bed Number</th>
<th>Status</th>
</tr>

<?php
$res = $conn->query("SELECT * FROM beds WHERE status='Occupied'");

while($row = $res->fetch_assoc()){
echo "<tr>
<td>$row[id]</td>
<td>$row[patient_id]</td>
<td>$row[bed_number]</td>
<td>
<span class='badge bg-danger'>Occupied</span>
</td>
<td>
<a href='?release=$row[id]' class='btn btn-success btn-sm'>Release</a>
</td>
</tr>";
}
?>
</table>

<?php include 'layout_bottom.php'; ?>
</body>
</html>