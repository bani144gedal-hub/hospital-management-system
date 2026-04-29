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
    <title>Appointment</title>
</head>
<body>




    <?php include 'config.php'; include 'layout_top.php'; ?>

<h3 class="mb-3">Book Appointment</h3>

<form method="POST" class="card p-3 mb-4">

<!-- Patient Dropdown -->
<select name="patient_id" class="form-control mb-2" required>
<option value="">Select Patient</option>
<?php
$res=$conn->query("SELECT * FROM patients");
while($p=$res->fetch_assoc()){
echo "<option value='$p[id]'>$p[id] - $p[name]</option>";
}
?>
</select>

<!-- Doctor Dropdown -->
<select name="doctor_id" class="form-control mb-2" required>
<option value="">Select Doctor</option>
<?php
$res=$conn->query("SELECT * FROM doctors");
while($d=$res->fetch_assoc()){
echo "<option value='$d[id]'>$d[name] ($d[timing])</option>";
}
?>
</select>

<input type="date" name="date" class="form-control mb-2" required>
<input type="time" name="time" class="form-control mb-2" required>

<button name="save" class="btn btn-warning">Book Appointment</button>
</form>

<?php
if(isset($_POST['save'])){

$doctor_id = $_POST['doctor_id'];
$date = $_POST['date'];
$time = $_POST['time'];

// get doctor timing
$d = $conn->query("SELECT timing FROM doctors WHERE id='$doctor_id'")->fetch_assoc();
$timing = $d['timing']; // example: 10AM-2PM

list($start,$end) = explode("-", $timing);

// convert to time
$start = date("H:i", strtotime($start));
$end = date("H:i", strtotime($end));

if($time >= $start && $time <= $end){

$conn->query("INSERT INTO appointments (patient_id,doctor_id,appointment_date,appointment_time)
VALUES ('$_POST[patient_id]','$doctor_id','$date','$time')");

echo "<div class='alert alert-success'>Appointment Booked!</div>";

}else{
echo "<div class='alert alert-danger'>Select time within doctor timing ($timing)</div>";
}

}
?>

<!-- SHOW APPOINTMENTS TABLE -->
<h4>All Appointments</h4>

<table class="table table-bordered">
<tr>
<th>ID</th>
<th>Patient ID</th>
<th>Patient Name</th>
<th>Doctor</th>
<th>Timing</th>
<th>Date</th>
<th>Time</th>
</tr>

<?php

$query = "SELECT a.id, p.id AS pid, p.name AS pname,
d.name AS dname, d.timing,
a.appointment_date, a.appointment_time
FROM appointments a
JOIN patients p ON a.patient_id = p.id
JOIN doctors d ON a.doctor_id = d.id
ORDER BY a.id DESC";

$res=$conn->query($query);

while($row=$res->fetch_assoc()){
echo "<tr>
<td>$row[id]</td>
<td>$row[pid]</td>
<td>$row[pname]</td>
<td>$row[dname]</td>
<td>$row[timing]</td>
<td>$row[appointment_date]</td>
<td>$row[appointment_time]</td>
</tr>";
}
?>

</table>

<?php include 'layout_bottom.php'; ?>
</body>
</html>