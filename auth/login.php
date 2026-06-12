<?php

session_start();

include '../config/database.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users
        WHERE email='$email'"
    );

    $user = mysqli_fetch_assoc($query);

    if($user){

        if(password_verify(
            $password,
            $user['password']
        )){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];

            header(
                "Location: ../user/dashboard.php"
            );

            exit;

        }else{

            echo "<script>
            alert('Password Incorrect');
            </script>";

        }

    }else{

        echo "<script>
        alert('Email Not Found');
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
Login User
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
background:
linear-gradient(
135deg,
#2563EB,
#60A5FA
);
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
padding:20px;
}

.login-card{
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

.password-box{
position:relative;
}

.password-box i{
position:absolute;
right:15px;
top:17px;
cursor:pointer;
color:#666;
}

</style>

</head>

<body>

<div class="login-card">

<div class="text-center">

<div class="logo-box">

<i class="fas fa-user"></i>

</div>

<h2 class="fw-bold">

Welcome Back

</h2>

<p class="text-muted">

Login to continue your job search

</p>

</div>

<form method="POST">

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

<div class="password-box">

<input
type="password"
name="password"
id="password"
class="form-control"
placeholder="Enter password"
required>

<i
class="fas fa-eye"
onclick="togglePassword()">
</i>

</div>

</div>

<button
type="submit"
name="login"
class="btn btn-primary w-100">

<i class="fas fa-sign-in-alt"></i>

 Login

</button>

</form>

<div class="text-center mt-4">

Don't have an account?

<a
href="register_user.php"
class="text-decoration-none fw-bold">

Register Here

</a>

</div>

</div>

<script>

function togglePassword(){

let password =
document.getElementById("password");

if(password.type === "password"){

password.type = "text";

}else{

password.type = "password";

}

}

</script>

</body>

</html>

