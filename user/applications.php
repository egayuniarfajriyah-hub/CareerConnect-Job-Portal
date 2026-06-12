<?php

session_start();
include '../config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn,

"SELECT

applications.*,
jobs.title,
companies.company_name

FROM applications

JOIN jobs
ON applications.job_id = jobs.id

JOIN companies
ON jobs.company_id = companies.id

WHERE applications.user_id = '$user_id'

ORDER BY applications.id DESC"

);

?>

<!DOCTYPE html>
<html>

<head>

<title>My Applications</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">
        My Applications
    </h2>

    <table class="table table-bordered">

        <thead>

            <tr>

                <th>Job</th>
                <th>Company</th>
                <th>Status</th>

            </tr>

        </thead>

        <tbody>

            <?php while($row = mysqli_fetch_assoc($query)){ ?>

            <tr>

                <td>
                    <?php echo $row['title']; ?>
                </td>

                <td>
                    <?php echo $row['company_name']; ?>
                </td>

                <td>

                    <?php

                    if($row['status'] == 'Pending'){
                        echo "<span class='badge bg-warning'>Pending</span>";
                    }

                    elseif($row['status'] == 'Reviewed'){
                        echo "<span class='badge bg-info'>Reviewed</span>";
                    }

                    elseif($row['status'] == 'Accepted'){
                        echo "<span class='badge bg-success'>Accepted</span>";
                    }

                    else{
                        echo "<span class='badge bg-danger'>Rejected</span>";
                    }

                    ?>

                </td>

            </tr>

            <?php } ?>

        </tbody>

    </table>

</div>

</body>

</html>
