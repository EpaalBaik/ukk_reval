<?php
session_start();
include 'koneksi.php';

if (isset($_POST['tambah'])){
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date('Y-m-d');
    $userid = $_SESSION['userid'];

    // Adjust this to match your table structure
    $sql = mysqli_query($koneksi, "INSERT INTO album (namaalbum, deskripsi, tanggalbuat, userid) VALUES ('$namaalbum', '$deskripsi', '$tanggal', '$userid')");

    if ($sql) {
        echo "<script>
        alert('Data berhasil disimpan!');
        location.href='../admin/album.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if (isset($_POST['edit'])){
    $albumid = $_POST['albumid'];
    $namaalbum = $_POST['namaalbum'];
    $deskripsi = $_POST['deskripsi'];
    $tanggal = date('Y-m-d');
    $userid = $_SESSION['userid'];

    $sql = mysqli_query($koneksi, "UPDATE album SET namaalbum='$namaalbum', deskripsi='$deskripsi', tanggalbuat='$tanggal' WHERE albumid='$albumid'");

    if ($sql) {
        echo "<script>
        alert('Data berhasil diperbarui!');
        location.href='../admin/album.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}

if (isset($_POST['hapus'])) {
    $albumid = $_POST['albumid'];

    // Correct the DELETE statement
    $sql = mysqli_query($koneksi, "DELETE FROM album WHERE albumid='$albumid'");

    if ($sql) {
        echo "<script>
        alert('Data berhasil dihapus!');
        location.href='../admin/album.php';
        </script>";
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }
}
?>
