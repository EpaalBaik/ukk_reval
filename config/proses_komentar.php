<?php
session_start();
include 'koneksi.php';

$fotoid = $_POST['fotoid']; 
$userid = $_SESSION['userid'];
$isikomentar = $_POST['isikomentar'];
$tanggalkomentar = date("Y-m-d");

// Pastikan fotoid yang valid di masukkan ke dalam query
$query = mysqli_query($koneksi, "INSERT INTO komentarfoto (fotoid, userid, isikomentar, tanggalkomentar) VALUES ('$fotoid', '$userid', '$isikomentar', '$tanggalkomentar')");

if ($query) {
    echo "<script>
    location.href='../admin/index.php';
    </script>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
