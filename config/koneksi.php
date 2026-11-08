<?php

$connect = mysqli_connect(
    "localhost",
    "root",
    "",
    "mahasiswa_upnvyk"
);

if (!$connect) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

?>