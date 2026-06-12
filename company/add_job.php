<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['company_id'])){
    header("Location: ../auth/login_company.php");
    exit;
}

if(isset($_POST['save'])){

    $company_id = $_SESSION['company_id'];

    $title = $_POST['title'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $job_type = $_POST['job_type'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];
    $deadline = $_POST['deadline'];

    mysqli_query($conn,

    "INSERT INTO jobs(

    company_id,
    title,
    location,
    salary,
    job_type,
    description,
    requirements,
    deadline

    )

    VALUES(

    '$company_id',
    '$title',
    '$location',
    '$salary',
    '$job_type',
    '$description',
    '$requirements',
    '$deadline'

    )"

    );

    echo "<script>
    alert('Job berhasil ditambahkan');
    window.location='dashboard.php';
    </script>";

}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Add Job</title>

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

.form-card{
max-width:900px;
margin:40px auto;
background:white;
padding:35px;
border-radius:20px;
box-shadow:0 5px 20px rgba(0,0,0,.08);
}

.page-title{
font-weight:700;
color:#2563EB;
margin-bottom:25px;
}

textarea{
min-height:120px;
}

.btn-primary{
background:#2563EB;
border:none;
padding:12px 20px;
border-radius:10px;
}

</style>

</head>

<body>

<div class="container">

<div class="form-card">

<h2 class="page-title">

<i class="fas fa-briefcase"></i>

Add New Job

</h2>

<form method="POST">

<div class="mb-3">

<label class="form-label">

Job Title

</label>

<input
type="text"
name="title"
class="form-control"
required>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Location

</label>

<input
type="text"
name="location"
class="form-control"
required>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Salary

</label>

<input
type="text"
name="salary"
class="form-control"
placeholder="Rp 8jt - Rp 12jt">

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">

Job Type

</label>

<select
name="job_type"
class="form-select">

<option value="Full Time">
Full Time
</option>

<option value="Part Time">
Part Time
</option>

<option value="Internship">
Internship
</option>

<option value="Remote">
Remote
</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label class="form-label">

Deadline

</label>

<input
type="date"
name="deadline"
class="form-control">

</div>

</div>

<div class="mb-3">

<label class="form-label">

Job Description

</label>

<textarea
name="description"
class="form-control"></textarea>

</div>

<div class="mb-3">

<label class="form-label">

Requirements

</label>

<textarea
name="requirements"
class="form-control"></textarea>

</div>

<button
type="submit"
name="save"
class="btn btn-primary">

<i class="fas fa-save"></i>

Save Job

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


