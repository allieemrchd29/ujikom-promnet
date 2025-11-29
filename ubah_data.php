<?php

    session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require("function.php");

    $id_buku = $_GET['id_buku'];

    $query = query("
    SELECT buku.*, kategori.kategori 
    FROM buku 
    INNER JOIN kategori ON buku.id_kategori = kategori.id_kategori 
    WHERE buku.id_buku = $id_buku
    ");
    // echo "<pre>";
    // var_dump($query);
    // echo "</pre>";

    $buku = $query[0];

    $kategori_list = query("SELECT * FROM kategori");

    // ketika tombol submit nya di klik
    if(isset($_POST['tombol_submit'])){
       
        if(ubah_data($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal diubah di database!');
                    document.location.href = 'index.php';
                </script>
            ";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>

    <!-- NAVBAR SECTION START  -->
    <nav class="navbar navbar-expand-lg navbar-light white" style="background-color: #0b3a1bff">
        <div class="container">
            <a class="navbar-brand text-white" href="#">SIMBS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active text-white" aria-current="page" href="#">Data Buku</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="#">Kategori</a>
                </li>
            </ul>
            <ul>
                <li class="nav-item dropdown" style= "list-style: none">
                <a class="nav-link dropdown-toggle text-white nav-end" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Hallo, Selamat datang <?= $_SESSION['username'] ?>
                </a>
                <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="login.php">Login</a></li>
                <li><a class="dropdown-item" href="logout.php">Log out</a></li>
                </ul>
            </ul>
            </div>
        </div>
    </nav>
    <!-- NAVBAR SECTION END  -->
   
    <div class="p-4 container">
        <div class="row">
            <h1 class="mb-2">Ubah Data Buku</h1>
            <a href="index.php" class="mb-2">Kembali</a>
            <div class="col-md-6">
                <!-- <form action="" method="POST" enctype="multipart/form-data"> -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- input text bayangan -->
                    <input type="hidden" name="id_buku" value="<?= $buku['id_buku'] ?>">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Buku</label>
                        <input type="text" class="form-control" name="judul_buku" id="judul_buku" value="<?= $buku['judul_buku'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jenis Buku</label>
                        <input type="text" class="form-control" name="jenis_buku" id="jenis_buku" value="<?= $buku['jenis_buku'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Penulis</label>
                        <input type="text" class="form-control" name="penulis" id="penulis" value="<?= $buku['penulis'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Penerbit</label>
                        <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= $buku['penerbit'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tahun Terbit</label>
                        <input type="number" class="form-control" name="tahun_terbit" id="tahun_terbit" value="<?= $buku['tahun_terbit'] ?>" autocomplete="off">
                    </div>    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Cover</label>
                        <input type="file" class="form-control" name="cover" id="cover">
                        <small class="text-muted d-block mt-1">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">No ISBN</label>
                        <input type="number" class="form-control" name="no_isbn" id="no_isbn" value="<?= $buku['no_isbn'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jumlah Halaman</label>
                        <input type="number" class="form-control" name="jml_hal" id="jml_hal" value="<?= $buku['jml_hal'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori Buku</label>
                        <select name="id_kategori" class="form-select">
                            <?php foreach($kategori_list as $kat): ?>
                                <option value="<?= $kat['id_kategori'] ?>" 
                                    <?= ($buku['id_kategori'] == $kat['id_kategori']) ? 'selected' : '' ?>>
                                    <?= $kat['kategori'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="tombol_submit" class="btn-sm btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
