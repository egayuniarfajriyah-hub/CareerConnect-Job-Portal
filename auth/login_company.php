<?php

session_start();

include '../config/database.php';

if(isset($_POST['login'])){

    $email = mysqli_real_escape_string(
        $conn,
        $_POST['email']
    );

    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM companies
        WHERE email='$email'
        AND password='$password'"
    );

    if(mysqli_num_rows($query) > 0){

        $company = mysqli_fetch_assoc($query);

        $_SESSION['company_id'] =
        $company['id'];

        $_SESSION['company_name'] =
        $company['company_name'];

        header(
        "Location: ../company/dashboard.php"
        );

        exit;

    }else{

        $error =
        "Email atau Password salah";

    }

}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>

Company Login

</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
rel="stylesheet">

<style>

*{
font-family:'Poppins',sans-serif;
}

body{
background:#f1f5f9;
}

.login-section{
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
padding:30px;
}

.login-card{
width:100%;
max-width:520px;
background:white;
padding:40px;
border-radius:25px;
box-shadow:
0 10px 25px rgba(0,0,0,.08);
}

.logo{
text-align:center;
margin-bottom:25px;
}

.logo i{
font-size:60px;
color:#2563EB;
}

.logo h2{
font-weight:700;
margin-top:10px;
}

.btn-primary{
background:#2563EB;
border:none;
padding:12px;
}

.btn-primary:hover{
background:#1E40AF;
}

.form-control{
padding:12px;
}

</style>

</head>

<body>

<div class="login-section">

<div class="login-card">

<div class="logo">

<i class="fas fa-building"></i>

<h2>

CareerConnect

</h2>

<p class="text-muted">

Company Login Portal

</p>

</div>

<?php
if(isset($error)){
?>

<div class="alert alert-danger">

<?php echo $error; ?>

</div>

<?php
}
?>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Company Email

</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Password

</label>

<input
type="password"
name="password"
class="form-control"
required>

</div>

<button
type="submit"
name="login"
class="btn btn-primary w-100">

<i class="fas fa-sign-in-alt"></i>

Login Company

</button>

</form>

<div class="text-center mt-4">

Belum punya akun perusahaan?

<br>

<a href="register_company.php">

Register Company

</a>

</div>

<hr>

<div class="text-center text-muted">

CareerConnect © 2026

</div>

</div>

</div>

</body>
</html>

