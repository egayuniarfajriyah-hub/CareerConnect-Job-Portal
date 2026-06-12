<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['company_id'])){
    header("Location: ../auth/login_company.php");
    exit;
}

$company_id = $_SESSION['company_id'];

$query = mysqli_query(
    $conn,
    "SELECT * FROM companies
    WHERE id='$company_id'"
);

$company = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $company_name = $_POST['company_name'];
    $website = $_POST['website'];
    $industry = $_POST['industry'];
    $location = $_POST['location'];
    $description = $_POST['description'];

    mysqli_query($conn,

    "UPDATE companies SET

    company_name='$company_name',
    website='$website',
    industry='$industry',
    location='$location',
    description='$description'

    WHERE id='$company_id'"

    );

    echo "<script>
    alert('Profile berhasil diperbarui');
    window.location='profile.php';
    </script>";

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>
Company Profile
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

.profile-card{
max-width:900px;
margin:40px auto;
background:white;
padding:35px;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.company-logo{
width:100px;
height:100px;
background:#2563EB;
color:white;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:40px;
margin:auto;
margin-bottom:20px;
}

.btn-primary{
background:#2563EB;
border:none;
border-radius:12px;
padding:10px 20px;
}

</style>

</head>

<body>

<div class="container">

<div class="profile-card">

<div class="text-center">

<div class="company-logo">

<i class="fas fa-building"></i>

</div>

<h2>

<?php echo $company['company_name']; ?>

</h2>

<p class="text-muted">

Manage your company information

</p>

</div>

<hr>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Company Name

</label>

<input
type="text"
name="company_name"
class="form-control"
value="<?php echo $company['company_name']; ?>">

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Website

</label>

<input
type="text"
name="website"
class="form-control"
value="<?php echo $company['website']; ?>">

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Industry

</label>

<input
type="text"
name="industry"
class="form-control"
value="<?php echo $company['industry']; ?>">

</div>

</div>

<div class="mb-3">

<label class="form-label">

Location

</label>

<input
type="text"
name="location"
class="form-control"
value="<?php echo $company['location']; ?>">

</div>

<div class="mb-3">

<label class="form-label">

Description

</label>

<textarea
name="description"
class="form-control"
rows="5"><?php echo $company['description']; ?></textarea>

</div>

<button
type="submit"
name="update"
class="btn btn-primary">

<i class="fas fa-save"></i>

Save Changes

</button>

<a
href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</body>

</html>


