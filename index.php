<?php

include 'config/database.php';

$total_jobs = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM jobs
WHERE status='Open'"
)

);

$total_companies = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM companies"
)

);

$total_applicants = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM applications"
)

);

$total_users = mysqli_fetch_assoc(

mysqli_query(
$conn,
"SELECT COUNT(*) AS total
FROM users"
)

);

$featured_companies = mysqli_query(

$conn,

"SELECT *

FROM companies

ORDER BY id DESC

LIMIT 4"

);

$search = "";

if(
isset($_GET['search'])
&&
trim($_GET['search']) != ""
){

    $search = trim($_GET['search']);

}

$featured_jobs = mysqli_query(

$conn,

"SELECT

jobs.*,
companies.company_name

FROM jobs

JOIN companies
ON jobs.company_id = companies.id

WHERE jobs.status='Open'

AND (

jobs.title LIKE '%$search%'

OR

jobs.location LIKE '%$search%'

)

ORDER BY jobs.id DESC

LIMIT 6"

);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
CareerConnect - Find Your Dream Job
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
background:#f8fafc;
}

.navbar{
background:#2563EB;
}

.hero{
background:linear-gradient(
135deg,
#2563EB,
#60A5FA
);
padding:90px 0;
color:white;
overflow:hidden;
}

.hero-icon{
width:320px;
height:320px;
background:white;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
margin:auto;
box-shadow:0 20px 40px rgba(0,0,0,.15);
}

.hero h1{
font-size:60px;
font-weight:700;
}

.search-box{
background:white;
padding:10px;
border-radius:15px;
box-shadow:0 10px 20px rgba(0,0,0,.1);
}

.search-box input{
height:60px;
}

