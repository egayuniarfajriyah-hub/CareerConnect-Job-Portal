<?php

include 'config/database.php';

$id = $_GET['id'];

$job = mysqli_fetch_assoc(

mysqli_query(

$conn,

"SELECT

jobs.*,
companies.company_name

FROM jobs

JOIN companies
ON jobs.company_id = companies.id

WHERE jobs.id='$id'"

)

);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>

<?php echo $job['title']; ?>

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

.job-card{
max-width:900px;
margin:50px auto;
background:white;
padding:35px;
border-radius:20px;
box-shadow:0 10px 25px rgba(0,0,0,.08);
}

.badge-job{
font-size:14px;
padding:8px 14px;
}

.section-title{
font-weight:600;
margin-top:25px;
margin-bottom:10px;
color:#2563EB;
}

</style>

</head>

<body>

<div class="container">

<div class="job-card">

<span class="badge bg-primary badge-job">

<?php echo $job['job_type']; ?>

</span>

<h1 class="mt-3">

<?php echo $job['title']; ?>

</h1>

<h5 class="text-muted">

<?php echo $job['company_name']; ?>

</h5>

<hr>

<div class="row">

<div class="col-md-4">

<p>

<i class="fas fa-map-marker-alt text-danger"></i>

<?php echo $job['location']; ?>

</p>

</div>

<div class="col-md-4">

<p>

<i class="fas fa-money-bill-wave text-success"></i>

<?php echo $job['salary']; ?>

</p>

</div>

<div class="col-md-4">

<p>

<i class="fas fa-calendar-alt text-primary"></i>

<?php echo $job['deadline']; ?>

</p>

</div>

</div>

<h4 class="section-title">

Job Description

</h4>

<p>

<?php echo nl2br($job['description']); ?>

</p>

<h4 class="section-title">

Requirements

</h4>

<p>

<?php echo nl2br($job['requirements']); ?>

</p>

<div class="mt-4">

<a
href="auth/login.php"
class="btn btn-primary btn-lg me-2">

Apply Now

</a>

<a
href="index.php"
class="btn btn-secondary btn-lg">

Back

</a>

</div>

</div>

</div>

</body>

</html>

