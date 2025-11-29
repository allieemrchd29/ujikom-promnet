<?php
    // koneksi ke database
    // var conn = fungsi koneksi("nama_host", "username", "password", "nama_db");
    // cara cek username di db mysql dengan CMD --> select user();
    session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }

    require("function2.php");

    //pagination
    //konfigurasi
    $jumlahDataPerHalaman = 4;
    $jumlahData = count(query("SELECT * FROM kategori"));
    $jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
    $halamanAktif = ( isset($_GET["halaman"]) ) ? $_GET["halaman"] : 1;
    $awalData = ( $jumlahDataPerHalaman * $halamanAktif ) - $jumlahDataPerHalaman;

    if(isset($_POST['tombol_search'])) {
    // Jika tombol search ditekan → tampilkan semua hasil pencarian
    $kategori = search_data($_POST['keyword']);
    } else {
        // Jika tidak search → baru pakai pagination
        $kategori = query("SELECT * FROM kategori LIMIT $awalData, $jumlahDataPerHalaman");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMBS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="style.css">

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
                <a class="nav-link active text-white" aria-current="page" href="index.php">Data Buku</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="index2.php">Kategori</a>
                </li>
            </ul>
            <ul>
                <li class="nav-item dropdown">
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
   
    <!-- CONTENT SECTION START -->
    <section class="p-3">
        <div class="container text-white" style="background-color">

            <h1>Data Kategori</h1>

            <div class="d-flex justify-content-between align-items-center">
                <a href="tambah_data2.php">
                    <button class="mb-2 btn-sm btn-primary">Tambah Data</button>
                </a>

                <form class="mb-2" action="" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Cari kategori..." autocomplete="off">
                        <button class="btn btn-primary" type="submit" name="tombol_search">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>
           
            <table class="table table-striped table-hover">
                <tr>
                    <th>No.</th>
                    <th>Id Kategori</th>
                    <th>Kategori</th>
                    <th>Tanggal Input</th>
                    <th>Aksi</th>
                </tr>
                <?php $no=1 ?>
                <?php foreach($kategori as $data): ?>
                <tr>
                    <td> <?= $no ?> </td>
                    <td> <?= $data['id_kategori'] ?> </td>
                    <td> <?= $data['kategori'] ?> </td>
                    <td> <?= $data['tgl_input'] ?> </td>
                    <td>
                        <a href="ubah_data2.php?id_kategori=<?= $data['id_kategori'] ?>">
                            <button class="btn-sm btn-success">Edit</button>
                        </a>

                        <a href="hapus_data2.php?id_kategori=<?= $data['id_kategori'] ?>">
                            <button class="btn-sm btn-danger">Hapus</button>
                        </a>
                    </td>
                </tr>
                <?php $no++; ?>
                <?php endforeach; ?>
            </table>

            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <!-- Tombol Previous -->
                    <?php if ($halamanAktif > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&laquo;</a>
                        </li>
                    <?php endif; ?>

                    <!-- Daftar halaman -->
                    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                        <?php if ($i == $halamanAktif) : ?>
                            <li class="page-item active">
                                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php else : ?>
                            <li class="page-item">
                                <a class="page-link" href="?halaman=<?= $i; ?>"><?= $i; ?></a>
                            </li>
                        <?php endif; ?>
                    <?php endfor; ?>

                    <!-- Tombol Next -->
                    <?php if ($halamanAktif < $jumlahHalaman) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">&raquo;</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav> 
        </div>
    </section>
    <!-- CONTENT SECTION END -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
