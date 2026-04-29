

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Billing</title>
</head>
<body>


<?php 
include 'config.php'; 
include 'layout_top.php'; 
?>

<h3 class="mb-3">Billing System</h3>

<form method="POST" class="card p-3 mb-4">

<!-- Select Patient -->
<select name="patient_id" class="form-control mb-2" required>
<option value="">Select Patient</option>
<?php
$res=$conn->query("SELECT * FROM patients");
while($p=$res->fetch_assoc()){
echo "<option value='$p[id]'>$p[id] - $p[name]</option>";
}
?>
</select>

<input name="amount" class="form-control mb-2" placeholder="Total Amount" required>

<select name="status" class="form-control mb-2">
<option value="Paid">Paid</option>
<option value="Pending">Pending</option>
</select>

<button name="generate" class="btn btn-dark">Generate Invoice</button>

</form>

<?php
if(isset($_POST['generate'])){

$pid = $_POST['patient_id'];
$amount = $_POST['amount'];
$status = $_POST['status'];

/* 🔹 Generate Invoice No */
$invoice_no = "INV" . rand(1000,9999);

/* 🔹 Get patient + doctor details */
$query = "SELECT p.id AS pid, p.name AS patient, p.phone,
d.name AS doctor, d.timing,
a.appointment_date, a.appointment_time
FROM patients p
LEFT JOIN appointments a ON p.id = a.patient_id
LEFT JOIN doctors d ON a.doctor_id = d.id
WHERE p.id='$pid'
ORDER BY a.id DESC LIMIT 1";

$res = $conn->query($query);
$data = $res->fetch_assoc();

/* 🔹 Save billing */
$conn->query("INSERT INTO billing (patient_id,amount,status,invoice_no)
VALUES ('$pid','$amount','$status','$invoice_no')");
?>

<!-- 🧾 INVOICE DESIGN -->
<div class="card p-4 mt-4" id="invoice">

<div class="text-center">
<h2> HMS </h2>
<p>BhubNESWAR, Odisha</p>
</div>

<hr>

<p><b>Invoice No:</b> <?php echo $invoice_no; ?></p>
<p><b>Date:</b> <?php echo date("d-m-Y"); ?></p>
<p><b>Time:</b> <?php echo date("h:i A"); ?></p>

<hr>

<p><b>Patient ID:</b> <?php echo $data['pid']; ?></p>
<p><b>Patient Name:</b> <?php echo $data['patient']; ?></p>
<p><b>Phone:</b> <?php echo $data['phone']; ?></p>

<hr>

<?php if($data['doctor']){ ?>
<p><b>Doctor:</b> <?php echo $data['doctor']; ?></p>
<p><b>Doctor Timing:</b> <?php echo $data['timing']; ?></p>
<p><b>Appointment Date:</b> <?php echo $data['appointment_date']; ?></p>
<p><b>Appointment Time:</b> <?php echo $data['appointment_time']; ?></p>
<?php } else { ?>
<div class="alert alert-warning">No appointment found for this patient</div>
<?php } ?>

<hr>

<!-- BILL BREAKDOWN -->
<table class="table table-bordered">
<tr><th>Service</th><th>Amount</th></tr>
<tr><td>Doctor Consultation</td><td>₹500</td></tr>
<tr><td>Hospital Charges</td><td>₹300</td></tr>
<tr><td><b>Total</b></td><td><b>₹ <?php echo 800+$amount; ?></b></td></tr>
</table>

<p><b>Status:</b> <?php echo $status; ?></p>

<div class="text-center mt-3">
<button onclick="printInvoice()" class="btn btn-success">Print Invoice</button>
</div>

</div>

<script>
function printInvoice(){
var printContent = document.getElementById("invoice").innerHTML;
var original = document.body.innerHTML;

document.body.innerHTML = printContent;
window.print();
document.body.innerHTML = original;
location.reload();
}
</script>

<?php } ?>

<?php include 'layout_bottom.php'; ?>


</body>
</html>