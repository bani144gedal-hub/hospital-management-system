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
    <title>Document</title>
</head>
<body>



    <?php include 'config.php'; include 'layout_top.php'; ?>

<h3>Our Doctors</h3>

<div class="row">

<?php
$res=$conn->query("SELECT * FROM doctors");
while($d=$res->fetch_assoc()){
echo "
<div class='col-md-4'>
<div class='card p-3 text-center mb-3'>
<img src='https://randomuser.me/api/portraits/men/".rand(1,50).".jpg' class='rounded-circle mb-2' width='100'>
<h5>$d[name]</h5>
<p>$d[specialization]</p>
<span class='badge bg-info'>$d[timing]</span>
</div>
</div>";
}
?>

</div>

<?php include 'layout_bottom.php'; ?>
</body>
</html>