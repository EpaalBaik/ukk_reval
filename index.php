<?php
session_start();
include 'config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Galeri Foto</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>

<body class="bg-dark text-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">Selamat Datang Di</a>
            <a  class="navbar-brand position-absolute top-25 start-50 translate-middle-x" href="index.php">Website Galeri Foto</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav me-auto"></div>
                <a href="register.php" class="btn btn-outline-light m-1">Register</a>
                <a href="login.php" class="btn btn-outline-success m-1">Masuk</a>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="container mt-5 pt-5">
        <div class="row">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM foto INNER JOIN user ON foto.userid=user.userid INNER JOIN album ON foto.albumid=album.albumid");
            while ($data = mysqli_fetch_array($query)) {
            ?>
                <!-- Photo Card -->
                <div class="col-md-4 mb-4">
                    <a type="button" data-bs-toggle="modal" data-bs-target="#komentar<?php echo $data['fotoid'] ?>">
                        <div class="card bg-dark text-light shadow-lg border-light">
                            <img src="assets/img/<?php echo $data['lokasifile'] ?>" class="card-img-top" alt="<?php echo $data['judulfoto'] ?>" style="height: 12rem; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $data['judulfoto'] ?></h5>
                                <p class="card-text text-muted"><?php echo substr($data['deskripsifoto'], 0, 50) . '...'; ?></p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Modal for Comments (If needed) -->
    <?php
    $query = mysqli_query($koneksi, "SELECT * FROM foto");
    while ($data = mysqli_fetch_array($query)) {
    ?>  
        <div class="modal fade" id="komentar<?php echo $data['fotoid'] ?>" tabindex="-1" aria-labelledby="komentarLabel<?php echo $data['fotoid'] ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content bg-dark text-light">
                    <div class="modal-header">
                        <h5 class="modal-title" id="komentarLabel<?php echo $data['fotoid'] ?>"><?php echo $data['judulfoto'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-8">
                                <img src="assets/img/<?php echo $data['lokasifile'] ?>" class="img-fluid" alt="<?php echo $data['judulfoto'] ?>">
                            </div>
                            <div class="col-md-4">
                                <h6>Deskripsi</h6>
                                <p><?php echo $data['deskripsifoto'] ?></p>
                                <hr>
                                <h6>Komentar</h6>
                                <?php
                                $komentar = mysqli_query($koneksi, "SELECT * FROM komentarfoto INNER JOIN user ON komentarfoto.userid=user.userid WHERE komentarfoto.fotoid='" . $data['fotoid'] . "'");
                                while ($row = mysqli_fetch_array($komentar)) {
                                ?>
                                    <div><strong><?php echo $row['namalengkap'] ?></strong>: <?php echo $row['isikomentar'] ?></div>
                                <?php } ?>
                                <hr>
                                <form action="config/proses_komentar.php" method="POST">
                                    <div class="input-group">
                                        <input type="hidden" name="fotoid" value="<?php echo $data['fotoid'] ?>">
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3 mt-5">
        <p>&copy; 2024 | UKK RPL | Reval Putra Cedia</p>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
