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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
    $kategori = $data['kategori'];
    $tgl_input = $data['tgl_input'];
    
    $query = "INSERT INTO kategori (kategori, tgl_input)
              VALUES ('$kategori', '$tgl_input')";
              
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}

// fungsi untuk menghapus data dari database
function hapus_data($id_kategori){
    global $conn;

    $query = "DELETE FROM kategori WHERE id_kategori = $id_kategori";

    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);    
}

// fungsi untuk mengubah data dari database
function ubah_data($data){
    global $conn;

    $escaped_keyword = mysqli_real_escape_string($conn, $keyword);

    $id_kategori = $data['id_kategori'];
    $kategori = $data['kategori'];
    $tgl_input = $data['tgl_input'];

    $query = "UPDATE kategori SET
                kategori = '$kategori',
                tgl_input = '$tgl_input'
              WHERE id_kategori = $id_kategori
             ";

     $result = mysqli_query($conn, $query);
     
     return mysqli_affected_rows($conn);
}

// fungsi untuk mencari data
function search_data($keyword){
    global $conn;

    $query = "SELECT * FROM kategori
              WHERE
              kategori LIKE '%$keyword%' OR
              tgl_input LIKE '%$keyword%'
            ";
    return query($query);
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