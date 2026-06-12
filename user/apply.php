<?php

session_start();
include '../config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$user_data = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM users
        WHERE id='$user_id'"
    )
);

$profile_score = 0;

if(!empty($user_data['fullname'])) $profile_score += 25;
if(!empty($user_data['phone'])) $profile_score += 25;
if(!empty($user_data['address'])) $profile_score += 25;
if(!empty($user_data['cv'])) $profile_score += 25;

$total = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM applications
WHERE user_id='$user_id'"
));

$pending = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM applications
WHERE user_id='$user_id'
AND status='Pending'"
));

$accepted = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM applications
WHERE user_id='$user_id'
AND status='Accepted'"
));

$rejected = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM applications
WHERE user_id='$user_id'
AND status='Rejected'"
));

$recent = mysqli_query(
$conn,
"SELECT
applications.status,
jobs.title,
companies.company_name

FROM applications

JOIN jobs
ON applications.job_id = jobs.id

JOIN companies
ON jobs.company_id = companies.id

WHERE applications.user_id='$user_id'

ORDER BY applications.id DESC
LIMIT 5"
);

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Dashboard User</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
position:fixed;
background:linear-gradient(180deg,#2563EB,#1E40AF);
padding:25px;
}

.main{
margin-left:270px;
padding:30px;
}

