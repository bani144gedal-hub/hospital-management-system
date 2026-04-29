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
    <title>Doctor details</title>
</head>
<body>
    
<?php include 'config.php'; include 'layout_top.php'; ?>

<form method="POST" class="card p-3 mb-3">
<input name="name" class="form-control mb-2" placeholder="Name">
<input name="specialization" class="form-control mb-2" placeholder="Specialization">
<input name="timing" class="form-control mb-2" placeholder="Timing">
<button name="save" class="btn btn-success">Add Doctor</button>
</form>

<?php
if(isset($_POST['save'])){
$conn->query("INSERT INTO doctors(name,specialization,timing)
VALUES('$_POST[name]','$_POST[specialization]','$_POST[timing]')");
}
?>

<?php
if(isset($_GET['delete'])){
$conn->query("DELETE FROM doctors WHERE id=$_GET[delete]");
echo "<div class='alert alert-danger'>Doctor Deleted</div>";
}
?>

<table class="table">
<tr><th>Name</th><th>Specialization</th><th>Timing</th></tr>
<?php
$res=$conn->query("SELECT * FROM doctors");
while($row=$res->fetch_assoc()){
    echo "<tr>
<td>$row[name]</td>
<td>$row[specialization]</td>
<td>$row[timing]</td>
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