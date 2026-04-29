<?php
session_start();
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Login - HMS</title>

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
    background: linear-gradient(135deg,#4facfe,#00f2fe);
    display:flex;
    justify-content:center;
    align-items:center;
}

/* Card */
.login-card{
    width:350px;
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
.btn-login{
    border-radius:10px;
    transition:0.3s;
}
.btn-login:hover{
    transform:scale(1.05);
}

/* Icon */
.icon{
    font-size:40px;
    color:#0d6efd;
}
</style>

</head>

<body>

<div class="login-card" data-aos="zoom-in">

<div class="text-center mb-3">
<i class="fa fa-hospital icon"></i>
<h3 class="mt-2">Hospital Login</h3>
</div>

<form method="POST">

<input name="username" class="form-control mb-3" placeholder="👤 Username" required>

<input type="password" name="password" class="form-control mb-3" placeholder="🔒 Password" required>

<button name="login" class="btn btn-primary w-100 btn-login">Login</button>

</form>

<?php
if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

$res = $conn->query("SELECT * FROM users WHERE username='$username' AND password='$password'");

if($res->num_rows > 0){

$_SESSION['user'] = $username;
session_regenerate_id(true);

header("Location: home.php");
exit();

}else{
echo "<div class='alert alert-danger mt-3 text-center'>❌ Invalid Login</div>";
}
}
?>

<div class="text-center mt-3">
<a href="register.php">Create Account</a>
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