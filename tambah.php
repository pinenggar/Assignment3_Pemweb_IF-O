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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah mahasiswa</title>
</head>
<body>
    <h2>tambah data mahaiswa</h2>

    <form action="" method="post">
        <label for="">NIM : </label>
        <input type="text" name="nim">
        <br><br>

        <label for="">Nama : </label>
        <input type="text" name="nama">
        <br><br>

        <label for="">jenis kelamin : </label>
        <select name="jenis kelamin" id="">
            <option value="laki laki">laki laki</option>
            <option value="perempuan">perempuan</option>
        </select>
        <br><br>

        <button type="submit" name="simpan">submit</button>


    </form>
    
</body>
</html>