.stat-card,
.feature-card,
.job-card{
background:white;
padding:25px;
border-radius:20px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.feature-card{
height:100%;
}

.job-card{
transition:.3s;
}

.job-card:hover{
transform:translateY(-5px);
}

.cta{
background:linear-gradient(
135deg,
#2563EB,
#1E40AF
);
padding:80px 0;
color:white;
}

footer{
background:#111827;
color:white;
}

</style>

</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

<a class="navbar-brand fw-bold fs-4"
href="index.php">

CareerConnect

</a>

<button
class="navbar-toggler"
data-bs-toggle="collapse"
data-bs-target="#menu">

<span class="navbar-toggler-icon"></span>

</button>

<div
class="collapse navbar-collapse"
id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link"
href="#">
Home
</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="#jobs">
Jobs
</a>
</li>

<li class="nav-item">
<a class="nav-link"
href="#companies">
Companies
</a>
</li>

<li class="nav-item dropdown ms-2">

<button
class="btn btn-outline-light dropdown-toggle"
data-bs-toggle="dropdown">

Login

</button>

<ul class="dropdown-menu">

<li>

<a
class="dropdown-item"
href="auth/login.php">

Login as User

</a>

</li>

<li>

<a
class="dropdown-item"
href="auth/login_company.php">

Login as Company

</a>

</li>

</ul>

</li>

<li class="nav-item dropdown ms-2">

<button
class="btn btn-light text-primary fw-bold dropdown-toggle"
data-bs-toggle="dropdown">

Register

</button>

<ul class="dropdown-menu">

<li>

<a
class="dropdown-item"
href="auth/register_user.php">

Register User

</a>

</li>

<li>

<a
class="dropdown-item"
href="auth/register_company.php">

Register Company

</a>

</li>

</ul>

</li>

</ul>

</div>

</div>

</nav>

<section class="hero">

<div class="container">

<div class="row align-items-center">

<div class="col-lg-6">

<span class="badge bg-light text-primary mb-3 p-2">

#1 Modern Job Portal

</span>

<h1>

Find Your Dream Job

</h1>

<p class="lead">

Connecting Talent With Opportunity

</p>

<div class="search-box mt-4">

<form method="GET">

<input
type="hidden"
name="goto"
value="jobs">

<div class="input-group">

<input
type="text"
name="search"
class="form-control form-control-lg"
placeholder="Search jobs or location..."
value="<?php echo $search; ?>">

<button
class="btn btn-primary"
type="submit">

Search

</button>

</div>

</form>

</div>

</div>

<div class="col-lg-6 text-center">

<div class="hero-icon">

<i
class="fas fa-briefcase"
style="
font-size:130px;
color:#2563EB;
">
</i>

</div>

</div>

</div>

</div>

</section>

<section class="py-5">

<div class="container">

<div class="row text-center">

<div class="col-md-3 mb-4">

<div class="stat-card">

<h2 class="fw-bold text-primary">

<?php echo $total_jobs['total']; ?>

</h2>

<p>

Open Jobs

</p>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="stat-card">

<h2 class="fw-bold text-primary">

<?php echo $total_companies['total']; ?>

</h2>

<p>

Companies

</p>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="stat-card">

<h2 class="fw-bold text-primary">

<?php echo $total_users['total']; ?>

</h2>

<p>

Job Seekers

</p>

</div>

</div>

<div class="col-md-3 mb-4">

<div class="stat-card">

<h2 class="fw-bold text-primary">

<?php echo $total_applicants['total']; ?>

</h2>

<p>

Applications

</p>

</div>

</div>

</div>

</div>

</section>

<section id="companies" class="py-5 bg-light">

<div class="container">

<h2 class="text-center fw-bold mb-5">

Trusted Companies

</h2>

<div class="row text-center">

<?php

while($company = mysqli_fetch_assoc($featured_companies)){

?>

<div class="col-md-3 mb-4">

<div class="feature-card">

<div style="
width:80px;
height:80px;
background:#EFF6FF;
border-radius:50%;
display:flex;
align-items:center;
justify-content:center;
margin:auto;
">

<i
class="fas fa-building"
style="
font-size:35px;
color:#2563EB;
">
</i>

</div>

<h5 class="mt-3">

<?php echo $company['company_name']; ?>

</h5>

<p class="text-muted">

<?php echo $company['location']; ?>

</p>

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<section class="py-5">

<div class="container">

<h2 class="text-center fw-bold mb-5">

Why Choose CareerConnect?

</h2>

<div class="row">

<div class="col-md-4 mb-4">

<div class="feature-card text-center">

<i class="fas fa-briefcase fa-3x text-primary mb-3"></i>

<h4>

Thousands of Jobs

</h4>

<p>

Discover thousands of verified jobs from trusted companies.

</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="feature-card text-center">

<i class="fas fa-building fa-3x text-success mb-3"></i>

<h4>

Top Companies

</h4>

<p>

Connect directly with industry-leading organizations.

</p>

</div>

</div>

<div class="col-md-4 mb-4">

<div class="feature-card text-center">

<i class="fas fa-user-check fa-3x text-warning mb-3"></i>

<h4>

Easy Apply

</h4>

<p>

Apply quickly using your profile and uploaded CV.

</p>

</div>

</div>

</div>

</div>

</section>

<section id="jobs" class="py-5 bg-light">

<div class="container">

<?php if($search!=""){ ?>

<div class="alert alert-primary text-center">

Showing results for:

<b><?php echo $search; ?></b>

<a
href="index.php"
class="btn btn-sm btn-outline-primary ms-3">

Clear Search

</a>

</div>

<h2 class="text-center fw-bold mb-5">

Search Results

</h2>

<?php } else { ?>

<h2 class="text-center fw-bold mb-5">

Featured Jobs

</h2>

<?php } ?>

<div class="row">

<?php

if(mysqli_num_rows($featured_jobs) > 0){

while($job = mysqli_fetch_assoc($featured_jobs)){

?>

<div class="col-md-4 mb-4">

<div class="job-card">

<span class="badge bg-primary mb-3">

<?php echo $job['job_type']; ?>

</span>

<h4>

<?php echo $job['title']; ?>

</h4>

<p class="text-muted">

<?php echo $job['company_name']; ?>

</p>

<p>

📍 <?php echo $job['location']; ?>

</p>

<p class="fw-bold text-success">

<?php echo $job['salary']; ?>

</p>

<a
href="detail_job.php?id=<?php echo $job['id']; ?>"
class="btn btn-primary w-100">

View Detail

</a>

</div>

</div>

<?php

}

}else{

?>

<div class="col-12">

<div class="alert alert-warning text-center">

No jobs found

</div>

</div>

<?php } ?>

</div>

</div>

</section>

<div class="container">


<?php if($search!=""){ ?>

<div class="alert alert-primary text-center">

Showing results for:

<b><?php echo $search; ?></b>

<a
href="index.php"
class="btn btn-sm btn-outline-primary ms-3">

Clear Search

</a>

</div>

<h2 class="text-center fw-bold mb-5">

Search Results

</h2>

<?php } else { ?>

<h2 class="text-center fw-bold mb-5">

Featured Jobs

</h2>

<?php } ?>

<div class="row">

<?php

if(mysqli_num_rows($featured_jobs) > 0){

while($job = mysqli_fetch_assoc($featured_jobs)){

?>

<div class="col-md-4 mb-4">

<div class="job-card">

<span class="badge bg-primary mb-3">

<?php echo $job['job_type']; ?>

</span>

<h4>

<?php echo $job['title']; ?>

</h4>

<p class="text-muted">

<?php echo $job['company_name']; ?>

</p>

<p>

📍 <?php echo $job['location']; ?>

</p>

<p class="fw-bold text-success">

<?php echo $job['salary']; ?>

</p>

<a
href="detail_job.php?id=<?php echo $job['id']; ?>"
class="btn btn-primary w-100">

View Detail

</a>

</div>

</div>

<?php

}

}else{

?>

<div class="col-12">

<div class="alert alert-warning text-center">

No jobs found

</div>

</div>

<?php

}

?>

</div>

</div>

</section>

<section class="cta">
    
<div class="container text-center">

<h2 class="display-5 fw-bold">

Ready to Find Your Dream Job?

</h2>

<p class="lead mt-3">

Join thousands of professionals and discover
new career opportunities today.

</p>

<div class="mt-4">

<a
href="auth/register_user.php"
class="btn btn-light btn-lg me-3">

Register as Job Seeker

</a>

<a
href="auth/register_company.php"
class="btn btn-outline-light btn-lg">

Register as Company

</a>

</div>

</div>

</section>

<footer class="pt-5 pb-4">

<div class="container">

<div class="row">

<div class="col-md-4 mb-4">

<h3 class="fw-bold">

CareerConnect

</h3>

<p>

Connecting Talent With Opportunity.

Build your career and connect
with the best companies.

</p>

</div>

<div class="col-md-2 mb-4">

<h5>

Company

</h5>

<ul class="list-unstyled">

<li class="mb-2">

<a href="#companies"
class="text-white text-decoration-none">

About Us

</a>

</li>

<li class="mb-2">

<a href="#jobs"
class="text-white text-decoration-none">

Jobs

</a>

</li>

<li>

<a href="#"
class="text-white text-decoration-none">

Contact

</a>

</li>

</ul>

</div>

<div class="col-md-3 mb-4">

<h5>

Resources

</h5>

<ul class="list-unstyled">

<li class="mb-2">

<a href="#jobs"
class="text-white text-decoration-none">

Browse Jobs

</a>

</li>

<li class="mb-2">

<a href="#companies"
class="text-white text-decoration-none">

Companies

</a>

</li>

<li>

<a href="#"
class="text-white text-decoration-none">

Career Tips

</a>

</li>

</ul>

</div>

<div class="col-md-3 mb-4">

<h5>

Follow Us

</h5>

<div class="mt-3">

<i class="fab fa-facebook fa-2x me-3"></i>

<i class="fab fa-instagram fa-2x me-3"></i>

<i class="fab fa-linkedin fa-2x me-3"></i>

<i class="fab fa-twitter fa-2x"></i>

</div>

</div>

</div>

<hr>

<div class="text-center">

<p class="mb-0">

© 2026 CareerConnect.
All Rights Reserved.

</p>

</div>

</div>

</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

