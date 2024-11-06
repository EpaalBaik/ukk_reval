<?php
session_start();
include '../config/koneksi.php';

$userid = $_SESSION['userid'];
$fotoid = $_GET['fotoid'];


$ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");

if (mysqli_num_rows($ceksuka) == 0) {
   
    mysqli_query($koneksi, "INSERT INTO likefoto (fotoid, userid) VALUES ('$fotoid', '$userid')");
} else {
    
    mysqli_query($koneksi, "DELETE FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
}

header("Location: ../admin/index.php");
exit();
?>