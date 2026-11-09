<?php
    include "config/koneksi.php";

    if(isset($_POST['simpan'])){

        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];

        $stmt = mysqli_prepare($connect, "insert into mahasiswa (nim, nama, jenis_kelamin) values (?, ?, ?)");
    
        mysqli_stmt_bind_param($stmt, "sss", $nim, $nama, $jenis_kelamin);

        $query = mysqli_stmt_execute($stmt);

        if($query){
            header("location: index.php");
            exit();
        } else {
            echo "Gagal menambahkan data!";
        }  
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="site-navbar">
        <div class="navbar-inner">
            <a class="brand" href="index.php">
                <img src="assets/speda-logo.png" alt="">
                <span>Speda</span>
            </a>
            <div class="nav-links">
                <a href="index.php">Home</a>
                <a class="active" href="tambah.php">Tambah Mahasiswa</a>
            </div>
        </div>
    </nav>

    <main class="content-container">
        <h1>Tambah Mahasiswa</h1>
        <form action="" method="post" class="student-form">
            <div class="field">
                <label for="nim">NIM:</label>
                <input class="form-control" id="nim" type="text" name="nim" placeholder="Masukkan NIM mahasiswa" required>
            </div>
            <div class="field">
                <label for="nama">Nama:</label>
                <input class="form-control" id="nama" type="text" name="nama" placeholder="Masukkan Nama mahasiswa" required>
            </div>
            <fieldset class="gender-field">
                <legend>Jenis Kelamin</legend>
                <label class="radio-option">
                    <input type="radio" name="jenis_kelamin" value="laki laki" required>
                    <span>Laki-laki</span>
                </label>
                <label class="radio-option">
                    <input type="radio" name="jenis_kelamin" value="perempuan">
                    <span>Perempuan</span>
                </label>
            </fieldset>
            <button class="button button-primary" type="submit" name="simpan">Tambah Mahasiswa</button>
        </form>
    </main>
</body>
</html>