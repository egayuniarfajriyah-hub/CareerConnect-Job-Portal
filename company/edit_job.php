<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['company_id'])){
    header("Location: ../auth/login_company.php");
    exit;
}

$id = $_GET['id'];

$data = mysqli_query(
    $conn,
    "SELECT * FROM jobs
    WHERE id='$id'"
);

$job = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $title = $_POST['title'];
    $location = $_POST['location'];
    $salary = $_POST['salary'];
    $job_type = $_POST['job_type'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    mysqli_query($conn,

    "UPDATE jobs SET

    title='$title',
    location='$location',
    salary='$salary',
    job_type='$job_type',
    description='$description',
    requirements='$requirements',
    deadline='$deadline',
    status='$status'

    WHERE id='$id'"

    );

    echo "<script>
    alert('Job berhasil diperbarui');
    window.location='manage_jobs.php';
    </script>";

}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1">

<title>Edit Job</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

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

</style>

</head>

<body>

<div class="container">

<div class="form-card">

<h2 class="mb-4">

<i class="fas fa-edit text-primary"></i>

Edit Job

</h2>

<form method="POST">

<div class="mb-3">

<label>Job Title</label>

<input
type="text"
name="title"
class="form-control"
value="<?php echo $job['title']; ?>"
required>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Location</label>

<input
type="text"
name="location"
class="form-control"
value="<?php echo $job['location']; ?>">

</div>

<div class="col-md-6 mb-3">

<label>Salary</label>

<input
type="text"
name="salary"
class="form-control"
value="<?php echo $job['salary']; ?>">

</div>

</div>

<div class="row">

<div class="col-md-6 mb-3">

<label>Job Type</label>

<select
name="job_type"
class="form-select">

<option value="Full Time"
<?php if($job['job_type']=='Full Time') echo 'selected'; ?>>
Full Time
</option>

<option value="Part Time"
<?php if($job['job_type']=='Part Time') echo 'selected'; ?>>
Part Time
</option>

<option value="Internship"
<?php if($job['job_type']=='Internship') echo 'selected'; ?>>
Internship
</option>

<option value="Remote"
<?php if($job['job_type']=='Remote') echo 'selected'; ?>>
Remote
</option>

</select>

</div>

<div class="col-md-6 mb-3">

<label>Deadline</label>

<input
type="date"
name="deadline"
class="form-control"
value="<?php echo $job['deadline']; ?>">

</div>

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
rows="4"><?php echo $job['description']; ?></textarea>

</div>

<div class="mb-3">

<label>Requirements</label>

<textarea
name="requirements"
class="form-control"
rows="4"><?php echo $job['requirements']; ?></textarea>

</div>

<div class="mb-3">

<label>Status</label>

<select
name="status"
class="form-select">

<option value="Open"
<?php if($job['status']=='Open') echo 'selected'; ?>>
Open
</option>

<option value="Closed"
<?php if($job['status']=='Closed') echo 'selected'; ?>>
Closed
</option>

</select>

</div>

<button
type="submit"
name="update"
class="btn btn-primary">

Update Job

</button>

<a
href="manage_jobs.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</body>
</html>


