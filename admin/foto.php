<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != 'login') {
    echo "<script>
        alert('Anda belum login');
        location.href='../index.php';
    </script>";
}

$userid = $_SESSION['userid']; // Pastikan userid diambil dari session
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #fff;
        }
        .navbar {
            background-color: #212529;
        }
        .navbar a {
            color: #fff;
        }
        .navbar a:hover {
            color: #ddd;
        }
        .card, .modal-content {
            background-color: #1e1e1e;
            border-radius: 8px;
        }
        .card-header {
            background-color: #343a40;
            color: #fff;
            font-weight: bold;
        }
        .table {
            color: #fff;
        }
        .btn-outline-primary {
            border-color: #17a2b8;
            color: #17a2b8;
        }
        .btn-outline-primary:hover {
            background-color: #17a2b8;
            color: #fff;
        }
        .btn-outline-danger {
            border-color: #dc3545;
            color: #dc3545;
        }
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: #fff;
        }
        footer {
            background-color: #212529;
            color: #fff;
            padding: 10px;
        }
    </style>
</head>
<body class="bg-dark text-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Website Galeri</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
                <a href="home.php" class="nav-link">Home</a>
                <a href="album.php" class="nav-link">Album</a>
                <a href="foto.php" class="nav-link">Foto</a>
            </div>
            <a href="../config/aksi_logout.php" class="btn btn-outline-danger m-1">Keluar</a>
        </div>
    </div>
</nav>

<!-- Content -->
<div class="container mt-4">

    <div class="row">
        <!-- Add Foto -->
        <div class="col-md-4">
            <div class="card mt-2">
                <div class="card-header">Tambah Foto</div>
                <div class="card-body bd-dark text-light">
                    <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                        <label for="" class="form-label">Judul Foto</label>
                        <input type="text" class="form-control" name="judulfoto" required>
                        <label for="" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsifoto" required></textarea>
                        <label class="form-label">Album</label>
                        <select class="form-control" name="albumid" required>
                            <?php
                            $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                            while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                <option value="<?php echo $data_album['albumid']?>"><?php echo $data_album['namaalbum']?></option>
                            <?php } ?>
                        </select>
                        <label class="form-label">File</label>
                        <input type="file" class="form-control" name="lokasifile" required>
                        <button type="submit" class="btn btn-outline-primary mt-2" name="tambah">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Foto List -->
        <div class="col-md-8">
            <div class="card mt-2">
                <div class="card-header">Data Foto</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Foto</th>
                                <th>Judul Foto</th>
                                <th>Deskripsi</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $query = "SELECT * FROM foto WHERE userid='$userid'";
                            $sql = mysqli_query($koneksi, $query);
                            while ($data = mysqli_fetch_array($sql)) {   
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><img src="../assets/img/<?php echo $data['lokasifile']?>" width="100"></td>
                                    <td><?php echo $data['judulfoto'] ?></td>
                                    <td><?php echo $data['deskripsifoto'] ?></td>
                                    <td><?php echo $data['tanggalunggah'] ?></td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['fotoid']?>">Edit</button>

                                        <!-- Edit Modal -->
                                        <div class="modal fade" id="edit<?php echo $data['fotoid']?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Data Foto</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_foto.php" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="fotoid" value="<?php echo $data['fotoid']?>">
                                                            <label class="form-label">Judul Foto</label>
                                                            <input type="text" class="form-control" name="judulfoto" value="<?php echo $data['judulfoto'] ?>" required>
                                                            <label class="form-label">Deskripsi</label>
                                                            <textarea class="form-control" name="deskripsifoto" required><?php echo $data['deskripsifoto'] ?></textarea>
                                                            <label class="form-label">Album</label>
                                                            <select class="form-control" name="albumid" required>
                                                                <?php
                                                                $sql_album = mysqli_query($koneksi, "SELECT * FROM album WHERE userid='$userid'");
                                                                while ($data_album = mysqli_fetch_array($sql_album)) { ?>
                                                                    <option <?php if($data_album['albumid'] == $data['albumid']) { ?> selected="selected" <?php } ?> value="<?php echo $data_album['albumid']?>"><?php echo $data_album['namaalbum'] ?></option>
                                                                <?php } ?>
                                                            </select>
                                                            <label class="form-label">Foto</label>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <img src="../assets/img/<?php echo $data['lokasifile']?>" width="100">
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <label class="form-label">Ganti File</label>
                                                                    <input type="file" class="form-control" name="lokasifile">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-warning" name="edit">Edit Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Button -->
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['fotoid']?>">Hapus</button>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="hapus<?php echo $data['fotoid']?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="deleteModalLabel">Hapus Data Foto</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="../config/aksi_foto.php" method="POST">
                                                            <input type="hidden" name="fotoid" value="<?php echo $data['fotoid']?>">
                                                            Apakah anda yakin ingin menghapus foto <strong><?php echo $data['judulfoto']?></strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus Data</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Footer -->
<footer class="d-flex justify-content-center border-top mt-3 bg-dark fixed-bottom">
    <p>&copy; 2024 UKK RPL | Reval Putra Cedia</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
