<?php

session_start();
include '../config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$jobs = mysqli_query($conn,
"SELECT jobs.*, companies.company_name
FROM jobs
LEFT JOIN companies
ON jobs.company_id = companies.id
ORDER BY jobs.id DESC");

?>

<!DOCTYPE html>
<html>

<head>

<title>Jobs</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">
        Available Jobs
    </h2>

    <div class="row">

        <?php while($job = mysqli_fetch_assoc($jobs)){ ?>

        <div class="col-md-4 mb-4">

            <div class="card shadow h-100">

                <div class="card-body">

                    <h5>
                        <?php echo $job['title']; ?>
                    </h5>

                    <p>
                        <?php echo $job['company_name']; ?>
                    </p>

                    <p>
                        <?php echo $job['location']; ?>
                    </p>

                    <p>
                        <?php echo $job['salary']; ?>
                    </p>

                   <a
href="apply.php?job_id=<?php echo $job['id']; ?>"
class="btn btn-primary">

Apply Now

</a>

                </div>

            </div>

        </div>

        <?php } ?>

    </div>

</div>

</body>

</html>

