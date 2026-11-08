<?php
    include "config/koneksi.php";

    $id = $_GET['id'];

    $stmt = mysqli_prepare($connect, "delete from mahasiswa where id = ?");

    mysqli_stmt_bind_param($stmt, "i", $id);

    $query = mysqli_stmt_execute($stmt);

    if($query){
        header("location: index.php");
        exit();
    } else {
        echo "gagal menghapus data!";
    }


?>