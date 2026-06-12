<?php

include '../config/database.php';

if(isset($_POST['register'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = mysqli_query($conn,

    "INSERT INTO users
    (fullname,email,password)

    VALUES

    ('$fullname','$email','$password')"

    );

    if($query){

        echo "<script>

        alert('Registration Successful');

        window.location='login.php';

        </script>";

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
Register User
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
background:linear-gradient(
135deg,
#2563EB,
#60A5FA
);
min-height:100vh;
display:flex;
align-items:center;
justify-content:center;
padding:20px;
}

.register-card{
width:100%;
max-width:500px;
background:white;
padding:40px;
border-radius:25px;
box-shadow:
0 15px 35px rgba(0,0,0,.15);
}

.logo-box{
width:90px;
height:90px;
background:#2563EB;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
margin:auto;
margin-bottom:20px;
}

.logo-box i{
font-size:40px;
color:white;
}

.form-control{
height:50px;
border-radius:12px;
}

.btn-primary{
height:50px;
border-radius:12px;
font-weight:600;
background:#2563EB;
border:none;
}

.btn-primary:hover{
background:#1E40AF;
}

</style>

</head>

<body>

<div class="register-card">

<div class="text-center">

<div class="logo-box">

<i class="fas fa-user-plus"></i>

</div>

<h2 class="fw-bold">

Create Account

</h2>

<p class="text-muted">

Join CareerConnect and find your dream job

</p>

</div>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Full Name

</label>

<input
type="text"
name="fullname"
class="form-control"
placeholder="Enter your full name"
required>

</div>

<div class="mb-3">

<label class="form-label">

Email Address

</label>

<input
type="email"
name="email"
class="form-control"
placeholder="Enter your email"
required>

</div>

<div class="mb-4">

<label class="form-label">

Password

</label>

<input
type="password"
name="password"
class="form-control"
placeholder="Create password"
required>

</div>

<button
type="submit"
name="register"
class="btn btn-primary w-100">

<i class="fas fa-user-plus"></i>

 Register

</button>

</form>

<div class="text-center mt-4">

Already have an account?

<a
href="login.php"
class="text-decoration-none fw-bold">

Login Here

</a>

</div>

</div>

</body>

</html>

