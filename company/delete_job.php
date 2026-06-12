<?php

session_start();

include '../config/database.php';

if(!isset($_SESSION['company_id'])){
    header("Location: ../auth/login_company.php");
    exit;
}

$id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM jobs
    WHERE id='$id'"
);

header(
"Location: manage_jobs.php"
);

?>

