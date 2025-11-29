<?php

    session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }
    require("function2.php");

    // kita akan cek dulu ketika tombol submit ditekan
    if(isset($_POST['tombol_submit'])){
        //  var_dump($_POST);

        // ==============
        // CARA PERTAMA
        // ==============

        // $nim = $_POST['nim'];
        // $nama = $_POST['nama'];
        // $email = $_POST['email'];
        // $jurusan = $_POST['jurusan'];
        // $gambar = $_POST['gambar'];

        // $query = "INSERT INTO mahasiswa (nim, nama, email, jurusan, gambar)
        //           VALUES ('$nim', '$nama', '$email', '$jurusan', '$gambar')
        //          ";


        // $result = mysqli_query($conn, $query);


        // if($result){
            // echo "
            //     <script>
            //         alert('Data berhasil ditambahkan ke database!');
            //         document.location.href = 'index.php';
            //     </script>
            // ";
        // }else{
        //     echo "
        //         <script>
        //             alert('Data gagal ditambahkan ke database!');
        //             document.location.href = 'index.php';
        //         </script>
        //     ";
        // }

        // ==============
        // CARA KEDUA
        // ==============
        if(tambah_data($_POST) > 0){
            echo "
                <script>
                    alert('Data berhasil ditambahkan ke database!');
                    document.location.href = 'index2.php';
                </script>
            ";
        }else{
            echo "
                <script>
                    alert('Data gagal ditambahkan ke database!');
                    document.location.href = 'index2.php';
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
    <title>Tambah Data Kategori</title>
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
                <a class="nav-link active text-white" aria-current="page" href="#">Data Kategori</a>
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
            <h1 class="mb-2">Tambah Data Kategori</h1>
            <a href="index2.php" class="mb-2">Kembali</a>
            <div class="col-md-6">
                <!-- <form action="" method="POST" enctype="multipart/form-data"> (biar bisa upload data) -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori</label>
                        <input type="text" class="form-control" name="kategori" id="kategori" placeholder="kategori" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tanggal Input</label>
                        <input type="datetime-local" class="form-control" name="tgl_input" id="tgl_input" placeholder="masukkan tanggal input" autocomplete="off">
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