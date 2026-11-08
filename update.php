<?php
    include "config/koneksi.php";

    $id = $_GET['id'];

    $stmt_select = mysqli_prepare($connect, "select * from mahasiswa where id = ?");

    mysqli_stmt_bind_param($stmt_select, "i", $id);

    mysqli_stmt_execute($stmt_select);

    $query = mysqli_stmt_get_result($stmt_select);

    $data = mysqli_fetch_assoc($query);

    if(isset($_POST['update'])){
        $nim = $_POST['nim'];
        $nama = $_POST['nama'];
        $jenis_kelamin = $_POST['jenis_kelamin'];

        $stmt = mysqli_prepare($connect, "update mahasiswa set
            nim = ?, 
            nama = ?, 
            jenis_kelamin = ?
            where id = ?
        ");

        mysqli_stmt_bind_param($stmt, "sssi", $nim, $nama, $jenis_kelamin, $id);

        $query_update = mysqli_stmt_execute($stmt);

        if($query_update){
            header("Location: index.php");
            exit();
        } else {
            echo "gagal mengupdate data!";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Mahasiswa</title>
</head>
<body>
    <h2>Update Data Mahasiswa</h2>
    <form action="" method="POST">    
        <label for="">NIM : </label>
        <input type="text" name="nim" value="<?php echo $data['nim']; ?>">
        <br><br>

        <label for="">Nama : </label>
        <input type="text" name="nama" value="<?php echo $data['nama']; ?>">
        <br><br>

        <label for="">Jenis kelamin</label>
        <select name="jenis_kelamin" id="">
            <option value="laki laki" <?php if($data['jenis_kelamin'] == 'laki laki') echo 'selected'?>>
                laki laki
            </option>
            <option value="perempuan" <?php if($data['jenis_kelamin'] == 'perempuan') echo 'selected'?>>
                perempuan
            </option>
        </select>
        <br><br>

        <button type="submit" name="update">Update</button> <!--// tombol edit(simpan) belum sampai ke simpan ke database, tombol edit(simpan) baru hanya gimmick -->
    </form>

</body>
</html>