<?php

session_start();
include '../config/database.php';

if(!isset($_SESSION['company_id'])){
    header("Location: ../auth/login_company.php");
    exit;
}

$company_id = $_SESSION['company_id'];

$jobs = mysqli_query($conn,

"SELECT *
FROM jobs
WHERE company_id='$company_id'
ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>
Manage Jobs
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
background:#f1f5f9;
}

.card{
border:none;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-body">

<div class="d-flex justify-content-between mb-4">

<h3>

Manage Jobs

</h3>

<a
href="add_job.php"
class="btn btn-primary">

Add Job

</a>

</div>

<table class="table table-hover">

<thead>

<tr>

<th>Title</th>
<th>Location</th>
<th>Salary</th>
<th>Type</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php
while($job = mysqli_fetch_assoc($jobs)){
?>

<tr>

<td>

<?php echo $job['title']; ?>

</td>

<td>

<?php echo $job['location']; ?>

</td>

<td>

<?php echo $job['salary']; ?>

</td>

<td>

<?php echo $job['job_type']; ?>

</td>

<td>

<span class="badge bg-success">

<?php echo $job['status']; ?>

</span>

</td>

<td>

<a
href="edit_job.php?id=<?php echo $job['id']; ?>"
class="btn btn-warning btn-sm">

Edit

</a>

<a
href="delete_job.php?id=<?php echo $job['id']; ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('Hapus lowongan ini?')">

Delete

</a>

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

