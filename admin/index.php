<?php
session_start();
$userid = $_SESSION['userid'];
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script> 
    alert('Anda Belum Login!');
    location.href='../index.php';
    </script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Galeri Foto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="bg-dark text-light"> 

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Website Galeri Foto</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse mt-2" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
                <a href="album.php" class="nav-link">Album</a>
                <a href="foto.php" class="nav-link">Foto</a>
            </div>
        </div>
        <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
    </div>
</nav>

<!-- Container -->
<div class="container mt-5">

    <!-- Row of images -->
    <div class="row">
        <?php
        $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        
        <div class="col-md-4 mb-4">
            
            <!-- Card -->

            <div class="card shadow-lg border-light">
            <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                <img src="../assets/img/<?php echo $data['lokasifile']?>" class="card-img-top" alt="<?php echo $data['judulfoto']?>" style="height: 200px; object-fit: cover;">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $data['judulfoto']?></h5>
                    <p class="card-text text-muted"><?php echo substr($data['deskripsifoto'], 0, 100) . '...'; ?></p>
                    <div class="d-flex justify-content-between align-items-center">
    <div class="btn-group">
        <?php
        $fotoid = $data['fotoid'];
        $userid = $data['userid'];
        $ceksuka = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid' AND userid='$userid'");
        if (mysqli_num_rows($ceksuka) == 1) { ?>
            <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']?>" class="btn btn-danger btn-sm"><i class="fa fa-heart"></i> UnLike</a>
        <?php } else { ?>
            <a href="../config/proses_like.php?fotoid=<?php echo $data['fotoid']?>" class="btn btn-outline-danger btn-sm"><i class="fa-regular fa-heart"></i> Like </a>
        <?php }
        $like = mysqli_query($koneksi, "SELECT * FROM likefoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($like) . '  ';
        ?>
    </div>
    
    <!-- Tambahkan kelas ms-3 untuk memberi margin kiri pada tombol Komentar -->
    <a href="#" class="btn btn-outline-primary btn-sm ms-3" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
        <i class="fa-regular fa-comment"></i> <?php
        $jmlkomen = mysqli_query($koneksi, "SELECT * FROM komentarfoto WHERE fotoid='$fotoid'");
        echo mysqli_num_rows($jmlkomen) . ' Komentar ';
        ?>
    </a>
</div>

                </div>
            </div>
        </div>
        </a>
        <!-- Modal for Comments -->
<div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="komentarLabel<?php echo $data['fotoid'] ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-light">
            <div class="modal-header">
                <h5 class="modal-title" id="komentarLabel<?php echo $data['fotoid'] ?>"><?php echo $data['judulfoto']?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <img src="../assets/img/<?php echo $data['lokasifile']?>" class="img-fluid" alt="<?php echo $data['judulfoto']?>">
                    </div>
                    <div class="col-md-4">
                        <h6>Deskripsi</h6>
                        <p><?php echo $data['deskripsifoto']?></p>
                        <hr>
                        <h6>Komentar</h6>
                        <?php
                        $komentar = mysqli_query($koneksi, "SELECT komentarfoto.*, user.namalengkap FROM komentarfoto INNER JOIN user ON komentarfoto.userid = user.userid WHERE komentarfoto.fotoid = '$fotoid'");
                        while($row = mysqli_fetch_array($komentar)) {
                            echo "<div><strong>" . $row['namalengkap'] . "</strong>: " . $row['isikomentar'] . "</div>";
                        }
                        ?>
                        <hr>
                        <form action="../config/proses_komentar.php" method="POST">
                            <div class="input-group">
                                <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                <input type="text" name="isikomentar" class="form-control" placeholder="Tambah Komentar" required>
                                <button type="submit" name="kirimkomentar" class="btn btn-outline-primary">Kirim</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

        <?php } ?>
    </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3 mt-5">
    <p>&copy; 2024 | UKK RPL | Reval Putra Cedia</p>
</footer>

<!-- Bootstrap JS (Bundle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