.hero{
background:linear-gradient(135deg,#2563EB,#60A5FA);
border-radius:25px;
padding:35px;
color:white;
}

.avatar{
width:90px;
height:90px;
background:white;
color:#2563EB;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
font-size:35px;
font-weight:bold;
margin-left:auto;
}

.stat-card{
border-radius:20px;
padding:20px;
height:130px;
color:white;
}

.blue{background:#2563EB;}
.orange{background:#F59E0B;}
.green{background:#10B981;}
.red{background:#EF4444;}

.content-card{
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
margin-top:25px;
}

</style>

</head>

<body>

<div class="sidebar">

    <h2 class="text-white fw-bold mb-4">
        CareerConnect
    </h2>

    <a href="dashboard.php" class="text-white text-decoration-none d-block mb-3">
        <i class="fas fa-chart-line"></i> Dashboard
    </a>

    <a href="profile.php" class="text-white text-decoration-none d-block mb-3">
        <i class="fas fa-user"></i> Profile
    </a>

    <a href="jobs.php" class="text-white text-decoration-none d-block mb-3">
        <i class="fas fa-briefcase"></i> Jobs
    </a>

    <a href="applications.php" class="text-white text-decoration-none d-block mb-3">
        <i class="fas fa-file-alt"></i> Applications
    </a>

    <a href="../auth/logout.php" class="text-white text-decoration-none d-block">
        <i class="fas fa-sign-out-alt"></i> Logout
    </a>

</div>

<div class="main">

<div class="hero">

    <div class="row align-items-center">

        <div class="col-md-8">

            <h1>
                Halo,
                <?php echo $_SESSION['fullname']; ?> 👋
            </h1>

            <p class="mb-0">
                Find Your Dream Job Today.
                Connecting Talent With Opportunity.
            </p>

        </div>

        <div class="col-md-4">

            <div class="avatar">

                <?php
                echo strtoupper(
                substr(
                $_SESSION['fullname'],
                0,
                1
                ));
                ?>

            </div>

        </div>

    </div>

</div>

<div class="content-card">

    <div class="d-flex justify-content-between">

        <h5>
            Profile Completion
        </h5>

        <strong>
            <?php echo $profile_score; ?>%
        </strong>

    </div>

    <div class="progress mt-3">

        <div
        class="progress-bar bg-success"
        style="width:
        <?php echo $profile_score; ?>%">

        </div>

    </div>

    <small class="text-muted">

        Lengkapi profil untuk
        meningkatkan peluang diterima.

    </small>

</div>

<div class="row mt-4">

<div class="col-md-3 mb-3">

<div class="stat-card blue">

<div class="d-flex justify-content-between">

<i class="fas fa-file-signature fa-2x"></i>

<h2>
<?php echo $total['total']; ?>
</h2>

</div>

<p class="mt-3">
Total Applications
</p>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="stat-card orange">

<div class="d-flex justify-content-between">

<i class="fas fa-clock fa-2x"></i>

<h2>
<?php echo $pending['total']; ?>
</h2>

</div>

<p class="mt-3">
Pending
</p>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="stat-card green">

<div class="d-flex justify-content-between">

<i class="fas fa-check-circle fa-2x"></i>

<h2>
<?php echo $accepted['total']; ?>
</h2>

</div>

<p class="mt-3">
Accepted
</p>

</div>

</div>

<div class="col-md-3 mb-3">

<div class="stat-card red">

<div class="d-flex justify-content-between">

<i class="fas fa-times-circle fa-2x"></i>

<h2>
<?php echo $rejected['total']; ?>
</h2>

</div>

<p class="mt-3">
Rejected
</p>

</div>

</div>

</div>

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4>
            🔥 Recommended Jobs
        </h4>

        <a href="jobs.php"
           class="btn btn-outline-primary">

            View All Jobs

        </a>

    </div>

    <div class="row">

    <?php

    $recommended = mysqli_query(
    $conn,
    "SELECT * FROM jobs
    ORDER BY id DESC
    LIMIT 3"
    );

    while($job = mysqli_fetch_assoc($recommended)){

    ?>

    <div class="col-md-4 mb-3">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-body">

                <h5>
                    <?php echo $job['title']; ?>
                </h5>

                <p class="text-muted mb-2">
                    📍 <?php echo $job['location']; ?>
                </p>

                <p class="text-success fw-bold">
                    <?php echo $job['salary']; ?>
                </p>

                <a
                href="apply.php?job_id=<?php echo $job['id']; ?>"
                class="btn btn-primary btn-sm">

                Apply Now

                </a>

            </div>

        </div>

    </div>

    <?php } ?>

    </div>

</div>

<div class="content-card">

    <h4 class="mb-4">
        ⚡ Quick Actions
    </h4>

    <div class="row">

        <div class="col-md-4 mb-3">

            <a href="jobs.php"
               class="btn btn-primary w-100 p-3">

                <i class="fas fa-search"></i>
                Browse Jobs

            </a>

        </div>

        <div class="col-md-4 mb-3">

            <a href="profile.php"
               class="btn btn-success w-100 p-3">

                <i class="fas fa-user-edit"></i>
                Complete Profile

            </a>

        </div>

        <div class="col-md-4 mb-3">

            <a href="applications.php"
               class="btn btn-warning w-100 p-3">

                <i class="fas fa-file-alt"></i>
                My Applications

            </a>

        </div>

    </div>

</div>

<div class="content-card">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h4>
            📄 Recent Applications
        </h4>

        <a href="applications.php"
           class="btn btn-outline-primary">

            View All

        </a>

    </div>

    <div class="row">

    <?php

    if(mysqli_num_rows($recent) > 0){

        while($row = mysqli_fetch_assoc($recent)){

    ?>

    <div class="col-md-6 mb-3">

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <h5>
                    <?php echo $row['title']; ?>
                </h5>

                <p class="text-muted">
                    <?php echo $row['company_name']; ?>
                </p>

                <?php

                if($row['status'] == 'Pending'){
                    echo "<span class='badge bg-warning'>Pending</span>";
                }

                elseif($row['status'] == 'Accepted'){
                    echo "<span class='badge bg-success'>Accepted</span>";
                }

                elseif($row['status'] == 'Reviewed'){
                    echo "<span class='badge bg-info'>Reviewed</span>";
                }

                else{
                    echo "<span class='badge bg-danger'>Rejected</span>";
                }

                ?>

            </div>

        </div>

    </div>

    <?php

        }

    }else{

    ?>

    <div class="col-12">

        <div class="text-center py-5">

            <i class="fas fa-briefcase fa-4x text-secondary mb-3"></i>

            <h4>
                Belum Ada Lamaran
            </h4>

            <p class="text-muted">

                Mulai cari pekerjaan dan kirim
                lamaran pertamamu.

            </p>

            <a href="jobs.php"
               class="btn btn-primary">

               Cari Lowongan

            </a>

        </div>

    </div>

    <?php } ?>

    </div>

</div>

</div>

</body>
</html>



