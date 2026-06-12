<?php

session_start();
include '../config/database.php';

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$query = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id'");
$user = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $cv_name = $user['cv'];

    if(!empty($_FILES['cv']['name'])){

        $cv_name = time().'_'.$_FILES['cv']['name'];

        move_uploaded_file(
            $_FILES['cv']['tmp_name'],
            "../uploads/cv/".$cv_name
        );
    }

    mysqli_query($conn,
    "UPDATE users SET
    phone='$phone',
    address='$address',
    cv='$cv_name'
    WHERE id='$user_id'
    ");

    echo "<script>
    alert('Profil berhasil diperbarui');
    window.location='profile.php';
    </script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-body">

            <h3 class="mb-4">My Profile</h3>

            <form method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Full Name</label>
                    <input
                        type="text"
                        class="form-control"
                        value="<?php echo $user['fullname']; ?>"
                        readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input
                        type="email"
                        class="form-control"
                        value="<?php echo $user['email']; ?>"
                        readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="<?php echo $user['phone']; ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Address</label>
                    <textarea
                        name="address"
                        class="form-control"
                        rows="4"><?php echo $user['address']; ?></textarea>
                </div>

                <div class="mb-3">

                    <label class="form-label">
                        Upload CV (PDF)
                    </label>

                    <input
                        type="file"
                        name="cv"
                        class="form-control"
                        accept=".pdf">

                    <?php if(!empty($user['cv'])){ ?>

                        <div class="mt-2">

                            CV Saat Ini:

                            <a
                                href="../uploads/cv/<?php echo $user['cv']; ?>"
                                target="_blank">

                                Lihat CV

                            </a>

                        </div>

                    <?php } ?>

                </div>

                <button
                    type="submit"
                    name="update"
                    class="btn btn-primary">

                    Update Profile

                </button>

            </form>

        </div>

    </div>

</div>

</body>
</html>
```
