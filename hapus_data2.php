<?php

    session_start();
    if( !isset($_SESSION["login"]) ) {
        header("Location: login.php");
        exit;
    }
    require("function2.php");

    $id_kategori = $_GET['id_kategori'];

    if(hapus_data($id_kategori) > 0){
        echo "
            <script>
                alert('Data berhasil dihapus dari database!');
                document.location.href = 'index.php';
            </script>
        ";
    }else{
        echo "
            <script>
                alert('Data gagal dihapus dari database!');
                document.location.href = 'index.php';
            </script>
        ";
    }
   
?>