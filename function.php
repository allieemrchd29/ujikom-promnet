<?php
$conn = mysqli_connect("localhost", "root", "", "simbs");

// fungsi untuk menampilkan data dari database
function query($query){
    global $conn;

    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

// fungsi untuk menambahkan data ke database
function tambah_data($data){
    global $conn;
    
    $judul_buku = $data['judul_buku'];
    $jenis_buku = $data['jenis_buku'];
    $penulis = $data['penulis'];
    $penerbit = $data['penerbit'];
    $tahun_terbit = $data['tahun_terbit'];
    $no_isbn = $data['no_isbn'];
    $jml_hal = $data['jml_hal'];
    $id_kategori = $data['id_kategori'];

    // upload gambar
    $cover = upload_gambar($judul_buku, $penulis);  // outputnya adalah nim_nama.eksentsi
    if( !$cover ) {
        return false;
    }

    $query = "INSERT INTO buku (judul_buku, jenis_buku, penulis, penerbit, tahun_terbit, cover, no_isbn, jml_hal, id_kategori)
                  VALUES ('$judul_buku', '$jenis_buku', '$penulis', '$penerbit', '$tahun_terbit', '$cover', '$no_isbn', '$jml_hal', '$id_kategori')
                 ";
    mysqli_query($conn, $query);


    return mysqli_affected_rows($conn);    
}

// fungsi untuk menghapus data dari database
function hapus_data($id_buku){
    global $conn;

    $query = "DELETE FROM buku WHERE id_buku = $id_buku";

    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}

// fungsi untuk mengubah data dari database
function ubah_data($data){
    global $conn;

    $id_buku = $data['id_buku'];
    $judul_buku = $data['judul_buku'];
    $jenis_buku = $data['jenis_buku'];
    $penulis = $data['penulis'];
    $penerbit = $data['penerbit'];
    $tahun_terbit = $data['tahun_terbit'];
    
    $no_isbn = $data['no_isbn'];
    $jml_hal = $data['jml_hal'];
    $id_kategori = $data['id_kategori'];

    if($_FILES['cover']['error'] === 4) {
        // Tidak upload gambar baru, ambil cover lama dari database
        $result = query("SELECT cover FROM buku WHERE id_buku = $id_buku");
        $cover = $result[0]['cover'];
    } else {
        // Upload gambar baru
        $cover = upload_gambar($judul_buku, $penulis);
        if(!$cover) {
            return false;
        }
    }

    $query = "UPDATE buku SET
                judul_buku = '$judul_buku',
                jenis_buku = '$jenis_buku',
                penulis = '$penulis',
                penerbit = '$penerbit',
                tahun_terbit = '$tahun_terbit',
                cover = '$cover',
                no_isbn = '$no_isbn',
                jml_hal = '$jml_hal',
                id_kategori = '$id_kategori'
              WHERE id_buku = $id_buku
             ";

     $result = mysqli_query($conn, $query);
     
     return mysqli_affected_rows($conn);
}

// fungsi untuk mencari data
function search_data($keyword){
    global $conn;


    $query = "SELECT buku.*, kategori.kategori 
              FROM buku
              LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori
              WHERE
              buku.judul_buku LIKE '%$keyword%' OR
              buku.penulis LIKE '%$keyword%' OR
              buku.penerbit LIKE '%$keyword%' OR
              buku.tahun_terbit LIKE '%$keyword%' OR
              buku.no_isbn LIKE '%$keyword%' OR
              buku.jml_hal LIKE '%$keyword%' OR
              kategori.kategori LIKE '%$keyword%'
            ";
    return query($query);
}

// fungsi untuk upload gambar
function upload_gambar($judul_buku, $penulis) {

    // setting gambar
    $namaFile = $_FILES['cover']['name'];
    $ukuranFile = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error'];
    $tmpName = $_FILES['cover']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('pilih gambar terlebih dahulu!');
              </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('yang anda upload bukan gambar!');
              </script>";
        return false;
    }

    // cek jika ukurannya terlalu besar
    // maks --> 5MB
    if( $ukuranFile > 5000000 ) {
        echo "<script>
                alert('ukuran gambar terlalu besar!');
              </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = $judul_buku . "_" . $penulis;
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

// fungsi untuk register
function register($data){
    global $conn;

    $username = strtolower($data['username']);
    $email = $data['email'];
    $password = mysqli_real_escape_string($conn, $data['password']);
    // $konfirmasi_password = mysqli_real_escape_string($conn, $data['confirm_password']);

    // query untuk ngecek username yang diinputkan oleh user di database
    $query = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    $result = mysqli_fetch_assoc($query);

    if($result != NULL){
        return "Username sudah terdaftar!";
    }

    if(strlen($password) < 8){
        return "Password minimal harus 8 karakter!";
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user (username, email, password) VALUES('$username', '$email', '$password')");

    return true;
}
// fungsi untuk login
function login($data){
    global $conn;

    $username = $data['username'];
    $password = $data['password'];

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) === 1){
        $row = mysqli_fetch_assoc($result);

        if(password_verify($password, $row['password'])){
            $_SESSION["login"] = true;
            $_SESSION["username"] = $row['username'];
            return true;
        } else {
           
            return "Password salah!";
        }

    }else{
        return "Username tidak terdaftar!";
    }
}

?>