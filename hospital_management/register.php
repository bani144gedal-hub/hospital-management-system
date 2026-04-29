<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Register - HMS</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- AOS Animation -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
body{
    height:100vh;
    background: linear-gradient(135deg,#667eea,#764ba2);
    display:flex;
    justify-content:center;
    align-items:center;
}

/* Card */
.register-card{
    width:380px;
    border-radius:20px;
    padding:30px;
    background:white;
    box-shadow:0 10px 30px rgba(0,0,0,0.2);
    animation: fadeIn 1s ease-in-out;
}

/* Animation */
@keyframes fadeIn{
    from{opacity:0; transform:translateY(30px);}
    to{opacity:1; transform:translateY(0);}
}

/* Inputs */
.form-control{
    border-radius:10px;
}

/* Button */
.btn-register{
    border-radius:10px;
    transition:0.3s;
}
.btn-register:hover{
    transform:scale(1.05);
}

/* Icon */
.icon{
    font-size:40px;
    color:#6f42c1;
}
</style>

</head>

<body>

<div class="register-card" data-aos="zoom-in">

<div class="text-center mb-3">
<i class="fa fa-user-plus icon"></i>
<h3 class="mt-2">Create Account</h3>
</div>

<form method="POST">

<input name="name" class="form-control mb-3" placeholder="👤 Full Name" required>

<input name="username" class="form-control mb-3" placeholder="🆔 Username" required>

<input type="password" name="password" class="form-control mb-3" placeholder="🔒 Password" required>

<button name="register" class="btn btn-success w-100 btn-register">Register</button>

</form>

<?php
if(isset($_POST['register'])){

$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];

$conn->query("INSERT INTO users (name,username,password)
VALUES ('$name','$username','$password')");

// redirect to login page
header("Location: login.php");
exit();
}
?>

<div class="text-center mt-3">
<a href="login.php">Already have account? Login</a>
</div>

</div>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
AOS.init();
</script>

</body>
</html>