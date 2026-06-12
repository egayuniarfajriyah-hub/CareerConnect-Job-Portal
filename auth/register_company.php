<?php

include '../config/database.php';

if(isset($_POST['register'])){

    $company_name = $_POST['company_name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $confirm = md5($_POST['confirm_password']);

    $check = mysqli_query(
        $conn,
        "SELECT * FROM companies
        WHERE email='$email'"
    );

    if(mysqli_num_rows($check) > 0){

        echo "<script>
        alert('Email sudah digunakan');
        </script>";

    }

    elseif($password != $confirm){

        echo "<script>
        alert('Password tidak sama');
        </script>";

    }

    else{

        mysqli_query(
            $conn,
            "INSERT INTO companies
            (company_name,email,password)

            VALUES

            ('$company_name','$email','$password')"
        );

        echo "<script>
        alert('Registrasi perusahaan berhasil');
        window.location='login_company.php';
        </script>";

    }

}

?>

```html
<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>
Register Company
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

.register-section{
min-height:100vh;
display:flex;
align-items:center;
justify-content:center;
padding:30px;
}

.register-card{
width:100%;
max-width:550px;
background:white;
padding:40px;
border-radius:25px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
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

</style>

</head>

<body>

<div class="register-section">

<div class="register-card">

<div class="logo">

<i class="fas fa-building"></i>

<h2>
CareerConnect
</h2>

<p class="text-muted">

Company Registration

</p>

</div>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Company Name

</label>

<input
type="text"
name="company_name"
class="form-control"
required>

</div>

<div class="mb-3">

<label class="form-label">

Email

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

<div class="mb-3">

<label class="form-label">

Confirm Password

</label>

<input
type="password"
name="confirm_password"
class="form-control"
required>

</div>

<button
type="submit"
name="register"
class="btn btn-primary w-100">

Register Company

</button>

<div class="text-center mt-3">

Already have an account?

<a href="login_company.php">

Login Here

</a>

</div>

</form>

</div>

</div>

</body>
</html>

