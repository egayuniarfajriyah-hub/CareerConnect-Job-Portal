<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "careerconnect"
);

if(!$conn){
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>