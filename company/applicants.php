<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['company_id'])){
    header("Location: ../auth/login_company.php");
    exit;
}

$company_id = $_SESSION['company_id'];

$applicants = mysqli_query($conn,

"SELECT

applications.id,
applications.status,
applications.applied_at,

users.fullname,
users.email,
users.cv,

jobs.title

FROM applications

JOIN users
ON applications.user_id = users.id

JOIN jobs
ON applications.job_id = jobs.id

WHERE jobs.company_id='$company_id'

ORDER BY applications.id DESC"

);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>
Job Applicants
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

<div class="d-flex justify-content-between align-items-center mb-4">

<h3>

<i class="fas fa-users text-primary"></i>

Job Applicants

</h3>

<a
href="dashboard.php"
class="btn btn-secondary">

Back

</a>

</div>

<table class="table table-hover">

<thead>

<tr>

<th>Name</th>
<th>Email</th>
<th>Job</th>
<th>CV</th>
<th>Status</th>
<th>Applied At</th>
<th>Action</th>


</tr>

</thead>

<tbody>

<?php
while($row = mysqli_fetch_assoc($applicants)){
?>

<tr>

<td>

<?php echo $row['fullname']; ?>

</td>

<td>

<?php echo $row['email']; ?>

</td>

<td>

<?php echo $row['title']; ?>

</td>

<td>

<?php

if(!empty($row['cv'])){

?>

<a
href="../uploads/cv/<?php echo $row['cv']; ?>"
target="_blank"
class="btn btn-info btn-sm">

View CV

</a>

<?php

}else{

echo "<span class='text-danger'>
No CV
</span>";

}

?>

</td>


<td>

<?php

if($row['status'] == 'Pending'){
echo "<span class='badge bg-warning'>Pending</span>";
}

elseif($row['status'] == 'Accepted'){
echo "<span class='badge bg-success'>Accepted</span>";
}

elseif($row['status'] == 'Rejected'){
echo "<span class='badge bg-danger'>Rejected</span>";
}

else{
echo "<span class='badge bg-info'>Reviewed</span>";
}

?>

</td>

<td>

<?php echo $row['applied_at']; ?>

</td>

<td>

<a
href="accept_applicant.php?id=<?php echo $row['id']; ?>"
class="btn btn-success btn-sm">

Accept

</a>

<a
href="reject_applicant.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm">

Reject

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

