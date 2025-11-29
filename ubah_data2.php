<?php

    session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require("function2.php");

    $id_kategori = $_GET['id_kategori'];
    if (!isset($_GET['id_kategori'])) {
    die("ID kategori tidak ditemukan di URL!");
    }

    $kategori = query("SELECT * FROM kategori WHERE id_kategori = $id_kategori")[0];

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
            <h1 class="mb-2">Ubah Data Kategori</h1>
            <a href="index2.php" class="mb-2">Kembali</a>
            <div class="col-md-6">
                <!-- <form action="" method="POST" enctype="multipart/form-data"> -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <!-- input text bayangan -->
                    <input type="hidden" name="id_kategori" value="<?= $kategori['id_kategori'] ?>">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="kategori" value="<?= $kategori['kategori'] ?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Input</label>
                        <input type="datetime-local" class="form-control" name="tgl_input" id="tgl_input" value="<?= $kategori['tgl_input'] ?>" autocomplete="off">
                    </div>
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