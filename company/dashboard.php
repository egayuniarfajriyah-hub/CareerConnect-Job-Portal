<?php

session_start();

if(!isset($_SESSION['company_id'])){
    header("Location: ../auth/login_company.php");
    exit;
}

include '../config/database.php';

$company_id = $_SESSION['company_id'];

$total_jobs = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM jobs
WHERE company_id='$company_id'"
));

$total_applicants = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM applications
JOIN jobs
ON applications.job_id = jobs.id
WHERE jobs.company_id='$company_id'"
));

$total_accepted = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM applications
JOIN jobs
ON applications.job_id = jobs.id
WHERE jobs.company_id='$company_id'
AND applications.status='Accepted'"
));

$recent_applicants = mysqli_query($conn,

"SELECT

users.fullname,
jobs.title,
applications.status

FROM applications

JOIN users
ON applications.user_id = users.id

JOIN jobs
ON applications.job_id = jobs.id

WHERE jobs.company_id='$company_id'

ORDER BY applications.id DESC

LIMIT 5"

);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>
Company Dashboard
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

.sidebar{
width:250px;
height:100vh;
background:linear-gradient(180deg,#2563EB,#1E40AF);
position:fixed;
left:0;
top:0;
padding:25px 20px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
padding:12px;
margin-bottom:10px;
border-radius:10px;
}

.sidebar a:hover{
background:rgba(255,255,255,.15);
}

.main{
margin-left:270px;
padding:30px;
}

.hero{
background:linear-gradient(135deg,#2563EB,#60A5FA);
padding:35px;
border-radius:20px;
color:white;
margin-bottom:25px;
box-shadow:0 10px 25px rgba(37,99,235,.25);
}

.stat-card{
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
text-align:center;
transition:.3s;
height:100%;
}

.stat-card:hover{
transform:translateY(-5px);
box-shadow:0 15px 25px rgba(0,0,0,.12);
}

.stat-card h2{
font-size:50px;
font-weight:700;
margin-top:10px;
margin-bottom:5px;
color:#2563EB;
}

.card{
border:none;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.btn{
border-radius:12px;
font-weight:600;
}

</style>

</head>

<body>

<div class="sidebar">

<div class="text-center mb-4">

<i class="fas fa-briefcase text-white"
style="font-size:40px;"></i>

<h4 class="text-white fw-bold mt-2">
CareerConnect
</h4>

</div>

<a href="dashboard.php">
<i class="fas fa-chart-line"></i>
 Dashboard
</a>

<a href="manage_jobs.php">
<i class="fas fa-briefcase"></i>
 Manage Jobs
</a>

<a href="add_job.php">
<i class="fas fa-plus-circle"></i>
 Add Job
</a>

<a href="applicants.php">
<i class="fas fa-users"></i>
 Applicants
</a>

<a href="profile.php">
<i class="fas fa-building"></i>
 Company Profile
</a>

<a href="../index.php">
<i class="fas fa-sign-out-alt"></i>
 Logout
</a>

</div>

<div class="main">

<div class="hero">

<div class="row align-items-center">

<div class="col-md-8">

<h2>
Welcome Back 👋
</h2>

<h3 class="fw-bold">

<?php echo $_SESSION['company_name']; ?>

</h3>

<p class="mb-0">

Manage your jobs and applicants
through CareerConnect.

</p>

</div>

<div class="col-md-4 text-end">

<div style="
width:90px;
height:90px;
background:white;
border-radius:50%;
display:inline-flex;
align-items:center;
justify-content:center;
">

<i class="fas fa-building"
style="
font-size:40px;
color:#2563EB;
"></i>

</div>

</div>

</div>

</div>

<div class="row">

<div class="col-md-4 mb-4">

<div class="stat-card">

<i class="fas fa-briefcase fa-2x text-primary mb-3"></i>

<h2>

<?php echo $total_jobs['total']; ?>

</h2>

<p class="text-muted mb-0">

Total Jobs

</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="stat-card">

<i class="fas fa-users fa-2x text-success mb-3"></i>

<h2>

<?php echo $total_applicants['total']; ?>

</h2>

<p class="text-muted mb-0">

Applicants

</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="stat-card">

<i class="fas fa-check-circle fa-2x text-warning mb-3"></i>

<h2>

<?php echo $total_accepted['total']; ?>

</h2>

<p class="text-muted mb-0">

Accepted

</p>

</div>

</div>

</div>

<div class="card mb-4">

<div class="card-body">

<h4 class="mb-3">

Quick Actions

</h4>

<a
href="add_job.php"
class="btn btn-primary me-2 mb-2">

<i class="fas fa-plus-circle"></i>

Add Job

</a>

<a
href="manage_jobs.php"
class="btn btn-success me-2 mb-2">

<i class="fas fa-briefcase"></i>

Manage Jobs

</a>

<a
href="applicants.php"
class="btn btn-warning mb-2">

<i class="fas fa-users"></i>

Applicants

</a>

</div>

</div>

<div class="card mb-4">

<div class="card-body">

<h4 class="mb-4">

<i class="fas fa-building text-primary"></i>

Company Information

</h4>

<div class="row">

<div class="col-md-6">

<p>

<strong>Company Name:</strong>

<?php echo $_SESSION['company_name']; ?>

</p>

<p>

<strong>Status:</strong>

<span class="badge bg-success">

Active

</span>

</p>

</div>

<div class="col-md-6">

<p>

<strong>Total Jobs:</strong>

<?php echo $total_jobs['total']; ?>

</p>

<p>

<strong>Total Applicants:</strong>

<?php echo $total_applicants['total']; ?>

</p>

</div>

</div>

</div>

</div>

<div class="card mb-4">

<div class="card-body">

<h4 class="mb-4">

<i class="fas fa-clock text-primary"></i>

Recent Activity

</h4>

<div class="list-group">

<div class="list-group-item">

<i class="fas fa-check-circle text-success"></i>

Dashboard successfully loaded

</div>

<div class="list-group-item">

<i class="fas fa-briefcase text-primary"></i>

Manage your job postings

</div>

<div class="list-group-item">

<i class="fas fa-users text-warning"></i>

Review incoming applicants

</div>

</div>

</div>

</div>

<div class="card">

<div class="card-body">

<h4 class="mb-4">

<i class="fas fa-user-clock text-primary"></i>

Recent Applicants

</h4>

<table class="table table-hover">

<thead>

<tr>

<th>Name</th>
<th>Job</th>
<th>Status</th>

</tr>

</thead>

<tbody>

<?php

if(mysqli_num_rows($recent_applicants) > 0){

while($row = mysqli_fetch_assoc($recent_applicants)){

?>

<tr>

<td>

<?php echo $row['fullname']; ?>

</td>

<td>

<?php echo $row['title']; ?>

</td>

<td>

<?php

if($row['status'] == 'Accepted'){
echo "<span class='badge bg-success'>Accepted</span>";
}

elseif($row['status'] == 'Rejected'){
echo "<span class='badge bg-danger'>Rejected</span>";
}

else{
echo "<span class='badge bg-warning'>Pending</span>";
}

?>

</td>

</tr>

<?php

}

}else{

?>

<tr>

<td colspan="3" class="text-center">

No applicants yet

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</body>

</html>




