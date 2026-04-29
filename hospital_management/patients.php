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
    <title>Patients</title>
</head>
<body>


    <?php include 'config.php'; include 'layout_top.php'; ?>

<form method="POST" class="card p-3 mb-3">
<input name="name" class="form-control mb-2" placeholder="Name">
<input name="age" class="form-control mb-2" placeholder="Age">
<input name="gender" class="form-control mb-2" placeholder="Gender">
<input name="phone" class="form-control mb-2" placeholder="Phone">
<textarea name="address" class="form-control mb-2" placeholder="Address"></textarea>
<button name="save" class="btn btn-primary">Add Patient</button>
</form>

<?php
if(isset($_POST['save'])){
$conn->query("INSERT INTO patients(name,age,gender,phone,address)
VALUES('$_POST[name]','$_POST[age]','$_POST[gender]','$_POST[phone]','$_POST[address]')");
}
?>
    <!-- deleting the patient  -->
<?php
if(isset($_GET['delete'])){
$conn->query("DELETE FROM patients WHERE id=$_GET[delete]");
echo "<div class='alert alert-danger'>Patient Deleted</div>";
}
?>


<table class="table table-bordered">
<tr><th>ID</th><th>Name</th><th>Phone</th></tr>
<?php
$res=$conn->query("SELECT * FROM patients");
while($row=$res->fetch_assoc()){
echo "<tr>
<td>$row[id]</td>
<td>$row[name]</td>
<td>$row[phone]</td>
<td>
<a href='?delete=$row[id]' class='btn btn-danger btn-sm'>Delete</a>
</td>
</tr>";
}
?>
</table>

<?php include 'layout_bottom.php'; ?>

</body>
</html>